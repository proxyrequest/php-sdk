<?php

declare(strict_types=1);

namespace ProxyRequest\Webhook;

use JsonException;
use UnexpectedValueException;

final class WebhookVerifier
{
    public const SIGNATURE_HEADER = 'X-Webhook-Signature';
    public const TIMESTAMP_HEADER = 'X-Webhook-Timestamp';

    public static function verify(
        string $rawBody,
        string $signature,
        string $secret,
        ?string $timestampHeader = null,
        ?int $tolerance = 300,
        ?int $now = null,
    ): bool {
        if ('' === $signature || '' === $secret || (null !== $tolerance && $tolerance < 0)) {
            return false;
        }

        $parsed = self::parseSignature($signature);
        if (null === $parsed) {
            return false;
        }

        [$timestamp, $receivedSignatures] = $parsed;
        if (null !== $timestampHeader) {
            $timestampHeader = trim($timestampHeader);
            if (!ctype_digit($timestampHeader) || (int) $timestampHeader !== $timestamp) {
                return false;
            }
        }

        if (null !== $tolerance && abs(($now ?? time()) - $timestamp) > $tolerance) {
            return false;
        }

        $expected = hash_hmac('sha256', $timestamp . '.' . $rawBody, $secret);
        foreach ($receivedSignatures as $received) {
            if (hash_equals($expected, strtolower($received))) {
                return true;
            }
        }

        return false;
    }

    public static function verifyOrFail(
        string $rawBody,
        string $signature,
        string $secret,
        ?string $timestampHeader = null,
        ?int $tolerance = 300,
        ?int $now = null,
    ): void {
        if (!self::verify($rawBody, $signature, $secret, $timestampHeader, $tolerance, $now)) {
            throw new InvalidSignatureException('The ProxyRequest webhook signature is invalid.');
        }
    }

    /** @return array<string, mixed> */
    public static function decodeVerifiedJson(
        string $rawBody,
        string $signature,
        string $secret,
        ?string $timestampHeader = null,
        ?int $tolerance = 300,
        ?int $now = null,
    ): array {
        self::verifyOrFail($rawBody, $signature, $secret, $timestampHeader, $tolerance, $now);

        try {
            $payload = json_decode($rawBody, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $exception) {
            throw new UnexpectedValueException('The verified webhook body is not valid JSON.', previous: $exception);
        }

        if (!\is_array($payload)) {
            throw new UnexpectedValueException('The verified webhook payload must be a JSON object.');
        }

        $object = [];
        foreach ($payload as $key => $value) {
            if (!\is_string($key)) {
                throw new UnexpectedValueException('The verified webhook payload must be a JSON object.');
            }
            $object[$key] = $value;
        }

        return $object;
    }

    /** @return array{int, non-empty-list<string>}|null */
    private static function parseSignature(string $signature): ?array
    {
        $timestamp = null;
        $signatures = [];

        foreach (explode(',', $signature) as $part) {
            $pair = explode('=', trim($part), 2);
            if (2 !== \count($pair)) {
                return null;
            }

            [$key, $value] = $pair;
            if ('t' === $key) {
                if (null !== $timestamp || !ctype_digit($value) || \strlen($value) > 19) {
                    return null;
                }
                $timestamp = (int) $value;
                continue;
            }

            if ('v1' === $key && 1 === preg_match('/^[a-f0-9]{64}$/iD', $value)) {
                $signatures[] = $value;
            }
        }

        if (null === $timestamp || [] === $signatures) {
            return null;
        }

        return [$timestamp, $signatures];
    }
}
