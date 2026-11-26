<?php

declare(strict_types=1);

use Symfony\Component\Yaml\Yaml;

require \dirname(__DIR__) . '/vendor/autoload.php';

$root = \dirname(__DIR__);
$document = Yaml::parseFile($root . '/openapi/openapi.yaml');
$routes = [];
foreach ($document['paths'] ?? [] as $path => $pathItem) {
    foreach (['post', 'put', 'patch', 'delete'] as $method) {
        $operation = $pathItem[$method] ?? null;
        if (!\is_array($operation)) {
            continue;
        }
        $parameters = [...($pathItem['parameters'] ?? []), ...($operation['parameters'] ?? [])];
        foreach ($parameters as $parameter) {
            if (isset($parameter['$ref'])) {
                $name = basename((string) $parameter['$ref']);
                $parameter = $document['components']['parameters'][$name] ?? [];
            }
            if ('header' === ($parameter['in'] ?? null) && 'Idempotency-Key' === ($parameter['name'] ?? null)) {
                $pattern = preg_quote((string) $path, '#');
                $pattern = preg_replace('/\\\\\{[^}]+\\\\\}/', '[^/]+', $pattern);
                $body = $operation['requestBody']['content']['application/json']['schema'] ?? [];
                if (isset($body['$ref'])) {
                    $body = $document['components']['schemas'][basename($body['$ref'])] ?? [];
                }
                $routes[] = [strtoupper($method), '#^' . $pattern . '$#D', isset($body['properties']['idempotency_key'])];
                break;
            }
        }
    }
}

$entries = implode(",\n", array_map(
    static fn(array $route): string => \sprintf(
        "        [%s, %s, %s]",
        var_export($route[0], true),
        var_export($route[1], true),
        var_export($route[2], true),
    ),
    $routes,
));
$source = <<<PHP
    <?php

    declare(strict_types=1);

    namespace ProxyRequest\\Support;

    use Psr\\Http\\Message\\RequestInterface;

    /** Generated from openapi/openapi.yaml; do not edit manually. */
    final class IdempotencyPolicy
    {
        private const ROUTES = [
    {$entries}
        ];

        public static function supports(RequestInterface \$request, string \$basePath): bool
        {
            return self::match(\$request, \$basePath) !== null;
        }

        public static function acceptsBodyKey(RequestInterface \$request, string \$basePath): bool
        {
            return self::match(\$request, \$basePath) === true;
        }

        private static function match(RequestInterface \$request, string \$basePath): ?bool
        {
            \$path = \$request->getUri()->getPath();
            if ('' !== \$basePath && str_starts_with(\$path, \$basePath)) {
                \$path = substr(\$path, strlen(\$basePath));
            }
            \$path = '/' . ltrim(\$path, '/');
            foreach (self::ROUTES as [\$method, \$pattern, \$acceptsBodyKey]) {
                if (\$method === strtoupper(\$request->getMethod()) && 1 === preg_match(\$pattern, \$path)) {
                    return \$acceptsBodyKey;
                }
            }

            return null;
        }
    }
    PHP;

file_put_contents($root . '/src/Support/IdempotencyPolicy.php', $source . "\n");
printf("Generated idempotency policy for %d operations.\n", \count($routes));
