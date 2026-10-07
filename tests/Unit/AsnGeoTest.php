<?php

declare(strict_types=1);

namespace ProxyRequest\Tests\Unit;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use ProxyRequest\Client;

final class AsnGeoTest extends TestCase
{
    public function testOptionalGeoPreservesPositionalArguments(): void
    {
        $resource = Client::withApiKey('key')->locations();
        $legacy = ['packageId', 'code', 'countryCode', 'global', 'limit', 'name', 'offset', 'ordering', 'search', 'acceptLanguage', 'contentType'];
        foreach (['', 'WithResponse', 'WithHttpInfo', 'Async', 'AsyncWithHttpInfo', 'Request'] as $suffix) {
            $parameters = new \ReflectionMethod($resource, 'listAsns' . $suffix)->getParameters();
            self::assertSame([...$legacy, 'includeGeo'], array_map(static fn(\ReflectionParameter $parameter): string => $parameter->getName(), $parameters));
        }

        $previousCall = $resource->listAsnsRequest('package', null, null, null, 5, null, null, null, null, 'uk', 'application/json');
        parse_str($previousCall->getUri()->getQuery(), $query);
        self::assertSame('5', $query['limit']);
        self::assertArrayNotHasKey('include_geo', $query);
        self::assertSame('uk', $previousCall->getHeaderLine('Accept-Language'));

        $request = $resource->listAsnsRequest('package', includeGeo: true);
        parse_str($request->getUri()->getQuery(), $query);
        self::assertSame('true', $query['include_geo']);
    }

    public function testCountryCodesAndRequestedGeoDeserialize(): void
    {
        $payload = [
            'count' => 1,
            'next' => null,
            'previous' => null,
            'results' => [[
                'code' => '7922',
                'name' => 'Example ASN',
                'country_codes' => ['us'],
                'geo' => [['country' => ['code' => 'us', 'name' => 'United States']]],
            ]],
        ];
        $mock = new MockHandler([new Response(200, [], json_encode($payload, JSON_THROW_ON_ERROR))]);
        $client = Client::builder()->withApiKey('key')->withHttpClient(new GuzzleClient(['handler' => HandlerStack::create($mock)]))->build();
        $record = $client->locations()->listAsns(packageId: 'package', includeGeo: true)->getResults()[0];

        self::assertSame(['us'], $record->getCountryCodes());
        self::assertCount(1, $record->getGeo());
        self::assertSame('us', $record->getGeo()[0]->getCountry()->getCode());
    }
}
