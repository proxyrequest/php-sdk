<?php

declare(strict_types=1);

use Symfony\Component\Yaml\Yaml;

require \dirname(__DIR__) . '/vendor/autoload.php';

$root = \dirname(__DIR__);
$schema = Yaml::parseFile($root . '/openapi/openapi.yaml');
$config = Yaml::parseFile($root . '/openapi/generator.yaml');
$package = json_decode((string) file_get_contents($root . '/composer.json'), true, 512, JSON_THROW_ON_ERROR);
$source = json_decode((string) file_get_contents($root . '/openapi/source.json'), true, 512, JSON_THROW_ON_ERROR);
$excluded = ['sessions_destroy', 'sessions_list'];

/**  */
function clean($value): string
{
    return trim((string) preg_replace('/\s+/', ' ', (string) ($value ?? '')));
}

/** @param array<string, mixed> $schema @param array<string, mixed> $value @return array<string, mixed> */
function dereference(array $schema, array $value, string $section): array
{
    $reference = $value['$ref'] ?? null;
    $prefix = '#/components/' . $section . '/';
    if (\is_string($reference) && str_starts_with($reference, $prefix)) {
        return $schema['components'][$section][substr($reference, \strlen($prefix))] ?? $value;
    }

    return $value;
}

/** @param array<string, mixed> $value @param array<string, string> $publicBySource */
function typeOf(array $value, array $publicBySource): string
{
    if (isset($value['$ref'])) {
        $sourceName = basename((string) $value['$ref']);

        return $publicBySource[$sourceName] ?? $sourceName;
    }
    $variants = $value['oneOf'] ?? $value['anyOf'] ?? $value['allOf'] ?? null;
    if (\is_array($variants)) {
        return implode('|', array_values(array_unique(array_map(static fn(array $variant): string => typeOf($variant, $publicBySource), $variants))));
    }

    return match ($value['type'] ?? null) {
        'array' => 'array<' . typeOf($value['items'] ?? [], $publicBySource) . '>',
        'object' => 'array<string, mixed>',
        'boolean' => 'bool',
        'integer' => 'int',
        'number' => 'float',
        'null' => 'null',
        default => isset($value['properties']) ? 'array<string, mixed>' : 'string',
};
}

function markdownType(string $value): string
{
    $value = html_entity_decode($value, ENT_QUOTES | ENT_HTML5);
    $value = preg_replace('/\[([^]]+)\]\([^)]+\)/', '$1', $value) ?? $value;
    $value = str_replace(['**', '\\ProxyRequest\\Dto\\'], '', $value);
    $value = ltrim(trim($value), '\\');
    if (str_ends_with($value, '[]')) {
        return 'array<' . substr($value, 0, -2) . '>';
    }

    return $value;
}

/** @return list<array{name: string, wireName: string, type: string, required: bool, default: null, description: string, enum: null}> */
function markdownFields(string $path): array
{
    $fields = [];
    foreach (file($path, FILE_IGNORE_NEW_LINES) ?: [] as $line) {
        $columns = preg_split('/\s+\|\s+/', trim($line), 4);
        if (!\is_array($columns) || \count($columns) < 3 || !preg_match('/^\*\*([^*]+)\*\*$/', $columns[0], $name)) {
            continue;
        }
        $notes = $columns[3] ?? '';
        $fields[] = [
            'name' => $name[1],
            'wireName' => $name[1],
            'type' => markdownType($columns[1]),
            'required' => !str_contains($notes, '[optional]'),
            'default' => null,
            'description' => clean(html_entity_decode(strip_tags($columns[2]), ENT_QUOTES | ENT_HTML5)),
            'enum' => null,
        ];
    }

    return $fields;
}

function camel(string $value): string
{
    $parts = preg_split('/[^A-Za-z0-9]+/', preg_replace('/([a-z\d])([A-Z])/', '$1 $2', $value) ?? $value, -1, PREG_SPLIT_NO_EMPTY);
    $first = strtolower((string) array_shift($parts));

    return $first . implode('', array_map(static fn(string $part): string => ucfirst(strtolower($part)), $parts));
}

