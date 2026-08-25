<?php

declare(strict_types=1);

namespace ProxyRequest\Tests\Contract;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Yaml\Yaml;

#[CoversNothing]
final class OpenApiCoverageTest extends TestCase
{
    /** @var array<string, class-string> */
    private const RESOURCE_BY_TAG = [
        'API Keys' => \ProxyRequest\Resource\APIKeysResource::class,
        'Affiliates' => \ProxyRequest\Resource\AffiliatesResource::class,
        'Analytics' => \ProxyRequest\Resource\AnalyticsResource::class,
        'Authorization' => \ProxyRequest\Resource\AuthorizationResource::class,
        'Coupons' => \ProxyRequest\Resource\CouponsResource::class,
        'Invoices' => \ProxyRequest\Resource\InvoicesResource::class,
        'Locations' => \ProxyRequest\Resource\LocationsResource::class,
        'News' => \ProxyRequest\Resource\NewsResource::class,
        'Orders' => \ProxyRequest\Resource\OrdersResource::class,
        'Packages' => \ProxyRequest\Resource\PackagesResource::class,
        'Profile' => \ProxyRequest\Resource\ProfileResource::class,
        'Proxies' => \ProxyRequest\Resource\ProxiesResource::class,
        'Rewards' => \ProxyRequest\Resource\RewardsResource::class,
        'Sessions' => \ProxyRequest\Resource\SessionsResource::class,
        'Settings' => \ProxyRequest\Resource\SettingsResource::class,
        'Telegram dashboard' => \ProxyRequest\Resource\TelegramDashboardResource::class,
        'Telegram dashboard service' => \ProxyRequest\Resource\TelegramDashboardServiceResource::class,
        'Users' => \ProxyRequest\Resource\UsersResource::class,
        'Webhooks' => \ProxyRequest\Resource\WebhooksResource::class,
    ];

    public function testEveryOpenApiOperationHasAResourceMethod(): void
    {
        $root = \dirname(__DIR__, 2);
        $openApi = Yaml::parseFile($root . '/openapi/openapi.yaml');
        $generator = Yaml::parseFile($root . '/openapi/generator.yaml');
        $mappings = $generator['operationIdNameMappings'] ?? [];
        self::assertIsArray($mappings);

        $covered = 0;
        foreach ($openApi['paths'] ?? [] as $path => $pathItem) {
            foreach (['get', 'post', 'put', 'patch', 'delete'] as $httpMethod) {
                if (!isset($pathItem[$httpMethod])) {
                    continue;
                }

                $operation = $pathItem[$httpMethod];
                $operationId = $operation['operationId'];
                $tag = $operation['tags'][0];
                self::assertArrayHasKey($operationId, $mappings, \sprintf('%s %s has no public name.', strtoupper($httpMethod), $path));
                self::assertArrayHasKey($tag, self::RESOURCE_BY_TAG, \sprintf('Tag "%s" has no resource class.', $tag));
                self::assertTrue(
                    method_exists(self::RESOURCE_BY_TAG[$tag], $mappings[$operationId]),
                    \sprintf('%s::%s() is missing for %s.', self::RESOURCE_BY_TAG[$tag], $mappings[$operationId], $operationId),
                );
                self::assertTrue(
                    method_exists(self::RESOURCE_BY_TAG[$tag], $mappings[$operationId] . 'WithResponse'),
                    \sprintf('%s::%sWithResponse() is missing for %s.', self::RESOURCE_BY_TAG[$tag], $mappings[$operationId], $operationId),
                );
                ++$covered;
            }
        }

        self::assertSame(82, $covered);
        self::assertCount(82, $mappings);
    }

    public function testVendoredSchemaMatchesItsManifest(): void
    {
        $root = \dirname(__DIR__, 2);
        $manifest = json_decode((string) file_get_contents($root . '/openapi/source.json'), true, 512, JSON_THROW_ON_ERROR);

        self::assertSame($manifest['sha256'], hash_file('sha256', $root . '/openapi/openapi.yaml'));
        self::assertSame(82, $manifest['operations']);
        self::assertSame(127, $manifest['schemas']);
    }
}
