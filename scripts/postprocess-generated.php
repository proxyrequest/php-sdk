<?php

declare(strict_types=1);

use Symfony\Component\Yaml\Yaml;

require \dirname(__DIR__) . '/vendor/autoload.php';

$root = \dirname(__DIR__);
$document = Yaml::parseFile($root . '/openapi/openapi.yaml');
$config = Yaml::parseFile($root . '/openapi/generator.yaml');
$success = [];
foreach ($document['paths'] as $item) {
    foreach (['get', 'post', 'put', 'patch', 'delete'] as $verb) {
        if (!isset($item[$verb])) {
            continue;
        }
        $operation = $item[$verb];
        $id = $operation['operationId'];
        if (\in_array($id, ['sessions_list', 'sessions_destroy'], true)) {
            continue;
        }
        $resource = preg_replace('/[^a-zA-Z0-9]/', '', ucwords($operation['tags'][0])) . 'Resource.php';
        foreach ($operation['responses'] as $status => $response) {
            if ((int) $status >= 200 && (int) $status < 300) {
                $success[$resource][$config['operationIdNameMappings'][$id]][(int) $status] = empty($response['content']);
            }
        }
    }
}

foreach (glob($root . '/src/Resource/*Resource.php') ?: [] as $path) {
    if ('SessionsResource.php' === basename($path)) {
        continue;
    }
    $source = (string) file_get_contents($path);
    $pattern = '/^    public function (\w+)WithHttpInfo\(([^\n]*)\)\n    \{\n(.*?)^    \}/ms';
    preg_match_all($pattern, $source, $methods, PREG_SET_ORDER);
    $typesByMethod = [];
    foreach ($methods as $match) {
        $method = $match[1];
        if (str_ends_with($method, 'Async')) {
            continue;
        }
        preg_match_all('/case (2\d\d):\s*return \$this->handleResponseWithDataType\(\s*\x27([^\x27]+)\x27/', $match[3], $types, PREG_SET_ORDER);
        $returnTypes = [];
        foreach ($types as $type) {
            $returnTypes[(int) $type[1]] = $type[2];
        }
        foreach ($success[basename($path)][$method] ?? [] as $status => $empty) {
            if ($empty) {
                $returnTypes[$status] = 'void';
            } elseif (!isset($returnTypes[$status])) {
                throw new RuntimeException("Unmapped success response: {$path}:{$method}:{$status}");
            }
        }
        if ([] === $returnTypes) {
            throw new RuntimeException("Missing response map for {$path}:{$method}");
        }
        $typesByMethod[$method] = $returnTypes;
    }
    $source = preg_replace_callback($pattern, static function (array $match) use ($typesByMethod): string {
        $method = $match[1];
        $async = str_ends_with($method, 'Async');
        $name = $async ? substr($method, 0, -5) : $method;
        if (!preg_match('/\$request = \$this->\w+Request\([^\n]*\);/', $match[3], $request)) {
            throw new RuntimeException("Missing request builder for {$method}");
        }
        $types = var_export($typesByMethod[$name], true);
        $send = $async ? 'sendAsync' : 'send';
        return "    public function {$method}WithHttpInfo({$match[2]})\n    {\n        {$request[0]}\n        return \\ProxyRequest\\Support\\ResponseHandler::{$send}(\$this->client, \$request, \$this->createHttpClientOption(), {$types});\n    }";
    }, $source);
    if (null === $source) {
        throw new RuntimeException('Unable to transform ' . $path);
    }
    file_put_contents($path, rtrim($source) . "\n");
}

// The upstream PHP generator flattens anyOf. Preserve the two concrete DTOs.
$invoice = (string) file_get_contents($root . '/src/Dto/Invoice.php');
$short = (string) file_get_contents($root . '/src/Dto/InvoiceShort.php');
preg_match_all('/public function (get\w+)\(\)/', $invoice, $fullGetters);
preg_match_all('/public function (get\w+)\(\)/', $short, $shortGetters);
$getters = array_intersect($fullGetters[1], $shortGetters[1]);
$interface = "<?php\n\nnamespace ProxyRequest\\Dto;\n\n/** Generated invoice read union; implemented by Invoice and InvoiceShort. */\ninterface InvoiceRead extends ModelInterface, \\ArrayAccess, \\JsonSerializable\n{\n";
foreach ($getters as $getter) {
    $interface .= "    public function {$getter}();\n";
}
file_put_contents($root . '/src/Dto/InvoiceRead.php', $interface . "}\n");

foreach (glob($root . '/src/Dto/*.php') ?: [] as $path) {
    $source = (string) file_get_contents($path);
    if (!str_contains($source, 'implements ModelInterface')) {
        file_put_contents($path, rtrim($source) . "\n");
        continue;
    }
    $source = preg_replace('/class (\w+) implements ModelInterface/', 'class $1 extends \\ProxyRequest\\Support\\AdditionalProperties implements ModelInterface', $source);
    if (\in_array(basename($path), ['Invoice.php', 'InvoiceShort.php'], true)) {
        $source = str_replace('implements ModelInterface,', 'implements ModelInterface, InvoiceRead,', $source);
    }
    file_put_contents($path, rtrim($source) . "\n");
}

$path = $root . '/src/ObjectSerializer.php';
$source = (string) file_get_contents($path);
$source = str_replace('if (is_callable($callable)) {', "if (is_callable(\$callable) && !(is_string(\$value) && str_ends_with(\$openAPIType, 'GatewayEnum'))) {", $source);
$source = str_replace('if (!in_array($data, $class::getAllowableEnumValues(), true)) {', "if (!in_array(\$data, \$class::getAllowableEnumValues(), true) && !(is_string(\$data) && str_ends_with(\$class, 'GatewayEnum'))) {", $source);
$source = str_replace('                $formats = $data::openAPIFormats();', '                $values = $data->getAdditionalProperties();' . "\n" . '                $formats = $data::openAPIFormats();', $source);
$source = str_replace("        if (method_exists(\$class, 'getAllowableEnumValues')) {", <<<'PHP'
            if ($class === '\ProxyRequest\Dto\InvoiceRead') {
                $data = is_string($data) ? json_decode($data, false, 512, JSON_THROW_ON_ERROR) : (object) $data;
                return self::deserialize($data, property_exists($data, 'package') ? '\ProxyRequest\Dto\Invoice' : '\ProxyRequest\Dto\InvoiceShort', $httpHeaders);
            }
            if (method_exists($class, 'getAllowableEnumValues')) {
    PHP, $source);
$source = preg_replace('/                if \(!isset\(\$data->\{\$instance::attributeMap\(\)\[\$property\]\}\)\) \{.*?                \}\n\n                if \(isset\(\$data->\{\$instance::attributeMap\(\)\[\$property\]\}\)\) \{/s', <<<'PHP'
                    if (!property_exists($data, $instance::attributeMap()[$property])) {
                        continue;
                    }

                    if (property_exists($data, $instance::attributeMap()[$property])) {
    PHP, $source);
$source = str_replace('            return $instance;', <<<'PHP'
                $instance->setAdditionalProperties(array_diff_key((array) $data, array_flip($instance::attributeMap())));
                return $instance;
    PHP, $source);
file_put_contents($path, $source);
