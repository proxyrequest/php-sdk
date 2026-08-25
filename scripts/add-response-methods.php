<?php

declare(strict_types=1);

$root = \dirname(__DIR__);
foreach (glob($root . '/src/Resource/*Resource.php') ?: [] as $path) {
    $source = (string) file_get_contents($path);
    preg_match_all('/^    public function ([A-Za-z][A-Za-z0-9_]*)WithHttpInfo\((.*)\)$/m', $source, $matches, PREG_SET_ORDER);
    foreach ($matches as $match) {
        $method = $match[1];
        if (str_ends_with($method, 'Async')) {
            continue;
        }
        $parameters = $match[2];
        preg_match_all('/\$[A-Za-z_][A-Za-z0-9_]*/', $parameters, $variables);
        $arguments = implode(', ', $variables[0]);
        $needle = "    /**\n     * Operation {$method}WithHttpInfo";
        $addition = <<<PHP
                /**
                 * Operation {$method}WithResponse
                 *
                 * @return \\ProxyRequest\\ApiResponse
                 */
                public function {$method}WithResponse({$parameters}): \\ProxyRequest\\ApiResponse
                {
                    return \\ProxyRequest\\ApiResponse::fromHttpInfo(\$this->{$method}WithHttpInfo({$arguments}));
                }


            PHP;
        $source = str_replace($needle, $addition . $needle, $source);
    }
    file_put_contents($path, $source);
}
