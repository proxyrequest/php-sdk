# ProxyRequest\KYCResource

Identity verification status and hosted sessions.

All URIs are relative to https://api.proxyrequest.com/api/v1, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**createSession()**](KYCResource.md#createSession) | **POST** /kyc/sessions/ | Start identity verification |
| [**getStatus()**](KYCResource.md#getStatus) | **GET** /kyc/ | Read identity verification status |


## `createSession()`

```php
createSession($idempotencyKey, $sessionInputRequest, $acceptLanguage, $xImpersonateUser): \ProxyRequest\Dto\SessionOutput
```

Start identity verification

Create or resume a provider-hosted verification session for the authenticated account. Supply a stable Idempotency-Key; the server selects the user and environment.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: StaticAuth
$config = ProxyRequest\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = ProxyRequest\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');

// Configure Bearer (JWT) authorization: BearerAuth
$config = ProxyRequest\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new ProxyRequest\Api\KYCResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$idempotencyKey = 'idempotencyKey_example'; // string
$sessionInputRequest = {"provider":"stripe"}; // \ProxyRequest\Dto\SessionInputRequest
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->createSession($idempotencyKey, $sessionInputRequest, $acceptLanguage, $xImpersonateUser);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling KYCResource->createSession: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **idempotencyKey** | **string**|  | |
| **sessionInputRequest** | [**\ProxyRequest\Dto\SessionInputRequest**](../Model/SessionInputRequest.md)|  | |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

### Return type

[**\ProxyRequest\Dto\SessionOutput**](../Model/SessionOutput.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: `application/json`, `application/x-www-form-urlencoded`, `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getStatus()`

```php
getStatus($acceptLanguage, $xImpersonateUser): \ProxyRequest\Dto\Status
```

Read identity verification status

Read the authenticated account's verification state in the server-selected environment. Provider evidence and credentials are never returned.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: StaticAuth
$config = ProxyRequest\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = ProxyRequest\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');

// Configure Bearer (JWT) authorization: BearerAuth
$config = ProxyRequest\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new ProxyRequest\Api\KYCResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->getStatus($acceptLanguage, $xImpersonateUser);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling KYCResource->getStatus: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

### Return type

[**\ProxyRequest\Dto\Status**](../Model/Status.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
