# ProxyRequest\ProxiesResource

Generate ready-to-use proxy credentials for an active order.

All URIs are relative to https://api.proxyrequest.com/api/v1, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**generate()**](ProxiesResource.md#generate) | **POST** /proxies/generate | Generate proxy credentials |


## `generate()`

```php
generate($generateProxyRequest, $acceptLanguage): \ProxyRequest\Dto\GenerateProxyResponse
```

Generate proxy credentials

Creates ready-to-use proxy credentials for a purchased package. Use targeting to choose a location or provider scope, connection to choose protocol and output format, and session to control sticky session lifetime.

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


$apiInstance = new ProxyRequest\Api\ProxiesResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$generateProxyRequest = {"package_id":"550e8400-e29b-41d4-a716-446655440002","quantity":2,"targeting":{"country":"us","region":"california","city":"los_angeles","isp":"comcast"},"connection":{"protocol":"http","format":"{host}:{port}:{username}:{password}"},"session":{"ttl":60}}; // \ProxyRequest\Dto\GenerateProxyRequest
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English.

try {
    $result = $apiInstance->generate($generateProxyRequest, $acceptLanguage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProxiesResource->generate: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **generateProxyRequest** | [**\ProxyRequest\Dto\GenerateProxyRequest**](../Model/GenerateProxyRequest.md)|  | |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |

### Return type

[**\ProxyRequest\Dto\GenerateProxyResponse**](../Model/GenerateProxyResponse.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: `application/json`, `application/x-www-form-urlencoded`, `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
