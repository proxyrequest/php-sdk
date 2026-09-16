<?php

declare(strict_types=1);

namespace ProxyRequest\Webhook;

use JsonException;
use UnexpectedValueException;

final class WebhookVerifier
{
    public const SIGNATURE_HEADER = 'X-Signature';

    public static function verify(string $rawBody, string $signature, string $secret): bool
    {
        if ('' === $signature || '' === $secret || 1 !== preg_match('/^[A-Za-z0-9+\/]{43}=$/D', $signature)) {
            return false;
        }

        $received = base64_decode($signature, true);
        if (false === $received || 32 !== \strlen($received) || base64_encode($received) !== $signature) {
            return false;
        }

        return hash_equals(hash_hmac('sha256', $rawBody, $secret, true), $received);
    }

    public static function verifyOrFail(string $rawBody, string $signature, string $secret): void
    {
        if (!self::verify($rawBody, $signature, $secret)) {
            throw new InvalidSignatureException('The ProxyRequest webhook signature is invalid.');
        }
    }

    /** @return array<string, mixed> */
    public static function decodeVerifiedJson(
        string $rawBody,
        string $signature,
        string $secret,
    ): array {
        self::verifyOrFail($rawBody, $signature, $secret);

        try {
            $payload = json_decode($rawBody, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $exception) {
            throw new UnexpectedValueException('The verified webhook body is not valid JSON.', previous: $exception);
        }

        if (!\is_array($payload) || !str_starts_with(ltrim($rawBody), '{')) {
            throw new UnexpectedValueException('The verified webhook payload must be a JSON object.');
        }

        foreach ($payload as $key => $_value) {
            if (!\is_string($key)) {
                throw new UnexpectedValueException('The verified webhook payload must be a JSON object.');
            }
        }

        return $payload;
    }
}
