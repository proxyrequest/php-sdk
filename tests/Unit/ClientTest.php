<?php

declare(strict_types=1);

namespace ProxyRequest\Tests\Unit;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use ProxyRequest\ApiException;
use ProxyRequest\ApiResponse;
use ProxyRequest\Client;
use ProxyRequest\Dto\LoginRequest;
use ProxyRequest\Dto\PatchedUserUpdateRequest;
use ProxyRequest\Dto\TelegramSessionRequest;
use ProxyRequest\Dto\WebhookCreateRequest;
use ProxyRequest\Dto\WebhookScopeEnum;
use ProxyRequest\Exception\ErrorKind;

final class ClientTest extends TestCase
{
    public function testStaticApiKeyIsAddedToAuthenticatedRequests(): void
    {
        $request = Client::withApiKey('sdk-secret')->users()->getRequest('user/id', 'uk');

        self::assertSame('Static sdk-secret', $request->getHeaderLine('Authorization'));
        self::assertSame('uk', $request->getHeaderLine('Accept-Language'));
        self::assertSame('https://api.proxyrequest.com/api/v1/users/user%2Fid', (string) $request->getUri());
    }

    public function testBearerTokenAndCustomDeploymentHostAreSupported(): void
    {
        $request = Client::withBearerToken('jwt', 'https://customer.example/api/v1')->profile()->getRequest();

        self::assertSame('Bearer jwt', $request->getHeaderLine('Authorization'));
        self::assertSame('https://customer.example/api/v1/profile', (string) $request->getUri());
    }

    public function testAnonymousAuthorizationRequestDoesNotLeakCredentials(): void
    {
        $request = Client::anonymous()->authorization()->loginRequest(
            new LoginRequest(['username' => 'developer', 'password' => 'secret']),
        );

        self::assertSame('', $request->getHeaderLine('Authorization'));
        self::assertJson((string) $request->getBody());
    }

    public function testDocumentedHttpErrorsBecomeApiExceptions(): void
    {
        $mock = new MockHandler([
            new Response(401, ['Content-Language' => 'en', 'X-Request-ID' => 'req-1'], '{"detail":"Invalid key"}'),
        ]);
        $httpClient = new GuzzleClient(['handler' => HandlerStack::create($mock)]);
        $client = Client::builder()->withApiKey('invalid')->withHttpClient($httpClient)->build();

        try {
            $client->profile()->get();
            self::fail('Expected an API exception.');
        } catch (ApiException $exception) {
            self::assertSame(401, $exception->getStatusCode());
            self::assertSame(ErrorKind::Authentication, $exception->getErrorKind());
            self::assertSame('Invalid key', $exception->getDetail());
            self::assertSame('req-1', $exception->getRequestId());
        }
    }

    public function testRawEscapeHatchUsesConfiguredAuthentication(): void
    {
        $mock = new MockHandler([new Response(200, [], '{"ok":true}')]);
        $httpClient = new GuzzleClient(['handler' => HandlerStack::create($mock)]);
        $client = Client::builder()->withApiKey('key')->withHttpClient($httpClient)->build();

        $response = $client->raw('GET', '/future', ['limit' => 10]);
        $request = $mock->getLastRequest();

        self::assertSame(200, $response->getStatusCode());
        self::assertNotNull($request);
        self::assertSame('Static key', $request->getHeaderLine('Authorization'));
        self::assertSame('https://api.proxyrequest.com/api/v1/future?limit=10', (string) $request->getUri());
    }

    public function testInvoicePdfCanBeDownloadedThroughTheConvenienceApi(): void
    {
        $mock = new MockHandler([new Response(200, ['Content-Type' => 'application/pdf'], '%PDF-1.7 test')]);
        $httpClient = new GuzzleClient(['handler' => HandlerStack::create($mock)]);
        $client = Client::builder()->withApiKey('key')->withHttpClient($httpClient)->build();

        $download = $client->downloadInvoicePdf('invoice-1');
        $request = $mock->getLastRequest();

        self::assertSame('invoice-invoice-1.pdf', $download->filename);
        self::assertSame('application/pdf', $download->contentType);
        self::assertSame('%PDF-1.7 test', $download->contents());
        self::assertSame(13, $download->size());
        self::assertNotNull($request);
        self::assertSame('Static key', $request->getHeaderLine('Authorization'));
    }

    public function testTelegramServiceUsesItsDedicatedCredentialHeader(): void
    {
        $request = Client::anonymous()->telegramService()->createSessionRequest(
            'telegram-service-secret',
            new TelegramSessionRequest(['telegramUserId' => 100, 'chatId' => 200]),
        );

        self::assertSame('telegram-service-secret', $request->getHeaderLine('X-ProxyRequest-Telegram-Secret'));
        self::assertSame('', $request->getHeaderLine('Authorization'));
        self::assertJsonStringEqualsJsonString(
            '{"telegram_user_id":100,"chat_id":200}',
            (string) $request->getBody(),
        );
    }

