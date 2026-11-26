<?php

declare(strict_types=1);

namespace ProxyRequest\Support;

use Psr\Http\Message\RequestInterface;

/** Generated from openapi/openapi.yaml; do not edit manually. */
final class IdempotencyPolicy
{
    private const ROUTES = [
        ['DELETE', '#^/api\\-keys/[^/]+$#D', false],
        ['POST', '#^/coupons$#D', false],
        ['DELETE', '#^/coupons/[^/]+$#D', false],
        ['POST', '#^/invoices$#D', false],
        ['DELETE', '#^/invoices/[^/]+$#D', false],
        ['POST', '#^/kyc/sessions/$#D', false],
        ['DELETE', '#^/orders/[^/]+$#D', false],
        ['POST', '#^/orders/[^/]+/checkout$#D', true],
        ['POST', '#^/orders/[^/]+/renew$#D', true],
        ['POST', '#^/orders/[^/]+/replacement\\-requests$#D', true],
        ['POST', '#^/orders/purchase$#D', true],
        ['POST', '#^/static/purchases$#D', true],
        ['POST', '#^/static/purchases/[^/]+/checkout$#D', true],
        ['POST', '#^/users$#D', false],
        ['DELETE', '#^/users/[^/]+$#D', false],
        ['POST', '#^/users/[^/]+/data/add$#D', false],
        ['POST', '#^/users/[^/]+/data/reset$#D', false],
        ['POST', '#^/users/[^/]+/data/subtract$#D', false],
        ['POST', '#^/webhooks$#D', false],
        ['DELETE', '#^/webhooks/[^/]+$#D', false],
    ];

    public static function supports(RequestInterface $request, string $basePath): bool
    {
        return self::match($request, $basePath) !== null;
    }

    public static function acceptsBodyKey(RequestInterface $request, string $basePath): bool
    {
        return self::match($request, $basePath) === true;
    }

    private static function match(RequestInterface $request, string $basePath): ?bool
    {
        $path = $request->getUri()->getPath();
        if ('' !== $basePath && str_starts_with($path, $basePath)) {
            $path = substr($path, \strlen($basePath));
        }
        $path = '/' . ltrim($path, '/');
        foreach (self::ROUTES as [$method, $pattern, $acceptsBodyKey]) {
            if ($method === strtoupper($request->getMethod()) && 1 === preg_match($pattern, $path)) {
                return $acceptsBodyKey;
            }
        }

        return null;
    }
}
