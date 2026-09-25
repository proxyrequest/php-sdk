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
use ProxyRequest\ObjectSerializer;

final class ProviderBalancesTest extends TestCase
{
    private static function client(MockHandler $mock): Client
    {
        return Client::builder()->withApiKey('superuser-key')->withHttpClient(new GuzzleClient(['handler' => HandlerStack::create($mock)]))->build();
    }

    public function testBalancesPreserveStringsNullsAndHistory(): void
    {
        $fixtures = json_decode((string) file_get_contents(\dirname(__DIR__) . '/fixtures/provider-balances.json'), true, 512, JSON_THROW_ON_ERROR);
        foreach ($fixtures as $payload) {
            foreach (['listDataBalances', 'listDataBalancesWithResponse', 'listDataBalancesAsync', 'listDataBalancesAsyncWithHttpInfo'] as $method) {
                $mock = new MockHandler([new Response(200, [], json_encode($payload, JSON_THROW_ON_ERROR))]);
                $response = self::client($mock)->providers()->{$method}(limit: 5, offset: 10);
                if (str_contains($method, 'Async')) {
                    $response = $response->wait();
                }
                $page = str_ends_with($method, 'WithResponse') ? $response->data : (str_ends_with($method, 'WithHttpInfo') ? $response[0] : $response);
                self::assertSame($payload['count'], $page->getCount());
                self::assertCount(\count($payload['results']), $page->getResults());
                $encoded = json_decode(json_encode(ObjectSerializer::sanitizeForSerialization($page), JSON_THROW_ON_ERROR), true, 512, JSON_THROW_ON_ERROR);
                foreach ($payload['results'] as $index => $row) {
                    foreach (['available_bytes', 'used_bytes', 'remaining_bytes', 'remaining_percent', 'severity', 'freshness', 'error'] as $field) {
                        self::assertEquals($row[$field], $encoded['results'][$index][$field]);
                    }
                    self::assertSame($row['available_bytes'], $page->getResults()[$index]->getAvailableBytes());
                    self::assertSame($row['remaining_bytes'], $page->getResults()[$index]->getRemainingBytes());
                    self::assertCount(2, $page->getResults()[$index]->getHistory());
                    self::assertNull($page->getResults()[$index]->getHistory()[0]->getCreatedBy());
                }
                self::assertSame('/api/v1/providers/data-balances', $mock->getLastRequest()->getUri()->getPath());
                self::assertSame('limit=5&offset=10', $mock->getLastRequest()->getUri()->getQuery());
                self::assertSame('Static superuser-key', $mock->getLastRequest()->getHeaderLine('Authorization'));
            }
        }
    }

    public function testBearerAuthenticationAndPermissionErrors(): void
    {
        self::assertSame('Bearer superuser-token', Client::withBearerToken('superuser-token')->providers()->listDataBalancesRequest()->getHeaderLine('Authorization'));
        foreach ([401, 403] as $status) {
            $mock = new MockHandler([new Response($status, [], '{"detail":"Access denied"}')]);
            try {
                self::client($mock)->providers()->listDataBalances();
                self::fail('Expected an API error');
            } catch (ApiException $error) {
                self::assertSame($status, $error->getCode());
            }
        }
    }

    public function testPaginationKeepsHistoryNested(): void
    {
        $payload = json_decode((string) file_get_contents(\dirname(__DIR__) . '/fixtures/provider-balances.json'), true, 512, JSON_THROW_ON_ERROR)['fresh'];
        $payload['count'] = 2;
        $first = $payload;
        $first['next'] = 'https://api.proxyrequest.com/api/v1/providers/data-balances?limit=1&offset=1';
        $mock = new MockHandler([new Response(200, [], json_encode($first, JSON_THROW_ON_ERROR)), new Response(200, [], json_encode($payload, JSON_THROW_ON_ERROR))]);
        $client = self::client($mock);
        $rows = iterator_to_array($client->paginate(fn(int $limit, int $offset) => $client->providers()->listDataBalances($limit, $offset), limit: 1));
        self::assertCount(2, $rows);
        self::assertCount(2, $rows[0]->getHistory());
        self::assertSame('limit=1&offset=1', $mock->getLastRequest()->getUri()->getQuery());
    }

    public function testLocationArgumentCompatibility(): void
    {
        $resource = self::client(new MockHandler())->locations();
        $legacy = [
            'getCity' => ['id', 'packageId', 'acceptLanguage', 'contentType'],
            'getCountry' => ['id', 'packageId', 'acceptLanguage', 'contentType'],
            'getRegion' => ['id', 'packageId', 'acceptLanguage', 'contentType'],
            'listCities' => ['packageId', 'code', 'countryCode', 'limit', 'name', 'offset', 'ordering', 'regionCode', 'search', 'acceptLanguage', 'contentType'],
            'listCountries' => ['packageId', 'code', 'limit', 'name', 'offset', 'ordering', 'search', 'acceptLanguage', 'contentType'],
            'listRegions' => ['packageId', 'code', 'countryCode', 'limit', 'name', 'offset', 'ordering', 'search', 'acceptLanguage', 'contentType'],
        ];
        foreach ($legacy as $method => $names) {
            foreach (['', 'WithResponse', 'WithHttpInfo', 'Async', 'AsyncWithHttpInfo', 'Request'] as $suffix) {
                $parameters = new \ReflectionMethod($resource, $method . $suffix)->getParameters();
                self::assertSame([...$names, 'includeAsns'], array_map(static fn(\ReflectionParameter $parameter): string => $parameter->getName(), $parameters));
            }
            $arguments = ['packageId' => 'package'];
            if (str_starts_with($method, 'get')) {
                $arguments['id'] = 'location';
            }
            foreach ([null, false, true] as $include) {
                $request = $resource->{$method . 'Request'}(...[...$arguments, 'includeAsns' => $include]);
                parse_str($request->getUri()->getQuery(), $query);
                self::assertSame(null === $include ? null : ($include ? 'true' : 'false'), $query['include_asns'] ?? null);
            }
        }
        $request = $resource->getCountryRequest('country', 'package', 'uk', 'application/json');
        self::assertSame('uk', $request->getHeaderLine('Accept-Language'));
        self::assertSame('package_id=package', $request->getUri()->getQuery());
    }
}
