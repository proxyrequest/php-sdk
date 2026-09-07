<?php

declare(strict_types=1);

namespace ProxyRequest\Tests\Unit;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use ProxyRequest\ApiException;
use ProxyRequest\Client;
use ProxyRequest\Dto\GoogleAuthRequest;
use ProxyRequest\Dto\Invoice;
use ProxyRequest\Dto\InvoiceCreateRequest;
use ProxyRequest\Dto\InvoiceRead;
use ProxyRequest\Dto\InvoiceShort;
use ProxyRequest\Dto\LoginRequest;
use ProxyRequest\Dto\OTPChallenge;
use ProxyRequest\Dto\TokenPairResponse;
use ProxyRequest\Dto\TwoFactorDisableRequest;
use ProxyRequest\Dto\TwoFactorSetupRequestRequest;
use ProxyRequest\Dto\VerifyOTPRequest;
use ProxyRequest\ObjectSerializer;

final class BackendCompatibilityTest extends TestCase
{
    private static function fixtures(): array
    {
        return json_decode((string) file_get_contents(\dirname(__DIR__) . '/fixtures/backend-responses.json'), true, 512, JSON_THROW_ON_ERROR);
    }

    private static function client(MockHandler $mock): Client
    {
        return Client::builder()->anonymous()->withHttpClient(new GuzzleClient(['handler' => HandlerStack::create($mock), 'http_errors' => false]))->build();
    }

    public function testPasswordAndGoogleOtpFlowsSyncAndAsync(): void
    {
        foreach ([false, true] as $async) {
            foreach ([false, true] as $google) {
                $mock = new MockHandler([
                    new Response(202, [], '{"status":"otp_required","challenge":"synthetic","expires_in":300}'),
                    new Response(200, [], '{"token":"access","refresh":"refresh"}'),
                ]);
                $resource = self::client($mock)->authorization();
                $method = ($google ? 'loginWithGoogle' : 'login') . ($async ? 'Async' : '');
                $body = $google ? new GoogleAuthRequest(['credential' => 'synthetic']) : new LoginRequest(['email' => 'sdk@example.com', 'password' => 'synthetic']);
                $challenge = $resource->{$method}($body);
                $challenge = $async ? $challenge->wait() : $challenge;
                self::assertInstanceOf(OTPChallenge::class, $challenge);
                self::assertSame('synthetic', $challenge->getChallenge());
                $method = $async ? 'verifyOtpAsync' : 'verifyOtp';
                $tokens = $resource->{$method}(new VerifyOTPRequest(['challenge' => $challenge->getChallenge(), 'code' => '123456']));
                $tokens = $async ? $tokens->wait() : $tokens;
                self::assertInstanceOf(TokenPairResponse::class, $tokens);
                self::assertSame('access', $tokens->getToken());
                self::assertSame('/api/v1/login/otp', $mock->getLastRequest()->getUri()->getPath());
            }
        }
    }

    public function testMfaBodiesContainPrimaryFactor(): void
    {
        foreach ([false, true] as $async) {
            $mock = new MockHandler([
                new Response(200, [], '{"secret":"synthetic","otpauth_url":"otpauth://totp/sdk"}'),
                new Response(200, [], '{"enabled":false}'),
            ]);
            $resource = self::client($mock)->profile();
            $method = $async ? 'setupTwoFactorAsync' : 'setupTwoFactor';
            $response = $resource->{$method}(twoFactorSetupRequestRequest: new TwoFactorSetupRequestRequest(['password' => 'synthetic', 'code' => '123456']));
            if ($async) {
                $response->wait();
            }
            self::assertSame(['password' => 'synthetic', 'code' => '123456'], json_decode((string) $mock->getLastRequest()->getBody(), true));
            $method = $async ? 'disableTwoFactorAsync' : 'disableTwoFactor';
            $response = $resource->{$method}(new TwoFactorDisableRequest(['credential' => 'synthetic-google', 'code' => '123456']));
            if ($async) {
                $response->wait();
            }
            self::assertEquals(['code' => '123456', 'credential' => 'synthetic-google'], json_decode((string) $mock->getLastRequest()->getBody(), true));
        }
    }