    public function testDefaultIdempotencyIsLimitedToSupportedMutations(): void
    {
        $history = [];
        $mock = new MockHandler([
            new Response(201, [], '{"endpoint":"https://example.com/hook","created":"2026-01-01T00:00:00Z"}'),
            new Response(201, [], '{"title":"test","key":"secret","created":"2026-01-01T00:00:00Z"}'),
        ]);
        $stack = HandlerStack::create($mock);
        $stack->push(Middleware::history($history));
        $client = Client::builder()
            ->withApiKey('key')
            ->withHttpClient(new GuzzleClient(['handler' => $stack]))
            ->build();

        $client->webhooks()->create(new WebhookCreateRequest([
            'type' => WebhookScopeEnum::USER,
            'endpoint' => 'https://example.com/hook',
        ]));
        $client->apiKeys()->create();

        self::assertNotSame('', $history[0]['request']->getHeaderLine('Idempotency-Key'));
        self::assertSame('', $history[1]['request']->getHeaderLine('Idempotency-Key'));
    }

    public function testAmbiguousRetriesReuseKeyAndExposeMetadata(): void
    {
        $history = [];
        $mock = new MockHandler([
            new ConnectException('connection reset', new Request('POST', '/webhooks')),
            new Response(409, ['Retry-After' => '0'], '{"detail":"Still in progress."}'),
            new Response(
                201,
                ['ETag' => '"webhook-v1"', 'Idempotency-Replayed' => 'true'],
                '{"endpoint":"https://example.com/hook","created":"2026-01-01T00:00:00Z"}',
            ),
        ]);
        $stack = HandlerStack::create($mock);
        $stack->push(Middleware::history($history));
        $client = Client::builder()
            ->withApiKey('key')
            ->withHttpClient(new GuzzleClient(['handler' => $stack]))
            ->build();

        $response = $client->webhooks()->createWithResponse(
            new WebhookCreateRequest([
                'type' => WebhookScopeEnum::USER,
                'endpoint' => 'https://example.com/hook',
            ]),
            'webhook-create-1',
        );

        self::assertInstanceOf(ApiResponse::class, $response);
        self::assertSame(201, $response->statusCode);
        self::assertSame('"webhook-v1"', $response->etag());
        self::assertTrue($response->idempotencyReplayed());
        self::assertCount(3, $history);
        foreach ($history as $transaction) {
            self::assertSame('webhook-create-1', $transaction['request']->getHeaderLine('Idempotency-Key'));
        }
    }

    public function testAutomaticIdempotencyCanBeDisabledWithoutBlockingExplicitKeys(): void
    {
        $history = [];
        $mock = new MockHandler([
            new Response(201, [], '{"endpoint":"https://example.com/hook","created":"2026-01-01T00:00:00Z"}'),
            new Response(201, [], '{"endpoint":"https://example.com/hook","created":"2026-01-01T00:00:00Z"}'),
        ]);
        $stack = HandlerStack::create($mock);
        $stack->push(Middleware::history($history));
        $client = Client::builder()
            ->withApiKey('key')
            ->withIdempotency(false)
            ->withHttpClient(new GuzzleClient(['handler' => $stack]))
            ->build();
        $body = new WebhookCreateRequest([
            'type' => WebhookScopeEnum::USER,
            'endpoint' => 'https://example.com/hook',
        ]);

        $client->webhooks()->create($body);
        $client->webhooks()->create($body, 'manual-key');

        self::assertSame('', $history[0]['request']->getHeaderLine('Idempotency-Key'));
        self::assertSame('manual-key', $history[1]['request']->getHeaderLine('Idempotency-Key'));
    }

    public function testIdempotentOperationsDoNotRetryOrdinaryServerErrors(): void
    {
        $history = [];
        $mock = new MockHandler([
            new Response(500, [], '{"detail":"Unavailable"}'),
        ]);
        $stack = HandlerStack::create($mock);
        $stack->push(Middleware::history($history));
        $client = Client::builder()
            ->withApiKey('key')
            ->withHttpClient(new GuzzleClient(['handler' => $stack]))
            ->build();

        try {
            $client->webhooks()->create(
                new WebhookCreateRequest([
                    'type' => WebhookScopeEnum::USER,
                    'endpoint' => 'https://example.com/hook',
                ]),
                'webhook-no-retry',
            );
            self::fail('Expected a server exception.');
        } catch (ApiException $exception) {
            self::assertSame(ErrorKind::Server, $exception->getErrorKind());
            self::assertSame('webhook-no-retry', $exception->getIdempotencyKey());
        }

        self::assertCount(1, $history);
    }

    public function testIfMatchAndPreconditionMetadataAreExposed(): void
    {
        $history = [];
        $mock = new MockHandler([
            new Response(412, ['ETag' => '"user-v2"'], '{"detail":"The resource changed."}'),
        ]);
        $stack = HandlerStack::create($mock);
        $stack->push(Middleware::history($history));
        $client = Client::builder()
            ->withApiKey('key')
            ->withHttpClient(new GuzzleClient(['handler' => $stack]))
            ->build();

        try {
            $client->users()->update(
                '00000000-0000-4000-8000-000000000001',
                '"user-v1"',
                null,
                new PatchedUserUpdateRequest(['firstName' => 'Ada']),
            );
            self::fail('Expected a precondition exception.');
        } catch (ApiException $exception) {
            self::assertSame(ErrorKind::Precondition, $exception->getErrorKind());
            self::assertSame('"user-v2"', $exception->getCurrentEtag());
        }
        self::assertSame('"user-v1"', $history[0]['request']->getHeaderLine('If-Match'));
    }
}
