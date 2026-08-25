<?php

declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
    ->in([
        __DIR__.'/src/Exception',
        __DIR__.'/src/Support',
        __DIR__.'/src/Webhook',
        __DIR__.'/tests',
    ])
    ->append([
        __DIR__.'/src/ApiException.php',
        __DIR__.'/src/ApiResponse.php',
        __DIR__.'/src/Client.php',
        __DIR__.'/src/ClientBuilder.php',
        __DIR__.'/scripts/add-response-methods.php',
        __DIR__.'/scripts/generate-idempotency-policy.php',
        __DIR__.'/scripts/sync-openapi.php',
    ]);

return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setRules([
        '@PER-CS2.0' => true,
        '@PHP85Migration' => true,
        'declare_strict_types' => true,
        'native_function_invocation' => ['include' => ['@compiler_optimized']],
        'no_superfluous_phpdoc_tags' => true,
        'ordered_imports' => true,
    ])
    ->setFinder($finder);
