# ProxyRequest\AuthorizationResource

Sign in, create accounts, recover access, and refresh access tokens.

All URIs are relative to https://api.proxyrequest.com/api/v1, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**login()**](AuthorizationResource.md#login) | **POST** /login | Sign in with email or username |
| [**loginWithGoogle()**](AuthorizationResource.md#loginWithGoogle) | **POST** /login/google | Sign in with Google |
| [**recoverPassword()**](AuthorizationResource.md#recoverPassword) | **POST** /recover-password | Send a password recovery email |
| [**refresh()**](AuthorizationResource.md#refresh) | **POST** /refresh | Refresh an access token |
| [**signup()**](AuthorizationResource.md#signup) | **POST** /signup | Create a customer account |


## `login()`

```php
login($loginRequest, $acceptLanguage): \ProxyRequest\Dto\TokenPairResponse
```

Sign in with email or username

Checks account credentials and returns an access token plus a refresh token. Send the access token as `Authorization: Bearer `.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new ProxyRequest\Api\AuthorizationResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$loginRequest = {"email":"developer@example.com","password":"Correct-Horse-Battery-Staple-42"}; // \ProxyRequest\Dto\LoginRequest
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English.

try {
    $result = $apiInstance->login($loginRequest, $acceptLanguage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AuthorizationResource->login: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **loginRequest** | [**\ProxyRequest\Dto\LoginRequest**](../Model/LoginRequest.md)|  | |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |

### Return type

[**\ProxyRequest\Dto\TokenPairResponse**](../Model/TokenPairResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`, `application/x-www-form-urlencoded`, `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `loginWithGoogle()`

```php
loginWithGoogle($googleAuthRequest, $acceptLanguage): \ProxyRequest\Dto\TokenPairResponse
```

Sign in with Google

Verifies a Google ID token, creates or links the matching customer account when needed, and returns an API token pair.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new ProxyRequest\Api\AuthorizationResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$googleAuthRequest = {"credential":"google-id-token"}; // \ProxyRequest\Dto\GoogleAuthRequest
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English.

try {
    $result = $apiInstance->loginWithGoogle($googleAuthRequest, $acceptLanguage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AuthorizationResource->loginWithGoogle: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **googleAuthRequest** | [**\ProxyRequest\Dto\GoogleAuthRequest**](../Model/GoogleAuthRequest.md)|  | |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |

### Return type

[**\ProxyRequest\Dto\TokenPairResponse**](../Model/TokenPairResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`, `application/x-www-form-urlencoded`, `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `recoverPassword()`

```php
recoverPassword($recoverPasswordRequest, $acceptLanguage): \ProxyRequest\Dto\PasswordRecoveryResponse
```

Send a password recovery email

Validates the anti-bot token and sends account recovery instructions to the supplied email address.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new ProxyRequest\Api\AuthorizationResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$recoverPasswordRequest = {"email":"developer@example.com","token":"turnstile-response-token"}; // \ProxyRequest\Dto\RecoverPasswordRequest
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English.

try {
    $result = $apiInstance->recoverPassword($recoverPasswordRequest, $acceptLanguage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AuthorizationResource->recoverPassword: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **recoverPasswordRequest** | [**\ProxyRequest\Dto\RecoverPasswordRequest**](../Model/RecoverPasswordRequest.md)|  | |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |

### Return type

[**\ProxyRequest\Dto\PasswordRecoveryResponse**](../Model/PasswordRecoveryResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`, `application/x-www-form-urlencoded`, `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `refresh()`

```php
refresh($tokenRefreshRequest, $acceptLanguage): \ProxyRequest\Dto\TokenRefreshResponse
```

Refresh an access token

Uses a valid refresh token to issue a new short-lived access token for the same account session.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new ProxyRequest\Api\AuthorizationResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$tokenRefreshRequest = {"refresh":"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0b2tlbl90eXBlIjoicmVmcmVzaCIsInVzZXJfaWQiOiI1NTBlODQwMC1lMjliLTQxZDQtYTcxNi00NDY2NTU0NDAwMDEifQ.example-signature"}; // \ProxyRequest\Dto\TokenRefreshRequest
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English.

try {
    $result = $apiInstance->refresh($tokenRefreshRequest, $acceptLanguage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AuthorizationResource->refresh: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **tokenRefreshRequest** | [**\ProxyRequest\Dto\TokenRefreshRequest**](../Model/TokenRefreshRequest.md)|  | |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |

### Return type

[**\ProxyRequest\Dto\TokenRefreshResponse**](../Model/TokenRefreshResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`, `application/x-www-form-urlencoded`, `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `signup()`

```php
signup($signUpRequest, $acceptLanguage): \ProxyRequest\Dto\TokenPairResponse
```

Create a customer account

Creates an account after validating the email, password, and Cloudflare Turnstile token. Referral and affiliate codes are optional.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new ProxyRequest\Api\AuthorizationResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$signUpRequest = {"email":"developer@example.com","password":"Correct-Horse-Battery-Staple-42","token":"turnstile-response-token","referral_code":"FRIEND2026","affiliate_code":"DEVCOMMUNITY"}; // \ProxyRequest\Dto\SignUpRequest
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English.

try {
    $result = $apiInstance->signup($signUpRequest, $acceptLanguage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AuthorizationResource->signup: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **signUpRequest** | [**\ProxyRequest\Dto\SignUpRequest**](../Model/SignUpRequest.md)|  | |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |

### Return type

[**\ProxyRequest\Dto\TokenPairResponse**](../Model/TokenPairResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`, `application/x-www-form-urlencoded`, `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
