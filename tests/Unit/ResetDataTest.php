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
use ProxyRequest\Dto\Order;
use ProxyRequest\Dto\ResetDataRequest;

final class ResetDataTest extends TestCase
{
    public function testResetSendsOnlyPackageAndReusesRetryKey(): void
    {
        foreach ([false, true] as $async) {
            $history = [];
            $mock = new MockHandler([
                new ConnectException('connection reset', new Request('POST', '/users/customer/data/reset')),
                new Response(202, [], '{"data_remaining":0,"data_spent":10,"data":10}'),
            ]);
            $stack = HandlerStack::create($mock);
            $stack->push(Middleware::history($history));
            $client = Client::builder()->withApiKey('secret')
                ->withHttpClient(new GuzzleClient(['handler' => $stack]))->build();
            $body = new ResetDataRequest(['packageId' => '78b4ccde-49a7-4e1d-99ce-b56b875d8a11']);
            $order = $async ? $client->users()->resetDataAsync('customer', $body)->wait()
                : $client->users()->resetData('customer', $body);
            self::assertInstanceOf(Order::class, $order);
            self::assertSame(0, $order->getDataRemaining());
            self::assertCount(2, $history);
            $key = $history[0]['request']->getHeaderLine('Idempotency-Key');
            self::assertNotSame('', $key);
            foreach ($history as $transaction) {
                $request = $transaction['request'];
                self::assertSame('POST', $request->getMethod());
                self::assertSame('/api/v1/users/customer/data/reset', $request->getUri()->getPath());
                self::assertSame(['package_id' => '78b4ccde-49a7-4e1d-99ce-b56b875d8a11'], json_decode((string) $request->getBody(), true));
                self::assertSame($key, $request->getHeaderLine('Idempotency-Key'));
            }
        }
    }
}