/** @param array<string, mixed> $value @return mixed */
function placeholder(string $name, array $value)
{
    if (\array_key_exists('example', $value)) {
        return $value['example'];
    }
    if (\array_key_exists('default', $value)) {
        return $value['default'];
    }
    if (!empty($value['enum'])) {
        return $value['enum'][0];
    }
    $lower = strtolower($name);
    if ('uuid' === ($value['format'] ?? null) || 'id' === $lower || str_ends_with($lower, '_id')) {
        return '550e8400-e29b-41d4-a716-446655440000';
    }
    if ('date-time' === ($value['format'] ?? null) || str_contains($lower, 'date')) {
        return '2026-09-21T12:00:00Z';
    }
    if ('email' === ($value['format'] ?? null) || str_contains($lower, 'email')) {
        return 'developer@example.com';
    }
    if (str_contains($lower, 'password')) {
        return 'Correct-Horse-Battery-Staple-42';
    }
    if (str_contains($lower, 'language')) {
        return 'en';
    }
    if ('data' === $lower || str_ends_with($lower, '_bytes')) {
        return 1073741824;
    }

    return match ($value['type'] ?? null) {
        'integer', 'number' => $value['minimum'] ?? 1,
        'boolean' => false,
        'array' => [],
        default => '{' . $name . '}',
    };
}

/** @param array<string, mixed> $schema @param array<string, mixed> $value @param array<string, true> $seen @return mixed */
function exampleOf(array $schema, array $value, string $name = 'value', array $seen = [])
{
    if (\array_key_exists('example', $value)) {
        return $value['example'];
    }
    if (\array_key_exists('default', $value)) {
        return $value['default'];
    }
    if (isset($value['$ref'])) {
        $model = basename((string) $value['$ref']);
        if (isset($seen[$model])) {
            return '{' . $model . '}';
        }
        $seen[$model] = true;

        return exampleOf($schema, $schema['components']['schemas'][$model] ?? [], $model, $seen);
    }
    $variants = $value['oneOf'] ?? $value['anyOf'] ?? null;
    if (\is_array($variants) && [] !== $variants) {
        foreach ($variants as $variant) {
            if ('null' !== ($variant['type'] ?? null)) {
                return exampleOf($schema, $variant, $name, $seen);
            }
        }
    }
    if ('array' === ($value['type'] ?? null)) {
        return [exampleOf($schema, $value['items'] ?? [], rtrim($name, 's'), $seen)];
    }
    if ('object' === ($value['type'] ?? null) || isset($value['properties'])) {
        $required = array_flip($value['required'] ?? []);
        $result = [];
        foreach ($value['properties'] ?? [] as $field => $property) {
            if (isset($required[$field]) || ([] === $required && (\array_key_exists('example', $property) || \array_key_exists('default', $property)))) {
                $result[$field] = exampleOf($schema, $property, $field, $seen);
            }
        }

        return $result;
    }

    return placeholder($name, $value);
}

/**  */
function phpValue($value, int $indent = 0): string
{
    if (\is_array($value)) {
        if ([] === $value) {
            return '[]';
        }
        $spaces = str_repeat(' ', $indent);
        $inner = str_repeat(' ', $indent + 4);
        $items = [];
        foreach ($value as $key => $item) {
            $prefix = \is_int($key) ? '' : var_export((string) $key, true) . ' => ';
            $items[] = $inner . $prefix . phpValue($item, $indent + 4);
        }

        return "[\n" . implode(",\n", $items) . ",\n{$spaces}]";
    }

    return var_export($value, true);
}

/** @return string|null */
function methodSignature(string $source, string $method)
{
    if (preg_match('/^    public function ' . preg_quote($method, '/') . '\(([^\n]*)\)(?:: ([^\n]+))?/m', $source, $match)) {
        return $method . '(' . $match[1] . ')' . (isset($match[2]) ? ': ' . $match[2] : '');
    }

    return null;
}

