<?php

declare(strict_types=1);

use Symfony\Component\Yaml\Yaml;

require \dirname(__DIR__) . '/vendor/autoload.php';

$root = \dirname(__DIR__);
$source = $argv[1] ?? $root . '/../../../papaproxy/api/openapi.yml';
$source = realpath($source);

if (false === $source || !is_file($source)) {
    fwrite(STDERR, "OpenAPI source file was not found.\n");
    exit(1);
}

$document = Yaml::parseFile($source);
if (!\is_array($document) || 'Proxy Public API' !== ($document['info']['title'] ?? null)) {
    fwrite(STDERR, "Refusing to sync a non-public API schema.\n");
    exit(1);
}
if ('api.proxyrequest.com' !== ($document['servers'][0]['variables']['host']['default'] ?? null)) {
    fwrite(STDERR, "The public API host is not api.proxyrequest.com.\n");
    exit(1);
}

$paths = $document['paths'] ?? [];
if (!\is_array($paths) || [] !== array_filter(array_keys($paths), static fn(mixed $path): bool => \is_string($path) && str_starts_with($path, '/admin'))) {
    fwrite(STDERR, "The public schema unexpectedly contains admin paths.\n");
    exit(1);
}

$operations = 0;
foreach ($paths as $pathItem) {
    if (!\is_array($pathItem)) {
        continue;
    }
    foreach (['get', 'post', 'put', 'patch', 'delete'] as $method) {
        $operations += isset($pathItem[$method]) ? 1 : 0;
    }
}

$schemas = $document['components']['schemas'] ?? [];
$bytes = file_get_contents($source);
if (false === $bytes) {
    fwrite(STDERR, "Unable to read the source schema.\n");
    exit(1);
}

$commit = trim((string) shell_exec(
    'git -C ' . escapeshellarg(\dirname($source))
    . ' log -n 1 --format=%H -- ' . escapeshellarg(basename($source))
    . ' 2>/dev/null',
));
if (1 !== preg_match('/^[0-9a-f]{40}$/D', $commit)) {
    $commit = 'unknown';
}

file_put_contents($root . '/openapi/openapi.yaml', $bytes);
file_put_contents($root . '/openapi/source.json', json_encode([
    'commit' => $commit,
    'repository' => 'papaproxy/api',
    'sha256' => hash('sha256', $bytes),
    'source' => basename($source),
    'operations' => $operations,
    'schemas' => \is_array($schemas) ? \count($schemas) : 0,
], JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES) . "\n");

printf("Synced %d operations and %d schemas (%s).\n", $operations, \is_array($schemas) ? \count($schemas) : 0, substr(hash('sha256', $bytes), 0, 12));
