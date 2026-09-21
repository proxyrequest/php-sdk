<?php

declare(strict_types=1);

namespace ProxyRequest\Tests\Contract;

use JsonException;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\TestCase;

#[CoversNothing]
final class ReferenceManifestTest extends TestCase
{
    /** @throws JsonException */
    public function testManifestCoversEverySupportedOperationAndExamplesParse(): void
    {
        $path = \dirname(__DIR__, 2) . '/docs/reference/sdk-reference.json';
        self::assertFileExists($path);
        $manifest = json_decode((string) file_get_contents($path), true, 512, JSON_THROW_ON_ERROR);
        $methods = [];

        foreach ($manifest['resources'] as $resource) {
            foreach ($resource['methods'] as $method) {
                $methods[] = $method;
            }
        }

        $expected = $manifest['sdk']['openapi']['operations'] - \count($manifest['sdk']['openapi']['excludedOperations']);
        self::assertSame(3, $manifest['schemaVersion']);
        self::assertSame('3.0.0', $manifest['sdk']['version']);
        self::assertCount($expected, $methods);
        self::assertCount(\count($methods), array_unique(array_column($methods, 'operationId')));
        self::assertGreaterThan(100, \count($manifest['models']));
        $models = array_column($manifest['models'], null, 'name');
        $modelNames = array_fill_keys(array_keys($models), true);

        foreach ($methods as $method) {
            self::assertNotEmpty($method['returns']['type']);
            self::assertSame('ApiException', $method['throws'][0]['type']);
            self::assertSame('InvalidArgumentException', $method['throws'][1]['type']);
            self::assertNotEmpty($method['throws'][0]['conditions']);
            $typedValues = [...$method['parameters'], $method['returns']];
            if (null !== $method['body']) {
                $typedValues[] = $method['body'];
            }
            foreach ($typedValues as $value) {
                self::assertSame([], array_diff($value['modelRefs'], array_keys($modelNames)));
            }
        }
        foreach ($models as $model) {
            foreach ($model['fields'] as $field) {
                self::assertSame([], array_diff($field['modelRefs'], array_keys($modelNames)));
            }
        }
        $settingsMethod = current(array_filter($methods, static fn(array $method): bool => 'settings_retrieve' === $method['operationId']));
        self::assertIsArray($settingsMethod);
        self::assertSame(['SettingsResponse'], $settingsMethod['returns']['modelRefs']);
        self::assertNotEmpty($models['InvoiceRead']['fields']);
        self::assertNotEmpty($models['PaginatedAPIKeyList']['fields']);

        foreach ($methods as $method) {
            $temporaryFile = tempnam(sys_get_temp_dir(), 'proxyrequest-reference-');
            self::assertNotFalse($temporaryFile);

            try {
                file_put_contents($temporaryFile, "<?php\nif (false) {\n" . $method['example']['code'] . "\n}\n");
                $output = [];
                $exitCode = 0;
                exec(escapeshellarg(PHP_BINARY) . ' -l ' . escapeshellarg($temporaryFile) . ' 2>&1', $output, $exitCode);
                self::assertSame(0, $exitCode, $method['operationId'] . ': ' . implode(PHP_EOL, $output));
            } finally {
                unlink($temporaryFile);
            }
        }
    }
}