/** @param list<array{status: string, description: string}> $failures */
function throwsFor(array $failures): array
{
    $known = [
        '400' => ['ErrorKind::Validation', 'The request arguments or business rules are invalid.'],
        '401' => ['ErrorKind::Authentication', 'Authentication credentials are missing, expired, or invalid.'],
        '403' => ['ErrorKind::Permission', 'The authenticated account cannot perform this operation.'],
        '404' => ['ErrorKind::NotFound', 'The requested resource does not exist.'],
        '409' => ['ErrorKind::Conflict', 'The operation conflicts with the current resource or idempotency state.'],
        '412' => ['ErrorKind::Precondition', 'A required resource precondition is no longer satisfied.'],
        '429' => ['ErrorKind::RateLimit', 'The request was limited and can be retried later.'],
    ];
    $conditions = [];
    foreach ($failures as $failure) {
        [$kind, $description] = $known[$failure['status']] ?? ((int) $failure['status'] >= 500
            ? ['ErrorKind::Server', 'ProxyRequest could not complete the operation.']
            : ['ErrorKind::Unexpected', 'The API returned an unexpected failure.']);
        $conditions[$kind] = $description;
    }
    $conditions['ErrorKind::Network'] = 'The request could not reach ProxyRequest.';
    $conditions['ErrorKind::Unexpected'] = 'The response could not be decoded or did not match the SDK contract.';

    return [
        [
            'type' => 'ApiException',
            'description' => 'Normalized API, transport, and response processing failure.',
            'conditions' => array_map(
                static fn(string $kind, string $description): array => ['kind' => $kind, 'description' => $description],
                array_keys($conditions),
                array_values($conditions),
            ),
        ],
        [
            'type' => 'InvalidArgumentException',
            'description' => 'A required argument is missing or violates a local SDK constraint.',
            'conditions' => [['kind' => 'local validation', 'description' => 'The request was rejected before it was sent.']],
        ],
    ];
}

$mappedModelNames = $config['modelNameMappings'] ?? [];
$modelPaths = glob($root . '/docs/Model/*.md') ?: [];
$publicBySource = $mappedModelNames;
foreach ($modelPaths as $modelPath) {
    $name = basename($modelPath, '.md');
    $publicBySource[$name] ??= $name;
}

