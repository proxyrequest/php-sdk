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
use ProxyRequest\Client;
use ProxyRequest\Dto\PurchaseMutationRequest;
use ProxyRequest\Dto\ResetPasswordRequest;

final class StaticRentalsTest extends TestCase
{
    public function testExportPreservesPlainTextAndQueryParametersSyncAndAsync(): void
    {
        $text = "socks5://proxy-user:proxy-password@192.0.2.1:1080\n";
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'text/plain', 'Cache-Control' => 'no-store'], $text),
            new Response(200, ['Content-Type' => 'text/plain'], ''),
        ]);
        $resource = self::client(HandlerStack::create($mock))->staticProxies();

        $response = $resource->exportUrlsWithResponse(orderId: 'rental-id', protocol: 'socks5');
        self::assertSame($text, $response->data);
        self::assertSame(200, $response->statusCode);
        self::assertSame('order_id=rental-id&protocol=socks5', $mock->getLastRequest()->getUri()->getQuery());
        self::assertStringContainsString('text/plain', $mock->getLastRequest()->getHeaderLine('Accept'));
        self::assertSame('', $resource->exportUrlsAsync()->wait());
    }

    public function testReserveRetriesWithTheSameKeyAcrossBothTransports(): void
    {
        foreach ([false, true] as $async) {
            foreach ([null, 'legacy-key'] as $legacyKey) {
                $history = [];
                $mock = new MockHandler([
                    new ConnectException('connection lost', new Request('POST', '/orders/purchase')),
                    new Response(201, ['Idempotency-Replayed' => 'true'], '{"id":"rental-1","order_id":"rental-1","status":"reserved"}'),
                ]);
                $stack = HandlerStack::create($mock);
                $stack->push(Middleware::history($history));
                $resource = self::client($stack)->orders();
                $request = new PurchaseMutationRequest(['offerId' => 'offer-1', 'idempotencyKey' => $legacyKey]);
                if ($async) {
                    $order = $resource->reserveAsync(purchaseMutationRequest: $request)->wait();
                } else {
                    $response = $resource->reserveWithResponse(purchaseMutationRequest: $request);
                    self::assertTrue($response->idempotencyReplayed());
                    $order = $response->data;
                }
                self::assertSame('rental-1', $order->getOrderId());
                self::assertCount(2, $history);
                $key = $history[0]['request']->getHeaderLine('Idempotency-Key');
                self::assertNotSame('', $key);
                self::assertSame($key, $history[1]['request']->getHeaderLine('Idempotency-Key'));
                self::assertSame((string) $history[0]['request']->getBody(), (string) $history[1]['request']->getBody());
                if (null !== $legacyKey) {
                    self::assertSame($legacyKey, $key);
                    self::assertSame($legacyKey, json_decode((string) $history[0]['request']->getBody(), true)['idempotency_key']);
                }
            }
        }
    }

    public function testLegacyResetPasswordStillAcceptsTheOrderModel(): void
    {
        $request = Client::withApiKey('key')->orders()->resetPasswordRequest(new ResetPasswordRequest(['orderId' => 'order-1']));

        self::assertSame('/api/v1/reset-password', $request->getUri()->getPath());
        self::assertSame('Static key', $request->getHeaderLine('Authorization'));
        self::assertSame(['order_id' => 'order-1'], json_decode((string) $request->getBody(), true));
    }

    public function testRotateAnEndpointCredentialGroupAndReadItsStatus(): void
    {
        $mock = new MockHandler([
            new Response(200, [], '{"success":true,"message":"Password reset successfully."}'),
            new Response(202, [], '{"success":true,"message":"Password rotation queued."}'),
            new Response(200, [], '{"id":"endpoint-1","password_rotation_status":"succeeded"}'),
        ]);
        $client = self::client(HandlerStack::create($mock));
        $orders = $client->orders();

        $done = $orders->resetProxyPassword('order-1', 'fr', 'application/json', 'user-1');
        self::assertTrue($done->getSuccess());
        self::assertSame('', $mock->getLastRequest()->getUri()->getQuery());
        self::assertSame('fr', $mock->getLastRequest()->getHeaderLine('Accept-Language'));
        self::assertSame('user-1', $mock->getLastRequest()->getHeaderLine('X-Impersonate-User'));

        $queued = $orders->resetProxyPasswordWithResponse('order-1', endpointId: 'endpoint-1');
        self::assertSame(202, $queued->statusCode);
        self::assertTrue($queued->data->getSuccess());
        self::assertSame('endpoint_id=endpoint-1', $mock->getLastRequest()->getUri()->getQuery());

        $endpoint = $client->staticProxies()->getEndpointAsync('endpoint-1')->wait();
        self::assertSame('succeeded', $endpoint->getPasswordRotationStatus());
    }

    private static function client(HandlerStack $stack): Client
    {
        return Client::builder()->withApiKey('key')->withHttpClient(new GuzzleClient(['handler' => $stack]))->build();
    }
}
