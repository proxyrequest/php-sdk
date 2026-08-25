# ProxyRequest\WebhooksResource

Configure customer webhook destinations and delivery behaviour.

All URIs are relative to https://api.proxyrequest.com/api/v1, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**create()**](WebhooksResource.md#create) | **POST** /webhooks | Create a customer webhook |
| [**delete()**](WebhooksResource.md#delete) | **DELETE** /webhooks/{id} | Delete a customer webhook |
| [**get()**](WebhooksResource.md#get) | **GET** /webhooks/{id} | Get a customer webhook |
| [**list()**](WebhooksResource.md#list) | **GET** /webhooks | List customer webhooks |


## `create()`

```php
create($webhookCreateRequest, $idempotencyKey, $acceptLanguage): \ProxyRequest\Dto\WebhookCreated
```

Create a customer webhook

Registers an HTTPS destination for a supported event type. Private, loopback, and otherwise unsafe destinations are rejected.

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


$apiInstance = new ProxyRequest\Api\WebhooksResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$webhookCreateRequest = {"type":"user","endpoint":"https://developer.example.com/webhooks/proxy-events","read_timeout":5,"write_timeout":5,"retries":3,"retry_timeout":10}; // \ProxyRequest\Dto\WebhookCreateRequest
$idempotencyKey = 'idempotencyKey_example'; // string | Stable key for one logical mutation. Successful responses are replayable for 24 hours; reusing a key with a different request returns 409.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English.

try {
    $result = $apiInstance->create($webhookCreateRequest, $idempotencyKey, $acceptLanguage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling WebhooksResource->create: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **webhookCreateRequest** | [**\ProxyRequest\Dto\WebhookCreateRequest**](../Model/WebhookCreateRequest.md)|  | |
| **idempotencyKey** | **string**| Stable key for one logical mutation. Successful responses are replayable for 24 hours; reusing a key with a different request returns 409. | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |

### Return type

[**\ProxyRequest\Dto\WebhookCreated**](../Model/WebhookCreated.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: `application/json`, `application/x-www-form-urlencoded`, `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `delete()`

```php
delete($id, $idempotencyKey, $ifMatch, $acceptLanguage)
```

Delete a customer webhook

Stops future event delivery to the selected destination and removes the webhook configuration.

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


$apiInstance = new ProxyRequest\Api\WebhooksResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | A unique value identifying this Webhook.
$idempotencyKey = 'idempotencyKey_example'; // string | Stable key for one logical mutation. Successful responses are replayable for 24 hours; reusing a key with a different request returns 409.
$ifMatch = 'ifMatch_example'; // string | Strong ETag from the latest representation of this resource.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English.

try {
    $apiInstance->delete($id, $idempotencyKey, $ifMatch, $acceptLanguage);
} catch (Exception $e) {
    echo 'Exception when calling WebhooksResource->delete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| A unique value identifying this Webhook. | |
| **idempotencyKey** | **string**| Stable key for one logical mutation. Successful responses are replayable for 24 hours; reusing a key with a different request returns 409. | [optional] |
| **ifMatch** | **string**| Strong ETag from the latest representation of this resource. | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |

### Return type

void (empty response body)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `get()`

```php
get($id, $acceptLanguage): \ProxyRequest\Dto\WebhookList
```

Get a customer webhook

Returns one webhook destination owned by the authenticated account.

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


$apiInstance = new ProxyRequest\Api\WebhooksResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | A unique value identifying this Webhook.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English.

try {
    $result = $apiInstance->get($id, $acceptLanguage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling WebhooksResource->get: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| A unique value identifying this Webhook. | |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |

### Return type

[**\ProxyRequest\Dto\WebhookList**](../Model/WebhookList.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `list()`

```php
list($limit, $offset, $acceptLanguage): \ProxyRequest\Dto\PaginatedWebhookList
```

List customer webhooks

Returns webhook destinations configured by the authenticated account, including delivery timeouts and retry settings.

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


$apiInstance = new ProxyRequest\Api\WebhooksResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$limit = 56; // int | Number of results to return per page.
$offset = 56; // int | The initial index from which to return the results.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English.

try {
    $result = $apiInstance->list($limit, $offset, $acceptLanguage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling WebhooksResource->list: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **limit** | **int**| Number of results to return per page. | [optional] |
| **offset** | **int**| The initial index from which to return the results. | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |

### Return type

[**\ProxyRequest\Dto\PaginatedWebhookList**](../Model/PaginatedWebhookList.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