$tags = [];
foreach ($schema['tags'] ?? [] as $tag) {
    $tags[$tag['name']] = clean($tag['description'] ?? '');
}
$resources = [];
$resourceIndexes = [];
foreach ($schema['paths'] as $path => $pathItem) {
    foreach (['get', 'post', 'put', 'patch', 'delete'] as $verb) {
        if (!isset($pathItem[$verb])) {
            continue;
        }
        $operation = $pathItem[$verb];
        $operationId = $operation['operationId'];
        if (\in_array($operationId, $excluded, true)) {
            continue;
        }
        $tag = $operation['tags'][0];
        $className = preg_replace('/[^a-zA-Z0-9]/', '', ucwords($tag)) . 'Resource';
        $accessor = match ($tag) {
            'API Keys' => 'apiKeys',
            'Telegram dashboard' => 'telegram',
            default => camel($tag),
        };
        if (!isset($resourceIndexes[$tag])) {
            $resourceIndexes[$tag] = \count($resources);
            $resources[] = ['tag' => $tag, 'accessor' => $accessor, 'className' => $className, 'description' => $tags[$tag] ?? '', 'methods' => []];
        }
        $methodName = $config['operationIdNameMappings'][$operationId] ?? null;
        if (!\is_string($methodName)) {
            throw new RuntimeException('Missing method mapping for ' . $operationId);
        }
        $resourceSource = (string) file_get_contents($root . '/src/Resource/' . $className . '.php');
        $rawParameters = [];
        foreach ([...($pathItem['parameters'] ?? []), ...($operation['parameters'] ?? [])] as $parameter) {
            $rawParameters[] = dereference($schema, $parameter, 'parameters');
        }
        $bases = array_map(static fn(array $parameter): string => camel($parameter['name']), $rawParameters);
        $seenNames = [];
        $publicNames = [];
        foreach ($bases as $base) {
            $seenNames[$base] = ($seenNames[$base] ?? 0) + 1;
            $publicNames[] = 1 === $seenNames[$base] ? $base : $base . $seenNames[$base];
        }
        $parameters = [];
        foreach ($rawParameters as $index => $parameter) {
            $parameters[] = [
                'name' => $publicNames[$index],
                'wireName' => $parameter['name'],
                'in' => $parameter['in'],
                'required' => true === ($parameter['required'] ?? false) || 'path' === $parameter['in'],
                'type' => typeOf($parameter['schema'] ?? [], $publicBySource),
                'default' => $parameter['schema']['default'] ?? null,
                'description' => clean($parameter['description'] ?? ''),
                'example' => placeholder($parameter['name'], $parameter['schema'] ?? []),
            ];
        }
        $bodyRaw = dereference($schema, $operation['requestBody'] ?? [], 'requestBodies');
        $media = $bodyRaw['content']['application/json'] ?? (\is_array($bodyRaw['content'] ?? null) ? reset($bodyRaw['content']) : []);
        $bodySchema = $media['schema'] ?? [];
        $bodyType = typeOf($bodySchema, $publicBySource);
        $bodyName = lcfirst($bodyType);
        $body = !isset($operation['requestBody']) ? null : ['name' => $bodyName, 'required' => true === ($bodyRaw['required'] ?? false), 'type' => $bodyType, 'description' => clean($bodyRaw['description'] ?? '')];

        $exampleArguments = [];
        foreach ($parameters as $parameter) {
            if ($parameter['required']) {
                $exampleArguments[] = $parameter['name'] . ': ' . phpValue($parameter['example'], 4);
            }
        }
        if (null !== $body) {
            $value = exampleOf($schema, $bodySchema, $bodyType);
            $exampleArguments[] = $bodyName . ': new Dto\\' . $bodyType . '(' . phpValue($value, 4) . ')';
        }
        $call = '()';
        if ([] !== $exampleArguments) {
            $call = "(\n    " . implode(",\n    ", $exampleArguments) . ",\n)";
        }

        $returnType = 'void';
        $returnDescription = '';
        $failures = [];
        foreach ($operation['responses'] ?? [] as $status => $responseValue) {
            $responseValue = dereference($schema, $responseValue, 'responses');
            if (str_starts_with((string) $status, '2')) {
                if ('void' === $returnType) {
                    $responseMedia = $responseValue['content']['application/json'] ?? $responseValue['content']['application/pdf'] ?? (\is_array($responseValue['content'] ?? null) ? reset($responseValue['content']) : []);
                    $returnType = isset($responseValue['content']['application/pdf']) ? 'FileDownload' : (isset($responseMedia['schema']) ? typeOf($responseMedia['schema'], $publicBySource) : 'void');
                    $returnDescription = clean($responseValue['description'] ?? '');
                }
            } else {
                $failures[] = ['status' => (string) $status, 'description' => clean($responseValue['description'] ?? '')];
            }
        }
        $variants = [];
        foreach ([
            $methodName . 'WithResponse' => 'Returns an ApiResponse with decoded data and HTTP metadata.',
            $methodName . 'WithHttpInfo' => 'Returns the OpenAPI Generator response tuple.',
            $methodName . 'Async' => 'Returns a Guzzle promise for the decoded result.',
            $methodName . 'AsyncWithHttpInfo' => 'Returns a Guzzle promise for the response tuple.',
            $methodName . 'Request' => 'Builds the PSR-7 request without sending it.',
        ] as $variant => $description) {
            $signature = methodSignature($resourceSource, $variant);
            if (null !== $signature) {
                $variants[] = ['name' => $variant, 'signature' => '$client->' . $accessor . '()->' . $signature, 'description' => $description];
            }
        }
        $signature = methodSignature($resourceSource, $methodName) ?? $methodName . '(...)';
        $resources[$resourceIndexes[$tag]]['methods'][] = [
            'operationId' => $operationId,
            'name' => $methodName,
            'summary' => clean($operation['summary'] ?? ''),
            'description' => clean($operation['description'] ?? ''),
            'httpMethod' => strtoupper($verb),
            'path' => $path,
            'signatures' => [['label' => 'Sync', 'signature' => '$client->' . $accessor . '()->' . $signature]],
            'variants' => $variants,
            'parameters' => $parameters,
            'body' => $body,
            'returns' => ['type' => $returnType, 'description' => $returnDescription],
            'errors' => $failures,
            'throws' => throwsFor($failures),
            'example' => ['language' => 'php', 'code' => '$result = $client->' . $accessor . '()->' . $methodName . $call . ';'],
        ];
    }
}

$reverseModels = array_flip($mappedModelNames);
$models = [];
foreach ($modelPaths as $modelPath) {
    $name = basename($modelPath, '.md');
    $sourceName = $reverseModels[$name] ?? $name;
    $model = $schema['components']['schemas'][$sourceName] ?? [];
    $fields = markdownFields($modelPath);
    $models[] = ['name' => $name, 'kind' => isset($model['enum']) ? 'enum' : 'class', 'description' => clean($model['description'] ?? ''), 'fields' => $fields];
}
usort($models, static fn(array $left, array $right): int => $left['name'] <=> $right['name']);

