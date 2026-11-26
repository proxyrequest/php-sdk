# ProxyRequest\OrdersResource

Review purchased packages, allocated data, and proxy credentials.

All URIs are relative to https://api.proxyrequest.com/api/v1, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**cancelReservation()**](OrdersResource.md#cancelReservation) | **POST** /orders/{id}/cancel-reservation | Cancel an unissued reservation |
| [**checkout()**](OrdersResource.md#checkout) | **POST** /orders/{id}/checkout | Check out a rental reservation |
| [**delete()**](OrdersResource.md#delete) | **DELETE** /orders/{id} | Delete a sub-user order |
| [**get()**](OrdersResource.md#get) | **GET** /orders/{id} | Get an order |
| [**getAvailability()**](OrdersResource.md#getAvailability) | **GET** /orders/availability | Available static rental locations |
| [**getCalendarRenewal()**](OrdersResource.md#getCalendarRenewal) | **GET** /orders/{id}/auto-renewal | Read static calendar renewal settings |
| [**getRental()**](OrdersResource.md#getRental) | **GET** /orders/{id}/rental | Read order rental |
| [**list()**](OrdersResource.md#list) | **GET** /orders | List active orders |
| [**listCatalog()**](OrdersResource.md#listCatalog) | **GET** /orders/catalog | List static rental offers |
| [**listProducts()**](OrdersResource.md#listProducts) | **GET** /orders/products | Available proxy products |
| [**listReplacements()**](OrdersResource.md#listReplacements) | **GET** /orders/{id}/replacement-requests | List order replacement requests |
| [**quoteCheckout()**](OrdersResource.md#quoteCheckout) | **POST** /orders/{id}/checkout/quote | Quote order checkout |
| [**quotePurchase()**](OrdersResource.md#quotePurchase) | **POST** /orders/purchase/quote | Quote a static rental selection |
| [**quoteRenewal()**](OrdersResource.md#quoteRenewal) | **POST** /orders/{id}/renew/quote | Quote order renewal |
| [**renew()**](OrdersResource.md#renew) | **POST** /orders/{id}/renew | Renew an order |
| [**requestReplacement()**](OrdersResource.md#requestReplacement) | **POST** /orders/{id}/replacement-requests | Request an IP replacement |
| [**reserve()**](OrdersResource.md#reserve) | **POST** /orders/purchase | Reserve a new Order |
| [**resetPassword()**](OrdersResource.md#resetPassword) | **POST** /reset-password | Confirm an account password reset or rotate an order&#39;s proxy password |
| [**resetProxyPassword()**](OrdersResource.md#resetProxyPassword) | **POST** /orders/{id}/proxy-password/reset | Rotate the password for a static rental order |
| [**setCalendarRenewal()**](OrdersResource.md#setCalendarRenewal) | **PUT** /orders/{id}/auto-renewal | Set static calendar renewal settings |
| [**updateAutoRenewal()**](OrdersResource.md#updateAutoRenewal) | **PATCH** /orders/{id} | Update order auto-renewal |


## `cancelReservation()`

```php
cancelReservation($id, $acceptLanguage, $xImpersonateUser): \ProxyRequest\Dto\ReservationCancellation
```

Cancel an unissued reservation

Release the authenticated customer's reservation only before an invoice is created or any assignment is issued. Repeated cancellation is safe.

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


$apiInstance = new ProxyRequest\Api\OrdersResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->cancelReservation($id, $acceptLanguage, $xImpersonateUser);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrdersResource->cancelReservation: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**|  | |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

### Return type

[**\ProxyRequest\Dto\ReservationCancellation**](../Model/ReservationCancellation.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

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


$apiInstance = new ProxyRequest\Api\OrdersResource(
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
    echo 'Exception when calling OrdersResource->checkout: ', $e->getMessage(), PHP_EOL;
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

## `delete()`

```php
delete($id, $idempotencyKey, $ifMatch, $acceptLanguage, $xImpersonateUser): \ProxyRequest\Dto\UsageClosureResponse
```

Delete a sub-user order

Removes an order in the caller's permitted scope. This is destructive, not a payment refund. Deleting a virtual child order does not credit its quota to the shared ledger. An independently funded sub-user order returns only its unspent, unexpired traffic to the parent before deletion, preserving each ledger expiration date. A metered order returns 202 while its authorization and remaining usage are being settled.

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


$apiInstance = new ProxyRequest\Api\OrdersResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | A unique value identifying this Order.
$idempotencyKey = 'idempotencyKey_example'; // string | Stable key for one logical mutation. Successful responses are replayable for 24 hours; reusing a key with a different request returns 409.
$ifMatch = 'ifMatch_example'; // string | Strong ETag from the latest representation of this resource.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->delete($id, $idempotencyKey, $ifMatch, $acceptLanguage, $xImpersonateUser);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrdersResource->delete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| A unique value identifying this Order. | |
| **idempotencyKey** | **string**| Stable key for one logical mutation. Successful responses are replayable for 24 hours; reusing a key with a different request returns 409. | [optional] |
| **ifMatch** | **string**| Strong ETag from the latest representation of this resource. | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

### Return type

[**\ProxyRequest\Dto\UsageClosureResponse**](../Model/UsageClosureResponse.md)

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
get($id, $acceptLanguage, $xImpersonateUser): \ProxyRequest\Dto\OrderDetailed
```

Get an order

Returns one active order with package, usage, expiration, and proxy credential details. Virtual child data_remaining is a personal quota, not the parent's shared balance. The order's expires value is not a list of all purchased bucket deadlines; inspect each returned ledger's expires.

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


$apiInstance = new ProxyRequest\Api\OrdersResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | A unique value identifying this Order.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->get($id, $acceptLanguage, $xImpersonateUser);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrdersResource->get: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| A unique value identifying this Order. | |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

### Return type

[**\ProxyRequest\Dto\OrderDetailed**](../Model/OrderDetailed.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getAvailability()`

```php
getAvailability($allocationMode, $cityId, $countryCode, $networkClass, $operator, $packageId, $regionId, $termId, $acceptLanguage, $xImpersonateUser): \ProxyRequest\Dto\AvailabilityResponse
```

Available static rental locations

List visible purchasable packages, rental terms, countries, regions, cities and Mobile operators. Filter by package_id and network_class (isp, dc or mobile). Counts deduplicate endpoints and include capacity and port constraints; checkout rechecks inventory atomically.

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


$apiInstance = new ProxyRequest\Api\OrdersResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$allocationMode = 'allocationMode_example'; // string | * `dedicated` - dedicated * `shared` - shared
$cityId = 'cityId_example'; // string
$countryCode = 'countryCode_example'; // string
$networkClass = 'networkClass_example'; // string | * `isp` - isp * `dc` - dc * `mobile` - mobile
$operator = 'operator_example'; // string
$packageId = 'packageId_example'; // string
$regionId = 'regionId_example'; // string
$termId = 'termId_example'; // string
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->getAvailability($allocationMode, $cityId, $countryCode, $networkClass, $operator, $packageId, $regionId, $termId, $acceptLanguage, $xImpersonateUser);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrdersResource->getAvailability: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **allocationMode** | **string**| * &#x60;dedicated&#x60; - dedicated * &#x60;shared&#x60; - shared | [optional] |
| **cityId** | **string**|  | [optional] |
| **countryCode** | **string**|  | [optional] |
| **networkClass** | **string**| * &#x60;isp&#x60; - isp * &#x60;dc&#x60; - dc * &#x60;mobile&#x60; - mobile | [optional] |
| **operator** | **string**|  | [optional] |
| **packageId** | **string**|  | [optional] |
| **regionId** | **string**|  | [optional] |
| **termId** | **string**|  | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

### Return type

[**\ProxyRequest\Dto\AvailabilityResponse**](../Model/AvailabilityResponse.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getCalendarRenewal()`

```php
getCalendarRenewal($id, $acceptLanguage, $xImpersonateUser): \ProxyRequest\Dto\AutoRenewalStatus
```

Read static calendar renewal settings

Return wallet-backed renewal settings and the latest attempt for an owned static rental.

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


$apiInstance = new ProxyRequest\Api\OrdersResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->getCalendarRenewal($id, $acceptLanguage, $xImpersonateUser);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrdersResource->getCalendarRenewal: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**|  | |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

### Return type

[**\ProxyRequest\Dto\AutoRenewalStatus**](../Model/AutoRenewalStatus.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getRental()`

```php
getRental($id, $limit, $offset, $acceptLanguage, $xImpersonateUser): \ProxyRequest\Dto\RentalDetail
```

Read order rental

Read owned IPs, paid rental periods and invoice history. Pagination applies to IPs. Integration keys must also have the credentials scope to receive secrets.

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


$apiInstance = new ProxyRequest\Api\OrdersResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string
$limit = 56; // int | Page size, up to 1000. Defaults to 100.
$offset = 56; // int | Zero-based position of the first result.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->getRental($id, $limit, $offset, $acceptLanguage, $xImpersonateUser);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrdersResource->getRental: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**|  | |
| **limit** | **int**| Page size, up to 1000. Defaults to 100. | [optional] |
| **offset** | **int**| Zero-based position of the first result. | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

### Return type

[**\ProxyRequest\Dto\RentalDetail**](../Model/RentalDetail.md)

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
list($limit, $offset, $ordering, $packageAlias, $packageId, $packageType, $search, $userEmail, $userId, $acceptLanguage, $xImpersonateUser): \ProxyRequest\Dto\PaginatedOrderList
```

List active orders

Returns active package orders owned by the authenticated account. Superusers can inspect other accounts, including inactive orders; filters never expand a normal caller's ownership scope. Repeated purchases of one package reuse the same user/package order. Read data_remaining and ledgers for usable purchased data, not data minus data_spent. To inspect a managed customer, use /users/{id}/orders.

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


$apiInstance = new ProxyRequest\Api\OrdersResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$limit = 56; // int | Number of results to return per page.
$offset = 56; // int | The initial index from which to return the results.
$ordering = 'ordering_example'; // string | Which field to use when ordering the results.
$packageAlias = 'packageAlias_example'; // string
$packageId = 'packageId_example'; // string
$packageType = 'packageType_example'; // string | * `static` - Static * `residential` - Residential
$search = 'search_example'; // string | Case-insensitive partial search across Order fields: `id`, `alias`, `internal_id`, and `proxy_password`. Separate multiple terms with spaces or commas; every term must match at least one listed field.
$userEmail = 'userEmail_example'; // string
$userId = 'userId_example'; // string
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->list($limit, $offset, $ordering, $packageAlias, $packageId, $packageType, $search, $userEmail, $userId, $acceptLanguage, $xImpersonateUser);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrdersResource->list: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **limit** | **int**| Number of results to return per page. | [optional] |
| **offset** | **int**| The initial index from which to return the results. | [optional] |
| **ordering** | **string**| Which field to use when ordering the results. | [optional] |
| **packageAlias** | **string**|  | [optional] |
| **packageId** | **string**|  | [optional] |
| **packageType** | **string**| * &#x60;static&#x60; - Static * &#x60;residential&#x60; - Residential | [optional] |
| **search** | **string**| Case-insensitive partial search across Order fields: &#x60;id&#x60;, &#x60;alias&#x60;, &#x60;internal_id&#x60;, and &#x60;proxy_password&#x60;. Separate multiple terms with spaces or commas; every term must match at least one listed field. | [optional] |
| **userEmail** | **string**|  | [optional] |
| **userId** | **string**|  | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

### Return type

[**\ProxyRequest\Dto\PaginatedOrderList**](../Model/PaginatedOrderList.md)

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


$apiInstance = new ProxyRequest\Api\OrdersResource(
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
    echo 'Exception when calling OrdersResource->listCatalog: ', $e->getMessage(), PHP_EOL;
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

## `listProducts()`

```php
listProducts($acceptLanguage, $xImpersonateUser): \ProxyRequest\Dto\Products
```

Available proxy products

Return legacy enabled product types plus networks with purchasable packages and real stock. Networks are residential, isp, datacenter and mobile; unavailable or unconfigured networks are omitted. Mobile requires lease-aware gateway support.

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


$apiInstance = new ProxyRequest\Api\OrdersResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->listProducts($acceptLanguage, $xImpersonateUser);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrdersResource->listProducts: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

### Return type

[**\ProxyRequest\Dto\Products**](../Model/Products.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listReplacements()`

```php
listReplacements($id, $limit, $offset, $acceptLanguage, $xImpersonateUser): \ProxyRequest\Dto\ReplacementPage
```

List order replacement requests

Read replacement requests for an owned static rental order, including per-IP status. Results are paginated.

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


$apiInstance = new ProxyRequest\Api\OrdersResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string
$limit = 56; // int | Page size, up to 1000. Defaults to 100.
$offset = 56; // int | Zero-based position of the first result.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->listReplacements($id, $limit, $offset, $acceptLanguage, $xImpersonateUser);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrdersResource->listReplacements: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**|  | |
| **limit** | **int**| Page size, up to 1000. Defaults to 100. | [optional] |
| **offset** | **int**| Zero-based position of the first result. | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

### Return type

[**\ProxyRequest\Dto\ReplacementPage**](../Model/ReplacementPage.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `quoteCheckout()`

```php
quoteCheckout($id, $staticCheckoutRequest, $acceptLanguage, $xImpersonateUser): \ProxyRequest\Dto\CheckoutQuote
```

Quote order checkout

Preview the billing price and the external IP groups fixed in this reservation.

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


$apiInstance = new ProxyRequest\Api\OrdersResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string
$staticCheckoutRequest = {"country_code":"us","company_vat_number":"company vat number","company_name":"company name","company_registration_number":"company registration number","gateway":"revolut","crypto_currency":"btc","payment_currency":"payment currency","coupon_code":"coupon code","expected_total":1,"idempotency_key":"idempotency key"}; // \ProxyRequest\Dto\StaticCheckoutRequest
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->quoteCheckout($id, $staticCheckoutRequest, $acceptLanguage, $xImpersonateUser);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrdersResource->quoteCheckout: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**|  | |
| **staticCheckoutRequest** | [**\ProxyRequest\Dto\StaticCheckoutRequest**](../Model/StaticCheckoutRequest.md)|  | |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

### Return type

[**\ProxyRequest\Dto\CheckoutQuote**](../Model/CheckoutQuote.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: `application/json`, `application/x-www-form-urlencoded`, `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `quotePurchase()`

```php
quotePurchase($acceptLanguage, $xImpersonateUser, $intentRequest): \ProxyRequest\Dto\RentalQuote
```

Quote a static rental selection

Calculate one all-units quantity tier across all items in one package and term without reserving or charging. Overlapping geographic and operator scopes cannot double-count inventory. Supports the compatible single-location form. Proxy location is separate from billing country.

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


$apiInstance = new ProxyRequest\Api\OrdersResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.
$intentRequest = {"offer_id":"550e8400-e29b-41d4-a716-446655440001","term_id":"550e8400-e29b-41d4-a716-446655440001","quantity":1,"location":{"operator":"operator","country_code":"us","region_id":"550e8400-e29b-41d4-a716-446655440001","city_id":"550e8400-e29b-41d4-a716-446655440001"},"items":[{"quantity":1,"location":{"operator":"operator","country_code":"us","region_id":"550e8400-e29b-41d4-a716-446655440001","city_id":"550e8400-e29b-41d4-a716-446655440001"},"operator":"operator"}]}; // \ProxyRequest\Dto\IntentRequest

try {
    $result = $apiInstance->quotePurchase($acceptLanguage, $xImpersonateUser, $intentRequest);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrdersResource->quotePurchase: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |
| **intentRequest** | [**\ProxyRequest\Dto\IntentRequest**](../Model/IntentRequest.md)|  | [optional] |

### Return type

[**\ProxyRequest\Dto\RentalQuote**](../Model/RentalQuote.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: `application/json`, `application/x-www-form-urlencoded`, `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `quoteRenewal()`

```php
quoteRenewal($id, $renewalSelectionRequest, $acceptLanguage, $xImpersonateUser): \ProxyRequest\Dto\RenewalQuote
```

Quote order renewal

Preview the complete price for a renewal, including billing adjustments, without creating an invoice.

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


$apiInstance = new ProxyRequest\Api\OrdersResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string
$renewalSelectionRequest = {"term_id":"550e8400-e29b-41d4-a716-446655440001","endpoint_ids":["550e8400-e29b-41d4-a716-446655440001"],"all_endpoints":false,"invoice":{"country_code":"us","company_vat_number":"company vat number","company_name":"company name","company_registration_number":"company registration number","gateway":"revolut","crypto_currency":"btc","payment_currency":"payment currency","coupon_code":"coupon code"}}; // \ProxyRequest\Dto\RenewalSelectionRequest
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->quoteRenewal($id, $renewalSelectionRequest, $acceptLanguage, $xImpersonateUser);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrdersResource->quoteRenewal: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**|  | |
| **renewalSelectionRequest** | [**\ProxyRequest\Dto\RenewalSelectionRequest**](../Model/RenewalSelectionRequest.md)|  | |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

### Return type

[**\ProxyRequest\Dto\RenewalQuote**](../Model/RenewalQuote.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: `application/json`, `application/x-www-form-urlencoded`, `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `renew()`

```php
renew($id, $renewalRequestRequest, $idempotencyKey, $acceptLanguage, $xImpersonateUser): \ProxyRequest\Dto\Invoice
```

Renew an order

Create an invoice on this order for selected IPs or all eligible IPs. The idempotency key prevents repeated charges.

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


$apiInstance = new ProxyRequest\Api\OrdersResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string
$renewalRequestRequest = {"term_id":"550e8400-e29b-41d4-a716-446655440001","endpoint_ids":["550e8400-e29b-41d4-a716-446655440001"],"all_endpoints":false,"invoice":{"country_code":"us","company_vat_number":"company vat number","company_name":"company name","company_registration_number":"company registration number","gateway":"revolut","crypto_currency":"btc","payment_currency":"payment currency","coupon_code":"coupon code"},"idempotency_key":"idempotency key","expected_total":1}; // \ProxyRequest\Dto\RenewalRequestRequest
$idempotencyKey = 'idempotencyKey_example'; // string | Stable key for one logical mutation. Existing clients can send idempotency_key in the JSON body.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->renew($id, $renewalRequestRequest, $idempotencyKey, $acceptLanguage, $xImpersonateUser);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrdersResource->renew: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**|  | |
| **renewalRequestRequest** | [**\ProxyRequest\Dto\RenewalRequestRequest**](../Model/RenewalRequestRequest.md)|  | |
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

## `requestReplacement()`

```php
requestReplacement($id, $replacementRequestRequest, $idempotencyKey, $acceptLanguage, $xImpersonateUser): \ProxyRequest\Dto\ReplacementResponse
```

Request an IP replacement

Submit distinct active endpoints from one owned order and a reason for administrator approval. A custom reason is limited to 255 characters. Pending requests do not reserve inventory or change the paid rental period.

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


$apiInstance = new ProxyRequest\Api\OrdersResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string
$replacementRequestRequest = {"endpoint_ids":["550e8400-e29b-41d4-a716-446655440001"],"reason":"not_working","details":"","idempotency_key":"idempotency key"}; // \ProxyRequest\Dto\ReplacementRequestRequest
$idempotencyKey = 'idempotencyKey_example'; // string | Stable key for one logical mutation. Existing clients can send idempotency_key in the JSON body.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->requestReplacement($id, $replacementRequestRequest, $idempotencyKey, $acceptLanguage, $xImpersonateUser);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrdersResource->requestReplacement: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**|  | |
| **replacementRequestRequest** | [**\ProxyRequest\Dto\ReplacementRequestRequest**](../Model/ReplacementRequestRequest.md)|  | |
| **idempotencyKey** | **string**| Stable key for one logical mutation. Existing clients can send idempotency_key in the JSON body. | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

### Return type

[**\ProxyRequest\Dto\ReplacementResponse**](../Model/ReplacementResponse.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: `application/json`, `application/x-www-form-urlencoded`, `multipart/form-data`
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


$apiInstance = new ProxyRequest\Api\OrdersResource(
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
    echo 'Exception when calling OrdersResource->reserve: ', $e->getMessage(), PHP_EOL;
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

## `resetPassword()`

```php
resetPassword($resetPasswordRequest, $acceptLanguage, $xImpersonateUser): \ProxyRequest\Dto\ProxyPasswordResetResponse
```

Confirm an account password reset or rotate an order's proxy password

Recover a login password using a valid reset token, or send order_id with authentication to rotate a proxy password for an owned order. Static rental clients can use the order-scoped password reset operation.

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


$apiInstance = new ProxyRequest\Api\OrdersResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$resetPasswordRequest = {"uidb64":"uidb64","token":"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0b2tlbl90eXBlIjoiYWNjZXNzIiwidXNlcl9pZCI6IjU1MGU4NDAwLWUyOWItNDFkNC1hNzE2LTQ0NjY1NTQ0MDAwMSJ9.example-signature","new_password1":"New-Secure-Password-43","new_password2":"New-Secure-Password-43","turnstile_token":"turnstile token"}; // \ProxyRequest\Dto\ResetPasswordRequest
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->resetPassword($resetPasswordRequest, $acceptLanguage, $xImpersonateUser);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrdersResource->resetPassword: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **resetPasswordRequest** | [**\ProxyRequest\Dto\ResetPasswordRequest**](../Model/ResetPasswordRequest.md)|  | |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

### Return type

[**\ProxyRequest\Dto\ProxyPasswordResetResponse**](../Model/ProxyPasswordResetResponse.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: `application/json`, `application/x-www-form-urlencoded`, `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `resetProxyPassword()`

```php
resetProxyPassword($id, $acceptLanguage, $xImpersonateUser): \ProxyRequest\Dto\ProxyPasswordResetResponse
```

Rotate the password for a static rental order

Rotate the password for an owned static rental order. Read the rental again to obtain the new credentials.

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


$apiInstance = new ProxyRequest\Api\OrdersResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->resetProxyPassword($id, $acceptLanguage, $xImpersonateUser);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrdersResource->resetProxyPassword: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**|  | |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

### Return type

[**\ProxyRequest\Dto\ProxyPasswordResetResponse**](../Model/ProxyPasswordResetResponse.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `setCalendarRenewal()`

```php
setCalendarRenewal($id, $autoRenewalSettingsRequest, $acceptLanguage, $xImpersonateUser): \ProxyRequest\Dto\AutoRenewalStatus
```

Set static calendar renewal settings

Enable automatic wallet renewal for the selected active term, or disable future attempts.

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


$apiInstance = new ProxyRequest\Api\OrdersResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string
$autoRenewalSettingsRequest = {"enabled":true,"term_id":"550e8400-e29b-41d4-a716-446655440001"}; // \ProxyRequest\Dto\AutoRenewalSettingsRequest
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->setCalendarRenewal($id, $autoRenewalSettingsRequest, $acceptLanguage, $xImpersonateUser);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrdersResource->setCalendarRenewal: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**|  | |
| **autoRenewalSettingsRequest** | [**\ProxyRequest\Dto\AutoRenewalSettingsRequest**](../Model/AutoRenewalSettingsRequest.md)|  | |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

### Return type

[**\ProxyRequest\Dto\AutoRenewalStatus**](../Model/AutoRenewalStatus.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: `application/json`, `application/x-www-form-urlencoded`, `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateAutoRenewal()`

```php
updateAutoRenewal($id, $ifMatch, $acceptLanguage, $xImpersonateUser, $patchedOrderAutoRenewalRequest): \ProxyRequest\Dto\Order
```

Update order auto-renewal

Updates only the auto-renewal threshold and top-up amount for an active order owned by the authenticated account. Set both values to zero to disable it.

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


$apiInstance = new ProxyRequest\Api\OrdersResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | A unique value identifying this Order.
$ifMatch = 'ifMatch_example'; // string | Strong ETag from the latest representation of this resource.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.
$patchedOrderAutoRenewalRequest = {"auto_renewal_percentage":1,"auto_renewal_data":1}; // \ProxyRequest\Dto\PatchedOrderAutoRenewalRequest

try {
    $result = $apiInstance->updateAutoRenewal($id, $ifMatch, $acceptLanguage, $xImpersonateUser, $patchedOrderAutoRenewalRequest);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrdersResource->updateAutoRenewal: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| A unique value identifying this Order. | |
| **ifMatch** | **string**| Strong ETag from the latest representation of this resource. | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |
| **patchedOrderAutoRenewalRequest** | [**\ProxyRequest\Dto\PatchedOrderAutoRenewalRequest**](../Model/PatchedOrderAutoRenewalRequest.md)|  | [optional] |

### Return type

[**\ProxyRequest\Dto\Order**](../Model/Order.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: `application/json`, `application/x-www-form-urlencoded`, `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
