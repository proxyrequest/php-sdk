<?php

declare(strict_types=1);

namespace ProxyRequest\Tests\Unit;

use PHPUnit\Framework\TestCase;
use ProxyRequest\Webhook\InvalidSignatureException;
use ProxyRequest\Webhook\WebhookVerifier;

final class WebhookVerifierTest extends TestCase
{
    public function testValidSignatureAndVerifiedJson(): void
    {
        $body = '{"events":[{"id":"evt-1"}]}';
        $timestamp = 1_800_000_000;
        $signature = 't=' . $timestamp . ',v1=' . hash_hmac('sha256', $timestamp . '.' . $body, 'secret');

        self::assertTrue(WebhookVerifier::verify(
            $body,
            $signature,
            'secret',
            timestampHeader: (string) $timestamp,
            now: $timestamp,
        ));
        self::assertSame('evt-1', WebhookVerifier::decodeVerifiedJson(
            $body,
            $signature,
            'secret',
            timestampHeader: (string) $timestamp,
            now: $timestamp,
        )['events'][0]['id']);
    }

    public function testInvalidSignatureIsRejected(): void
    {
        $this->expectException(InvalidSignatureException::class);

        WebhookVerifier::verifyOrFail('{}', 't=1800000000,v1=' . str_repeat('0', 64), 'secret', now: 1_800_000_000);
    }

    public function testExpiredSignatureAndMismatchedTimestampHeaderAreRejected(): void
    {
        $timestamp = 1_800_000_000;
        $body = '{}';
        $signature = 't=' . $timestamp . ',v1=' . hash_hmac('sha256', $timestamp . '.' . $body, 'secret');

        self::assertFalse(WebhookVerifier::verify($body, $signature, 'secret', now: $timestamp + 301));
        self::assertFalse(WebhookVerifier::verify(
            $body,
            $signature,
            'secret',
            timestampHeader: (string) ($timestamp + 1),
            now: $timestamp,
        ));
    }
}
