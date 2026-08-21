<?php

declare(strict_types=1);

namespace ProxyRequest\Tests\Unit;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use ProxyRequest\ApiException;
use ProxyRequest\Client;
use ProxyRequest\Dto\LoginRequest;
use ProxyRequest\Dto\TelegramSessionRequest;
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
}
