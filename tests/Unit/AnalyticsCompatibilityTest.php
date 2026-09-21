<?php

declare(strict_types=1);

namespace ProxyRequest\Tests\Unit;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use ProxyRequest\Client;
use ProxyRequest\ObjectSerializer;

final class AnalyticsCompatibilityTest extends TestCase
{
    private static function client(MockHandler $mock): Client
    {
        return Client::builder()->anonymous()->withHttpClient(new GuzzleClient(['handler' => HandlerStack::create($mock), 'http_errors' => false]))->build();
    }

    public function testExactFeedIdsUnderFrameworkErrorHandler(): void
    {
        $raw = (string) file_get_contents(\dirname(__DIR__) . '/fixtures/analytics-large-ids.json');
        $expected = array_map(static fn(array $row): string => (string) $row['id'], json_decode($raw, true, 512, JSON_THROW_ON_ERROR | JSON_BIGINT_AS_STRING)['results']);
        foreach ([false, true] as $async) {
            foreach ([false, true] as $metadata) {
                $mock = new MockHandler([new Response(200, ['X-Request-ID' => 'large-ids'], $raw)]);
                $method = 'listFeed' . ($async ? 'Async' : '') . ($metadata ? 'WithHttpInfo' : '');
                set_error_handler(static function (int $severity, string $message, string $file, int $line): never {
                    throw new \ErrorException($message, 0, $severity, $file, $line);
                });
                try {
                    $response = self::client($mock)->analytics()->{$method}();
                    $response = $async ? $response->wait() : $response;
                    $page = $metadata ? $response[0] : $response;
                } finally {
                    restore_error_handler();
                }
                self::assertSame($expected, array_map(static fn($record): string => $record->getId(), $page->getResults()));
                $encoded = json_decode(json_encode(ObjectSerializer::sanitizeForSerialization($page), JSON_THROW_ON_ERROR), true, 512, JSON_THROW_ON_ERROR);
                self::assertSame($expected, array_column($encoded['results'], 'id'));
                self::assertIsInt($encoded['count']);
                self::assertIsInt($encoded['results'][0]['data']);
                self::assertSame(0, \count($mock));
                if ($metadata) {
                    self::assertSame(200, $response[1]);
                    self::assertSame(['large-ids'], $response[2]['X-Request-ID']);
                }
            }
        }
    }

    public function testAnalyticsDatesAndLegacyParameters(): void
    {
        $dates = [
            '2026-07-01T00:00:00Z', '2026-07-01T03:04:59.123+03:00',
            '2026-07-01T00:00:00', '2026-07-01 00:00:00', '01-07-2026 00:00:00',
            '2026-07-01', '01-07-2026', '1782864000', '1782864000.5',
            1782864000, 1782864000.5, 0,
            new \DateTime('2026-07-01T03:04:59+03:00'),
            new \DateTimeImmutable('2026-07-01T03:04:59+03:00'),
        ];
        $resource = self::client(new MockHandler())->analytics();
        foreach (['getOverall', 'getTransactions', 'listFeed', 'listDomains', 'listLogs'] as $operation) {
            foreach ($dates as $value) {
                $arguments = ['start' => $value, 'end' => $value, 'timezone' => 'Europe/Kiev'];
                if ('getTransactions' === $operation) {
                    $arguments['id'] = 'customer';
                }
                $request = $resource->{$operation . 'Request'}(...$arguments);
                parse_str($request->getUri()->getQuery(), $query);
                $expected = $value instanceof \DateTimeInterface ? ObjectSerializer::toString(\DateTime::createFromInterface($value)) : (string) $value;
                self::assertSame($expected, $query['start']);
                self::assertSame($expected, $query['end']);
                self::assertSame('Europe/Kiev', $query['timezone']);
            }
        }
        parse_str($resource->listFeedRequest()->getUri()->getQuery(), $query);
        self::assertArrayNotHasKey('start', $query);
        self::assertArrayNotHasKey('end', $query);
        parse_str($resource->listLogsRequest(hostname: 'example.com')->getUri()->getQuery(), $query);
        self::assertSame('example.com', $query['hostname']);
        // The fifth positional argument was hostname in 2.x; headers stay last.
        parse_str($resource->listLogsRequest(null, null, null, null, 'legacy.example')->getUri()->getQuery(), $query);
        self::assertSame('legacy.example', $query['hostname']);
        foreach (['listLogs', 'listLogsRequest', 'listLogsAsync', 'listLogsWithResponse', 'listLogsWithHttpInfo', 'listLogsAsyncWithHttpInfo'] as $method) {
            $parameters = new \ReflectionMethod($resource, $method)->getParameters();
            self::assertSame('hostname', $parameters[4]->getName());
            self::assertSame('acceptLanguage', $parameters[14]->getName());
        }
        foreach ([false, true] as $include) {
            parse_str($resource->listDomainsRequest(hostname: 'https://example.com:443/path,192.0.2.1,[2001:db8::1]:80', includeSubUsers: $include)->getUri()->getQuery(), $query);
            self::assertSame($include ? 'true' : 'false', $query['include_sub_users']);
            self::assertSame('https://example.com:443/path,192.0.2.1,[2001:db8::1]:80', $query['hostname']);
        }
    }

    public function testDomainSerializationDoesNotInventTimestamp(): void
    {
        $fixture = json_decode((string) file_get_contents(\dirname(__DIR__) . '/fixtures/analytics-responses.json'), true, 512, JSON_THROW_ON_ERROR)['domains_first'];
        $mock = new MockHandler([new Response(200, [], json_encode($fixture, JSON_THROW_ON_ERROR))]);
        $page = self::client($mock)->analytics()->listDomains();
        $serialized = ObjectSerializer::sanitizeForSerialization($page);
        self::assertObjectNotHasProperty('timestamp', $serialized->results[0]);
        self::assertObjectNotHasProperty('count', $serialized);
    }
}
