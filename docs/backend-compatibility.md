# Backend compatibility and MFA

The SDK pins the unfiltered public schema and its source commit/SHA-256 under
`openapi/`. Generation excludes the two disabled sessions-management operations:
79 supported operations in 17 groups. `$client->sessions()` and its resource/DTOs
are removed; proxy-generation sticky-session options remain supported.

## Login

Password and Google login return `TokenPairResponse` for HTTP 200 or `OTPChallenge`
for HTTP 202. Complete the challenge before using an authenticated client:

```php
use ProxyRequest\Client;
use ProxyRequest\Dto\LoginRequest;
use ProxyRequest\Dto\OTPChallenge;
use ProxyRequest\Dto\VerifyOTPRequest;

$anonymous = Client::anonymous();
$result = $anonymous->authorization()->login(new LoginRequest([
    'email' => $email,
    'password' => $password,
]));
if ($result instanceof OTPChallenge) {
    $result = $anonymous->authorization()->verifyOtp(new VerifyOTPRequest([
        'challenge' => $result->getChallenge(),
        'code' => $readCode(), // Obtain the current code from the user.
    ]));
}
$client = Client::withBearerToken($result->getToken());
```

`loginWithGoogle(new GoogleAuthRequest(['credential' => $credential]))` returns the
same union. Async methods such as `loginAsync` and `verifyOtpAsync` resolve to the
same DTOs; chain their promises or call `wait()`. Refresh-token storage and token
renewal remain explicit caller responsibilities.

## MFA management

```php
use ProxyRequest\Dto\TwoFactorConfirmRequest;
use ProxyRequest\Dto\TwoFactorDisableRequest;
use ProxyRequest\Dto\TwoFactorSetupRequestRequest;

$setup = $client->profile()->setupTwoFactor(
    twoFactorSetupRequestRequest: new TwoFactorSetupRequestRequest(['password' => $password]),
);
// Present $setup->getOtpauthUrl() securely and obtain the enrollment code.
$client->profile()->confirmTwoFactor(new TwoFactorConfirmRequest(['code' => $enrollmentCode]));
// Sign in again before subsequent authenticated operations.
$client->profile()->disableTwoFactor(new TwoFactorDisableRequest([
    'password' => $password,
    'code' => $currentCode,
]));
```

For Google-authenticated accounts use a freshly obtained `credential` instead of
`password`. Replacing an existing authenticator also requires its current `code`
in the setup body. Use the named setup argument: its generated positional signature
starts with optional `acceptLanguage`. The doubled `RequestRequest` suffix comes
from the canonical schema. MFA confirmation/disable and password changes can
invalidate JWTs; reauthenticate instead of automatically replaying security calls.

## Models and transport

- `InvoiceRead` is an interface implemented by `Invoice` and `InvoiceShort`.
  Use `instanceof Invoice` before accessing full-only fields. Creation returns
  `Invoice`; package, country, and coupon may be explicitly null.
- User allocation fields and orders depend on backend configuration. Serialization
  preserves the distinction between omitted and explicitly null fields.
- New payment fields are typed. Gateway strings tolerate future values. Unknown
  DTO fields survive deserialization/serialization through `getAdditionalProperties()`.
- Sync and async use the same status-aware response parser. Invalid JSON and model
  failures retain status, raw body, headers, actual idempotency key, and the original
  exception in `ApiException`. Network errors are normalized without assuming every
  Guzzle exception has a response. Do not retry an ambiguous create with a fresh key.
- `*WithResponse` methods retain successful response metadata.
- `withLanguage()` supplies the default for both built-in and injected transports;
  a per-request `acceptLanguage` argument takes precedence.

Regression tests use backend serializer fixtures and mocked transports, including
sync/async OTP and failure paths. See [audit and resolution status](SDK-AUDIT.md).
