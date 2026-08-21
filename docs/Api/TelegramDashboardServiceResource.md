# ProxyRequest\TelegramDashboardServiceResource



All URIs are relative to https://api.proxyrequest.com/api/v1, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**consumeLink()**](TelegramDashboardServiceResource.md#consumeLink) | **POST** /integrations/telegram/link/consume | Consume a Telegram account link |
| [**createSession()**](TelegramDashboardServiceResource.md#createSession) | **POST** /integrations/telegram/session | Create a Telegram API session |


## `consumeLink()`

```php
consumeLink($xProxyRequestTelegramSecret, $telegramLinkConsumeRequest, $acceptLanguage): \ProxyRequest\Dto\TelegramConnectionResponse
```

Consume a Telegram account link

Links a private Telegram chat after validating the single-use token.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new ProxyRequest\Api\TelegramDashboardServiceResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$xProxyRequestTelegramSecret = 'xProxyRequestTelegramSecret_example'; // string | Shared service credential configured on the ProxyRequest bot runtime.
$telegramLinkConsumeRequest = {"token":"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0b2tlbl90eXBlIjoiYWNjZXNzIiwidXNlcl9pZCI6IjU1MGU4NDAwLWUyOWItNDFkNC1hNzE2LTQ0NjY1NTQ0MDAwMSJ9.example-signature","telegram_user_id":"550e8400-e29b-41d4-a716-446655440001","chat_id":"550e8400-e29b-41d4-a716-446655440001","username":"developer","language_code":"language code"}; // \ProxyRequest\Dto\TelegramLinkConsumeRequest
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English.

try {
    $result = $apiInstance->consumeLink($xProxyRequestTelegramSecret, $telegramLinkConsumeRequest, $acceptLanguage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TelegramDashboardServiceResource->consumeLink: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xProxyRequestTelegramSecret** | **string**| Shared service credential configured on the ProxyRequest bot runtime. | |
| **telegramLinkConsumeRequest** | [**\ProxyRequest\Dto\TelegramLinkConsumeRequest**](../Model/TelegramLinkConsumeRequest.md)|  | |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |

### Return type

[**\ProxyRequest\Dto\TelegramConnectionResponse**](../Model/TelegramConnectionResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`, `application/x-www-form-urlencoded`, `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createSession()`

```php
createSession($xProxyRequestTelegramSecret, $telegramSessionRequest, $acceptLanguage): \ProxyRequest\Dto\TelegramSessionResponse
```

Create a Telegram API session

Returns a two-minute access token for an already linked private chat.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new ProxyRequest\Api\TelegramDashboardServiceResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$xProxyRequestTelegramSecret = 'xProxyRequestTelegramSecret_example'; // string | Shared service credential configured on the ProxyRequest bot runtime.
$telegramSessionRequest = {"telegram_user_id":"550e8400-e29b-41d4-a716-446655440001","chat_id":"550e8400-e29b-41d4-a716-446655440001"}; // \ProxyRequest\Dto\TelegramSessionRequest
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English.

try {
    $result = $apiInstance->createSession($xProxyRequestTelegramSecret, $telegramSessionRequest, $acceptLanguage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TelegramDashboardServiceResource->createSession: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xProxyRequestTelegramSecret** | **string**| Shared service credential configured on the ProxyRequest bot runtime. | |
| **telegramSessionRequest** | [**\ProxyRequest\Dto\TelegramSessionRequest**](../Model/TelegramSessionRequest.md)|  | |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |

### Return type

[**\ProxyRequest\Dto\TelegramSessionResponse**](../Model/TelegramSessionResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`, `application/x-www-form-urlencoded`, `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
