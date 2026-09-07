<?php

declare(strict_types=1);

use Symfony\Component\Yaml\Yaml;

require \dirname(__DIR__) . '/vendor/autoload.php';

$document = Yaml::parseFile(\dirname(__DIR__) . '/openapi/openapi.yaml', Yaml::PARSE_OBJECT_FOR_MAP);
$excluded = ['sessions_destroy', 'sessions_list'];
$methods = ['get', 'post', 'put', 'patch', 'delete', 'head', 'options', 'trace'];
$seen = [];
foreach ($document->paths as $path => $item) {
    foreach ($methods as $method) {
        if (!isset($item->{$method})) {
            continue;
        }
        $id = $item->{$method}->operationId ?? null;
        if (!$id || isset($seen[$id])) {
            throw new RuntimeException('Missing or duplicate operationId: ' . (string) $id);
        }
        $seen[$id] = true;
        if (\in_array($id, $excluded, true)) {
            unset($item->{$method});
        }
    }
    if ([] === array_intersect($methods, array_keys(get_object_vars($item)))) {
        unset($document->paths->{$path});
    }
}
unset($item);
$document->tags = array_values(array_filter($document->tags, static fn(object $tag): bool => 'Sessions' !== $tag->name));
foreach (array_keys(get_object_vars($document->components->schemas)) as $name) {
    if (preg_match('/^Sessions?(List|Delete|Destroy)/', $name)) {
        unset($document->components->schemas->{$name});
    }
}
file_put_contents($argv[1], json_encode($document, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT));
