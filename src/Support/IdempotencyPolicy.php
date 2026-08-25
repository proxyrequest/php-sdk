<?php

declare(strict_types=1);

namespace ProxyRequest\Support;

use Psr\Http\Message\RequestInterface;

/** Generated from openapi/openapi.yaml; do not edit manually. */
final class IdempotencyPolicy
{
    private const ROUTES = [
        ['DELETE', '#^/api\\-keys/[^/]+$#D'],
        ['POST', '#^/coupons$#D'],
        ['DELETE', '#^/coupons/[^/]+$#D'],
        ['POST', '#^/invoices$#D'],
        ['DELETE', '#^/invoices/[^/]+$#D'],
        ['DELETE', '#^/orders/[^/]+$#D'],
        ['POST', '#^/users$#D'],
        ['DELETE', '#^/users/[^/]+$#D'],
        ['POST', '#^/users/[^/]+/data/add$#D'],
        ['POST', '#^/users/[^/]+/data/subtract$#D'],
        ['POST', '#^/webhooks$#D'],
        ['DELETE', '#^/webhooks/[^/]+$#D'],
    ];

    public static function supports(RequestInterface $request, string $basePath): bool
    {
        $path = $request->getUri()->getPath();
        if ('' !== $basePath && str_starts_with($path, $basePath)) {
            $path = substr($path, \strlen($basePath));
        }
        $path = '/' . ltrim($path, '/');
        foreach (self::ROUTES as [$method, $pattern]) {
            if ($method === strtoupper($request->getMethod()) && 1 === preg_match($pattern, $path)) {
                return true;
            }
        }

        return false;
    }
}
