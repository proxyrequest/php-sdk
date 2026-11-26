# ProxyRequest\StaticProxiesResource



All URIs are relative to https://api.proxyrequest.com/api/v1, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**checkout()**](StaticProxiesResource.md#checkout) | **POST** /static/purchases/{id}/checkout | Check out a rental reservation |
| [**createIntegrationKey()**](StaticProxiesResource.md#createIntegrationKey) | **POST** /static/integration-keys | Create a static proxy integration key |
| [**exportUrls()**](StaticProxiesResource.md#exportUrls) | **GET** /static/export | Export proxy connection URLs |
| [**getEndpoint()**](StaticProxiesResource.md#getEndpoint) | **GET** /static/endpoints/{id} | Read a rented address |
| [**getPurchase()**](StaticProxiesResource.md#getPurchase) | **GET** /static/purchases/{id} | Read a rental purchase |
| [**getThroughput()**](StaticProxiesResource.md#getThroughput) | **GET** /static/endpoints/{id}/throughput | Read current rental speed |
| [**listCatalog()**](StaticProxiesResource.md#listCatalog) | **GET** /static/catalog | List static rental offers |
| [**listEndpoints()**](StaticProxiesResource.md#listEndpoints) | **GET** /static/endpoints | List rented addresses |
| [**listIntegrationKeys()**](StaticProxiesResource.md#listIntegrationKeys) | **GET** /static/integration-keys | List static proxy integration keys |
| [**listPurchases()**](StaticProxiesResource.md#listPurchases) | **GET** /static/purchases | List static rental purchases |
| [**quoteOffer()**](StaticProxiesResource.md#quoteOffer) | **GET** /static/quotes/{offer_id} | Quote an address bundle |
| [**reserve()**](StaticProxiesResource.md#reserve) | **POST** /static/purchases | Reserve a new Order |
| [**revokeIntegrationKey()**](StaticProxiesResource.md#revokeIntegrationKey) | **DELETE** /static/integration-keys/{id} | Revoke a static proxy integration key |
| [**updateEndpoint()**](StaticProxiesResource.md#updateEndpoint) | **PATCH** /static/endpoints/{id} | Update rental access |


## `checkout()`

```php
checkout($id, $staticCheckoutRequest, $idempotencyKey, $acceptLanguage, $xImpersonateUser): \ProxyRequest\Dto\Invoice
```

Check out a rental reservation

Create one shared billing invoice for this reservation using the selected gateway, coupon and billing details. A repeated request returns the existing invoice.

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


$apiInstance = new ProxyRequest\Api\StaticProxiesResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string
$staticCheckoutRequest = {"country_code":"us","company_vat_number":"company vat number","company_name":"company name","company_registration_number":"company registration number","gateway":"revolut","crypto_currency":"btc","payment_currency":"payment currency","coupon_code":"coupon code","expected_total":1,"idempotency_key":"idempotency key"}; // \ProxyRequest\Dto\StaticCheckoutRequest
$idempotencyKey = 'idempotencyKey_example'; // string | Stable key for one logical mutation. Existing clients can send idempotency_key in the JSON body.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->checkout($id, $staticCheckoutRequest, $idempotencyKey, $acceptLanguage, $xImpersonateUser);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling StaticProxiesResource->checkout: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**|  | |
| **staticCheckoutRequest** | [**\ProxyRequest\Dto\StaticCheckoutRequest**](../Model/StaticCheckoutRequest.md)|  | |
| **idempotencyKey** | **string**| Stable key for one logical mutation. Existing clients can send idempotency_key in the JSON body. | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

### Return type

[**\ProxyRequest\Dto\Invoice**](../Model/Invoice.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: `application/json`, `application/x-www-form-urlencoded`, `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createIntegrationKey()`

```php
createIntegrationKey($integrationKeyRequestRequest, $acceptLanguage, $xImpersonateUser): \ProxyRequest\Dto\IntegrationKeyCreated
```

Create a static proxy integration key

Create a delegated key with explicit static rental scopes. The credential is returned once.

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


$apiInstance = new ProxyRequest\Api\StaticProxiesResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$integrationKeyRequestRequest = {"title":"Production integration","scopes":["read"],"allowed_ips":["198.51.100.25"]}; // \ProxyRequest\Dto\IntegrationKeyRequestRequest
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->createIntegrationKey($integrationKeyRequestRequest, $acceptLanguage, $xImpersonateUser);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling StaticProxiesResource->createIntegrationKey: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **integrationKeyRequestRequest** | [**\ProxyRequest\Dto\IntegrationKeyRequestRequest**](../Model/IntegrationKeyRequestRequest.md)|  | |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

### Return type

[**\ProxyRequest\Dto\IntegrationKeyCreated**](../Model/IntegrationKeyCreated.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: `application/json`, `application/x-www-form-urlencoded`, `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `exportUrls()`

```php
exportUrls($orderId, $protocol, $acceptLanguage, $xImpersonateUser): string
```

Export proxy connection URLs

Download active HTTP or SOCKS5 connection URLs including credentials. Select protocol=http or socks5 and optionally order_id. At most 10000 rentals can be exported at once; responses must not be cached.

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


$apiInstance = new ProxyRequest\Api\StaticProxiesResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$orderId = 'orderId_example'; // string | Filter by rental order ID.
$protocol = 'http'; // string
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->exportUrls($orderId, $protocol, $acceptLanguage, $xImpersonateUser);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling StaticProxiesResource->exportUrls: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **orderId** | **string**| Filter by rental order ID. | [optional] |
| **protocol** | **string**|  | [optional] [default to &#39;http&#39;] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

### Return type

**string**

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `text/plain`, `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getEndpoint()`

```php
getEndpoint($id, $acceptLanguage, $xImpersonateUser): \ProxyRequest\Dto\Endpoint
```

Read a rented address

Read the connection endpoints, access settings and rental periods for one owned address.

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


$apiInstance = new ProxyRequest\Api\StaticProxiesResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->getEndpoint($id, $acceptLanguage, $xImpersonateUser);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling StaticProxiesResource->getEndpoint: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**|  | |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

### Return type

[**\ProxyRequest\Dto\Endpoint**](../Model/Endpoint.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getPurchase()`

```php
getPurchase($id, $acceptLanguage, $xImpersonateUser): \ProxyRequest\Dto\PurchaseResponse
```

Read a rental purchase

Inspect the authenticated customer's reservation, immutable pricing snapshot, invoice and fulfillment status. Paid rentals start after listener acknowledgement.

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


$apiInstance = new ProxyRequest\Api\StaticProxiesResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->getPurchase($id, $acceptLanguage, $xImpersonateUser);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling StaticProxiesResource->getPurchase: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**|  | |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

### Return type

[**\ProxyRequest\Dto\PurchaseResponse**](../Model/PurchaseResponse.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getThroughput()`

```php
getThroughput($id, $acceptLanguage, $xImpersonateUser): \ProxyRequest\Dto\Throughput
```

Read current rental speed

Read combined live upload/download speed from the short-lived accounting projection. Missing or expired observations return available=false and null values; no historical usage quota is tracked.

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


$apiInstance = new ProxyRequest\Api\StaticProxiesResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->getThroughput($id, $acceptLanguage, $xImpersonateUser);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling StaticProxiesResource->getThroughput: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**|  | |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

### Return type

[**\ProxyRequest\Dto\Throughput**](../Model/Throughput.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listCatalog()`

```php
listCatalog($limit, $offset, $acceptLanguage, $xImpersonateUser): \ProxyRequest\Dto\CatalogPage
```

List static rental offers

Browse available whole-bundle prices, rental terms and optional country restrictions. Prices are in currency minor units; renewal prices apply per IP.

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


$apiInstance = new ProxyRequest\Api\StaticProxiesResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$limit = 56; // int | Page size, up to 1000. Defaults to 100.
$offset = 56; // int | Zero-based position of the first result.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->listCatalog($limit, $offset, $acceptLanguage, $xImpersonateUser);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling StaticProxiesResource->listCatalog: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **limit** | **int**| Page size, up to 1000. Defaults to 100. | [optional] |
| **offset** | **int**| Zero-based position of the first result. | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

### Return type

[**\ProxyRequest\Dto\CatalogPage**](../Model/CatalogPage.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listEndpoints()`

```php
listEndpoints($limit, $offset, $orderId, $acceptLanguage, $xImpersonateUser): \ProxyRequest\Dto\EndpointPage
```

List rented addresses

List only the authenticated customer's endpoints, their connection ports and paid periods. Optionally filter by order_id; limit and offset control pagination.

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


$apiInstance = new ProxyRequest\Api\StaticProxiesResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$limit = 56; // int | Page size, up to 1000. Defaults to 100.
$offset = 56; // int | Zero-based position of the first result.
$orderId = 'orderId_example'; // string | Filter by rental order ID.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->listEndpoints($limit, $offset, $orderId, $acceptLanguage, $xImpersonateUser);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling StaticProxiesResource->listEndpoints: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **limit** | **int**| Page size, up to 1000. Defaults to 100. | [optional] |
| **offset** | **int**| Zero-based position of the first result. | [optional] |
| **orderId** | **string**| Filter by rental order ID. | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

### Return type

[**\ProxyRequest\Dto\EndpointPage**](../Model/EndpointPage.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listIntegrationKeys()`

```php
listIntegrationKeys($acceptLanguage, $xImpersonateUser): \ProxyRequest\Dto\IntegrationKey[]
```

List static proxy integration keys

Read the current account's delegated key names, scopes and IP restrictions.

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


$apiInstance = new ProxyRequest\Api\StaticProxiesResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->listIntegrationKeys($acceptLanguage, $xImpersonateUser);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling StaticProxiesResource->listIntegrationKeys: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

### Return type

[**\ProxyRequest\Dto\IntegrationKey[]**](../Model/IntegrationKey.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listPurchases()`

```php
listPurchases($limit, $offset, $acceptLanguage, $xImpersonateUser): \ProxyRequest\Dto\StaticPurchasePage
```

List static rental purchases

List the current account's reservations and rentals without connection credentials.

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


$apiInstance = new ProxyRequest\Api\StaticProxiesResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$limit = 56; // int | Page size. Default 100, maximum 1000.
$offset = 56; // int | Number of results to skip.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->listPurchases($limit, $offset, $acceptLanguage, $xImpersonateUser);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling StaticProxiesResource->listPurchases: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **limit** | **int**| Page size. Default 100, maximum 1000. | [optional] |
| **offset** | **int**| Number of results to skip. | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

### Return type

[**\ProxyRequest\Dto\StaticPurchasePage**](../Model/StaticPurchasePage.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `quoteOffer()`

```php
quoteOffer($offerId, $acceptLanguage, $xImpersonateUser): \ProxyRequest\Dto\RentalQuote
```

Quote an address bundle

Read the current rental terms and full bundle price before reserving inventory. The quote itself does not reserve addresses or charge the account.

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


$apiInstance = new ProxyRequest\Api\StaticProxiesResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$offerId = 'offerId_example'; // string
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->quoteOffer($offerId, $acceptLanguage, $xImpersonateUser);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling StaticProxiesResource->quoteOffer: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **offerId** | **string**|  | |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

### Return type

[**\ProxyRequest\Dto\RentalQuote**](../Model/RentalQuote.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `reserve()`

```php
reserve($idempotencyKey, $acceptLanguage, $xImpersonateUser, $purchaseMutationRequest): \ProxyRequest\Dto\PurchaseResponse
```

Reserve a new Order

Reserve one package and one common rental term in one order for 15 minutes. Checkout creates the invoice separately. Include Idempotency-Key or the legacy idempotency_key.

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


$apiInstance = new ProxyRequest\Api\StaticProxiesResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$idempotencyKey = 'idempotencyKey_example'; // string | Stable key for one logical mutation. Existing clients can send idempotency_key in the JSON body.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.
$purchaseMutationRequest = {"offer_id":"550e8400-e29b-41d4-a716-446655440001","term_id":"550e8400-e29b-41d4-a716-446655440001","quantity":1,"location":{"operator":"operator","country_code":"us","region_id":"550e8400-e29b-41d4-a716-446655440001","city_id":"550e8400-e29b-41d4-a716-446655440001"},"items":[{"quantity":1,"location":{"operator":"operator","country_code":"us","region_id":"550e8400-e29b-41d4-a716-446655440001","city_id":"550e8400-e29b-41d4-a716-446655440001"},"operator":"operator"}],"idempotency_key":"idempotency key"}; // \ProxyRequest\Dto\PurchaseMutationRequest

try {
    $result = $apiInstance->reserve($idempotencyKey, $acceptLanguage, $xImpersonateUser, $purchaseMutationRequest);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling StaticProxiesResource->reserve: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **idempotencyKey** | **string**| Stable key for one logical mutation. Existing clients can send idempotency_key in the JSON body. | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |
| **purchaseMutationRequest** | [**\ProxyRequest\Dto\PurchaseMutationRequest**](../Model/PurchaseMutationRequest.md)|  | [optional] |

### Return type

[**\ProxyRequest\Dto\PurchaseResponse**](../Model/PurchaseResponse.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: `application/json`, `application/x-www-form-urlencoded`, `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `revokeIntegrationKey()`

```php
revokeIntegrationKey($id, $acceptLanguage, $xImpersonateUser)
```

Revoke a static proxy integration key

Delete a key owned by the authenticated account and reject subsequent requests made with it.

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


$apiInstance = new ProxyRequest\Api\StaticProxiesResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $apiInstance->revokeIntegrationKey($id, $acceptLanguage, $xImpersonateUser);
} catch (Exception $e) {
    echo 'Exception when calling StaticProxiesResource->revokeIntegrationKey: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**|  | |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

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

## `updateEndpoint()`

```php
updateEndpoint($id, $acceptLanguage, $xImpersonateUser, $patchedEndpointUpdateRequest): \ProxyRequest\Dto\Endpoint
```

Update rental access

Change the label, active status or allowed client IP/CIDR networks. The next node configuration update applies the policy to new and existing connections.

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


$apiInstance = new ProxyRequest\Api\StaticProxiesResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.
$patchedEndpointUpdateRequest = {"label":"label","is_active":true,"allowed_ips":["198.51.100.25"]}; // \ProxyRequest\Dto\PatchedEndpointUpdateRequest

try {
    $result = $apiInstance->updateEndpoint($id, $acceptLanguage, $xImpersonateUser, $patchedEndpointUpdateRequest);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling StaticProxiesResource->updateEndpoint: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**|  | |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |
| **patchedEndpointUpdateRequest** | [**\ProxyRequest\Dto\PatchedEndpointUpdateRequest**](../Model/PatchedEndpointUpdateRequest.md)|  | [optional] |

### Return type

[**\ProxyRequest\Dto\Endpoint**](../Model/Endpoint.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: `application/json`, `application/x-www-form-urlencoded`, `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
