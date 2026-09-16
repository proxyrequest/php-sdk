<?php

declare(strict_types=1);

namespace ProxyRequest\Tests\Unit;

use PHPUnit\Framework\TestCase;
use ProxyRequest\Webhook\InvalidSignatureException;
use ProxyRequest\Webhook\WebhookVerifier;

final class WebhookVerifierTest extends TestCase
{
    public function testAccountantBase64Vectors(): void
    {
        $json = file_get_contents(__DIR__ . '/../fixtures/webhook-signatures.json');
        self::assertIsString($json);
        /** @var list<array{body: string, secret: string, signature: string, jsonObject: bool}> $vectors */
        $vectors = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        foreach ($vectors as $vector) {
            ['body' => $body, 'secret' => $secret, 'signature' => $signature] = $vector;
            self::assertSame($signature, base64_encode(hash_hmac('sha256', $body, $secret, true)));
            self::assertTrue(WebhookVerifier::verify($body, $signature, $secret));
            WebhookVerifier::verifyOrFail($body, $signature, $secret);
            self::assertFalse(WebhookVerifier::verify($body . ' ', $signature, $secret));
            self::assertFalse(WebhookVerifier::verify($body, $signature, 'wrong'));
            if ($vector['jsonObject']) {
                self::assertSame(json_decode($body, true, 512, JSON_THROW_ON_ERROR), WebhookVerifier::decodeVerifiedJson($body, $signature, $secret));
            } else {
                try {
                    WebhookVerifier::decodeVerifiedJson($body, $signature, $secret);
                    self::fail('A non-object payload must be rejected.');
                } catch (\UnexpectedValueException) {
                    // Authentication succeeded, but this is not a JSON object.
                }
            }
        }
    }

    public function testMalformedBase64IsRejectedBeforeJsonDecoding(): void
    {
        $header = '5wDDfJLTJLjXr4cfnNOxikeVi5Cy4qZleyqDMRlZ048=';
        foreach (['', ' ', substr($header, 0, -1), $header . "\n", str_replace('8=', '9=', $header), str_repeat('A', 44), str_repeat('A', 64)] as $malformed) {
            self::assertFalse(WebhookVerifier::verify('{"hello":"world"}', $malformed, 'super-secret'));
            try {
                WebhookVerifier::decodeVerifiedJson('not json', $malformed, 'super-secret');
                self::fail('An invalid signature must be rejected before parsing JSON.');
            } catch (InvalidSignatureException) {
                // Expected: not a JSON decoding error.
            }
        }
        self::assertFalse(WebhookVerifier::verify('{"hello":"world"}', $header, ''));
    }
}