$modelNames = array_fill_keys(array_column($models, 'name'), true);
$modelRefs = static function (string $type) use ($modelNames): array {
    preg_match_all('/[A-Za-z_][A-Za-z0-9_]*/', $type, $matches);

    return array_values(array_unique(array_filter($matches[0], static fn(string $name): bool => isset($modelNames[$name]))));
};
foreach ($models as &$model) {
    foreach ($model['fields'] as &$field) {
        $field['modelRefs'] = $modelRefs($field['type']);
    }
    unset($field);
}
unset($model);
foreach ($resources as &$resource) {
    foreach ($resource['methods'] as &$method) {
        foreach ($method['parameters'] as &$parameter) {
            $parameter['modelRefs'] = $modelRefs($parameter['type']);
        }
        unset($parameter);
        if (null !== $method['body']) {
            $method['body']['modelRefs'] = $modelRefs($method['body']['type']);
        }
        $method['returns']['modelRefs'] = $modelRefs($method['returns']['type']);
    }
    unset($method);
}
unset($resource);

$version = $config['artifactVersion'];
$manifest = [
    'schemaVersion' => 3,
    'sdk' => ['id' => 'php', 'label' => 'PHP', 'language' => 'PHP', 'version' => $version, 'package' => $package['name'], 'runtime' => '64-bit PHP 8.5 or later', 'install' => 'composer require proxyrequest/php-sdk', 'openapi' => $source],
    'setup' => [['id' => 'api-key', 'label' => 'API key', 'language' => 'php', 'code' => "<?php\nrequire __DIR__ . '/vendor/autoload.php';\n\nuse ProxyRequest\\Client;\nuse ProxyRequest\\Dto;\n\n\$client = Client::withApiKey(\n    '{api_key}', 'https://{api_host}/api/v1'\n);"]],
    'clients' => [['name' => 'Client', 'kind' => 'class', 'description' => 'Configured client exposing all API resources.', 'signatures' => ['Client::withApiKey($apiKey, $baseUri)', 'Client::withBearerToken($token, $baseUri)', 'Client::anonymous($baseUri)', 'Client::builder()', '$client->paginate($pageFetcher, $limit, $offset): Paginator', '$client->downloadInvoicePdf($invoiceId): FileDownload', '$client->raw($method, $path, $query, $json, $headers): ResponseInterface'], 'members' => array_map(static fn(array $resource): array => ['name' => $resource['accessor'], 'signature' => $resource['accessor'] . '(): ' . $resource['className'], 'description' => ''], $resources)]],
    'resources' => $resources,
    'models' => $models,
    'errors' => [['name' => 'ApiException', 'kind' => 'class', 'description' => 'Normalized API and transport exception with response metadata.', 'signatures' => []], ['name' => 'InvalidSignatureException', 'kind' => 'class', 'description' => 'Webhook signature verification error.', 'signatures' => []]],
    'helpers' => [['name' => 'ClientBuilder', 'kind' => 'class', 'description' => 'Immutable fluent client configuration builder.', 'signatures' => ['withApiKey()', 'withBearerToken()', 'withBaseUri()', 'withLanguage()', 'withTimeout()', 'withHttpClient()', 'withIdempotency()', 'build()']], ['name' => 'Configuration', 'kind' => 'class', 'description' => 'Low-level generated host, authentication and user-agent configuration.', 'signatures' => []], ['name' => 'ApiResponse', 'kind' => 'class', 'description' => 'Decoded data with HTTP response metadata.', 'signatures' => ['etag()', 'idempotencyReplayed()']], ['name' => 'Paginator', 'kind' => 'class', 'description' => 'Lazy iterator over paginated endpoints.', 'signatures' => ['getIterator(): Traversable']], ['name' => 'WebhookVerifier', 'kind' => 'class', 'description' => 'Verifies signed ProxyRequest webhooks.', 'signatures' => ['verify()', 'verifyOrFail()', 'decodeVerifiedJson()']], ['name' => 'FileDownload', 'kind' => 'class', 'description' => 'Binary download with filename and content type metadata.', 'signatures' => ['size()', 'contents()', 'saveTo($path)']]],
];

$destination = $root . '/docs/reference/sdk-reference.json';
if (!is_dir(\dirname($destination))) {
    mkdir(\dirname($destination), 0o777, true);
}
file_put_contents($destination, json_encode($manifest, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR) . "\n");
printf("Generated SDK reference for %d operations.\n", array_sum(array_map(static fn(array $resource): int => \count($resource['methods']), $resources)));