    public function testRuntimeInvoicesNullableVariantsAndUnknownFields(): void
    {
        $fixtures = self::fixtures();
        $full = [...$fixtures['invoice_full'], 'gateway' => 'future-provider', 'future_field' => ['kept' => true]];
        foreach ([false, true] as $async) {
            $mock = new MockHandler([
                new Response(201, [], json_encode($full, JSON_THROW_ON_ERROR)),
                new Response(200, [], json_encode($fixtures['invoice_short'], JSON_THROW_ON_ERROR)),
                new Response(200, [], json_encode(['count' => 2, 'next' => null, 'previous' => null, 'results' => [$full, $fixtures['invoice_short']]], JSON_THROW_ON_ERROR)),
            ]);
            $resource = self::client($mock)->invoices();
            $method = $async ? 'createAsync' : 'create';
            $invoice = $resource->{$method}(new InvoiceCreateRequest(['gateway' => 'whitepay', 'amount' => 500, 'paymentCurrency' => 'UAH']));
            $invoice = $async ? $invoice->wait() : $invoice;
            self::assertInstanceOf(Invoice::class, $invoice);
            self::assertInstanceOf(InvoiceRead::class, $invoice);
            self::assertNull($invoice->getPackage());
            self::assertNull($invoice->getCoupon());
            self::assertTrue($invoice->valid(), implode(', ', $invoice->listInvalidProperties()));
            self::assertSame('future-provider', $invoice->getGateway());
            self::assertSame(500, $invoice->getPaymentAmount());
            self::assertEquals(['future_field' => (object) ['kept' => true]], $invoice->getAdditionalProperties());
            self::assertTrue(ObjectSerializer::sanitizeForSerialization($invoice)->future_field->kept);
            self::assertSame('UAH', json_decode((string) $mock->getLastRequest()->getBody(), true)['payment_currency']);
            $method = $async ? 'getAsync' : 'get';
            $short = $resource->{$method}($fixtures['invoice_short']['id']);
            $short = $async ? $short->wait() : $short;
            self::assertInstanceOf(InvoiceShort::class, $short);
            self::assertTrue($short->valid(), implode(', ', $short->listInvalidProperties()));
            $method = $async ? 'listAsync' : 'list';
            $page = $resource->{$method}();
            $page = $async ? $page->wait() : $page;
            self::assertInstanceOf(Invoice::class, $page->getResults()[0]);
            self::assertInstanceOf(InvoiceShort::class, $page->getResults()[1]);
        }
    }

    public function testRuntimeUserModesAndLanguagePrecedence(): void
    {
        foreach ([false, true] as $injected) {
            $mock = new MockHandler(array_map(static fn(array $payload): Response => new Response(200, [], json_encode($payload, JSON_THROW_ON_ERROR)), [self::fixtures()['user_legacy'], self::fixtures()['user_package']]));
            $builder = Client::builder()->anonymous()->withLanguage('uk');
            if ($injected) {
                $builder = $builder->withHttpClient(new GuzzleClient(['handler' => HandlerStack::create($mock)]));
            }
            $client = $builder->build();
            if (!$injected) {
                $transport = new \ReflectionProperty(Client::class, 'httpClient')->getValue($client);
                $transport->getConfig('handler')->setHandler($mock);
            }
            $legacy = $client->profile()->get();
            self::assertSame('uk', $mock->getLastRequest()->getHeaderLine('Accept-Language'));
            self::assertSame(0, $legacy->getData());
            self::assertNull($legacy->getOrders());
            self::assertObjectNotHasProperty('orders', ObjectSerializer::sanitizeForSerialization($legacy));
            $package = $client->profile()->getAsync('de')->wait();
            self::assertSame('de', $mock->getLastRequest()->getHeaderLine('Accept-Language'));
            self::assertSame([], $package->getOrders());
            self::assertObjectNotHasProperty('data', ObjectSerializer::sanitizeForSerialization($package));
        }
    }

    public function testDecodeAndHttpFailuresRetainMetadataAndRequestKey(): void
    {
        foreach ([false, true] as $async) {
            foreach ([201, 400, 502] as $status) {
                $body = 502 === $status ? '{"invoice_id":"created","retryable":true}' : '<html>bad</html>';
                $mock = new MockHandler([new Response($status, ['X-Request-ID' => 'sdk-request'], $body)]);
                $resource = self::client($mock)->invoices();
                try {
                    $method = $async ? 'createAsync' : 'create';
                    $value = $resource->{$method}(new InvoiceCreateRequest(['gateway' => 'wallet', 'amount' => 500]));
                    if ($async) {
                        $value->wait();
                    }
                    self::fail('Expected ApiException');
                } catch (ApiException $error) {
                    self::assertSame($status, $error->getStatusCode());
                    self::assertSame($body, $error->getResponseBody());
                    self::assertSame('sdk-request', $error->getRequestId());
                    self::assertNotEmpty($error->getIdempotencyKey());
                    self::assertSame($mock->getLastRequest()->getHeaderLine('Idempotency-Key'), $error->getIdempotencyKey());
                }
            }
        }
    }

    public function testAsyncConnectionFailureIsNormalizedAfterRetries(): void
    {
        $error = new ConnectException('synthetic connection failure', new Request('POST', '/invoices'));
        $mock = new MockHandler([$error, $error, $error]);
        try {
            self::client($mock)->invoices()->createAsync(new InvoiceCreateRequest(['gateway' => 'wallet', 'amount' => 500]))->wait();
            self::fail('Expected ApiException');
        } catch (ApiException $failure) {
            self::assertSame(0, $failure->getStatusCode());
            self::assertSame($error, $failure->getPrevious());
            self::assertNotEmpty($failure->getIdempotencyKey());
            self::assertSame($mock->getLastRequest()->getHeaderLine('Idempotency-Key'), $failure->getIdempotencyKey());
            self::assertCount(0, $mock);
        }
    }
}
