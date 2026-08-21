# ProxyRequest\CouponsResource

Create, validate, redeem, and inspect discount coupons.

All URIs are relative to https://api.proxyrequest.com/api/v1, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**calculatePrice()**](CouponsResource.md#calculatePrice) | **POST** /coupons/calculate-price | Calculate a discounted price |
| [**create()**](CouponsResource.md#create) | **POST** /coupons | Create a coupon |
| [**delete()**](CouponsResource.md#delete) | **DELETE** /coupons/{id} | Delete a coupon |
| [**get()**](CouponsResource.md#get) | **GET** /coupons/{id} | Get a coupon |
| [**list()**](CouponsResource.md#list) | **GET** /coupons | List available coupons |
| [**listRedeems()**](CouponsResource.md#listRedeems) | **GET** /coupons/{id}/redeems | List coupon redemptions |
| [**replace()**](CouponsResource.md#replace) | **PUT** /coupons/{id} | Replace a coupon |
| [**update()**](CouponsResource.md#update) | **PATCH** /coupons/{id} | Update a coupon |


## `calculatePrice()`

```php
calculatePrice($couponCalculatePriceRequest, $acceptLanguage): \ProxyRequest\Dto\CouponPriceResponse
```

Calculate a discounted price

Validates a coupon against the selected package and data amount, then returns both the original and discounted prices without creating an invoice.

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


$apiInstance = new ProxyRequest\Api\CouponsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$couponCalculatePriceRequest = {"package_id":"550e8400-e29b-41d4-a716-446655440002","coupon_code":"WELCOME20","data":10737418240}; // \ProxyRequest\Dto\CouponCalculatePriceRequest
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English.

try {
    $result = $apiInstance->calculatePrice($couponCalculatePriceRequest, $acceptLanguage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CouponsResource->calculatePrice: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **couponCalculatePriceRequest** | [**\ProxyRequest\Dto\CouponCalculatePriceRequest**](../Model/CouponCalculatePriceRequest.md)|  | |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |

### Return type

[**\ProxyRequest\Dto\CouponPriceResponse**](../Model/CouponPriceResponse.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: `application/json`, `application/x-www-form-urlencoded`, `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `create()`

```php
create($couponCreateRequest, $acceptLanguage): \ProxyRequest\Dto\Coupon
```

Create a coupon

Creates a coupon. This operation is restricted to administrators.

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


$apiInstance = new ProxyRequest\Api\CouponsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$couponCreateRequest = {"value":1,"code":"us","is_multi_use":true,"is_available_to_one_time":true,"marketer":"550e8400-e29b-41d4-a716-446655440001","type":"free_data","limit":100,"valid_until":"2026-07-01T12:30:00Z","packages":["package"]}; // \ProxyRequest\Dto\CouponCreateRequest
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English.

try {
    $result = $apiInstance->create($couponCreateRequest, $acceptLanguage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CouponsResource->create: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **couponCreateRequest** | [**\ProxyRequest\Dto\CouponCreateRequest**](../Model/CouponCreateRequest.md)|  | |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |

### Return type

[**\ProxyRequest\Dto\Coupon**](../Model/Coupon.md)

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
delete($id, $acceptLanguage)
```

Delete a coupon

Deletes a coupon that is no longer needed. Staff access is required.

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


$apiInstance = new ProxyRequest\Api\CouponsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | A unique value identifying this Coupon.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English.

try {
    $apiInstance->delete($id, $acceptLanguage);
} catch (Exception $e) {
    echo 'Exception when calling CouponsResource->delete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| A unique value identifying this Coupon. | |
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
get($id, $acceptLanguage): \ProxyRequest\Dto\CouponShort
```

Get a coupon

Returns one coupon visible within the caller's account scope.

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


$apiInstance = new ProxyRequest\Api\CouponsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | A unique value identifying this Coupon.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English.

try {
    $result = $apiInstance->get($id, $acceptLanguage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CouponsResource->get: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| A unique value identifying this Coupon. | |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |

### Return type

[**\ProxyRequest\Dto\CouponShort**](../Model/CouponShort.md)

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
list($code, $limit, $offset, $ordering, $search, $type, $acceptLanguage): \ProxyRequest\Dto\PaginatedCouponShortList
```

List available coupons

Returns coupons visible to the authenticated account. Staff accounts receive administrative fields; customers receive the public coupon view.

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


$apiInstance = new ProxyRequest\Api\CouponsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$code = 'code_example'; // string
$limit = 56; // int | Number of results to return per page.
$offset = 56; // int | The initial index from which to return the results.
$ordering = 'ordering_example'; // string | Which field to use when ordering the results.
$search = 'search_example'; // string | Case-insensitive partial search across Coupon fields: `title` and `content`. Separate multiple terms with spaces or commas; every term must match at least one listed field.
$type = 'type_example'; // string | * `free_data` - Free Data * `monetary` - Money * `percentage` - Percentage
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English.

try {
    $result = $apiInstance->list($code, $limit, $offset, $ordering, $search, $type, $acceptLanguage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CouponsResource->list: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **code** | **string**|  | [optional] |
| **limit** | **int**| Number of results to return per page. | [optional] |
| **offset** | **int**| The initial index from which to return the results. | [optional] |
| **ordering** | **string**| Which field to use when ordering the results. | [optional] |
| **search** | **string**| Case-insensitive partial search across Coupon fields: &#x60;title&#x60; and &#x60;content&#x60;. Separate multiple terms with spaces or commas; every term must match at least one listed field. | [optional] |
| **type** | **string**| * &#x60;free_data&#x60; - Free Data * &#x60;monetary&#x60; - Money * &#x60;percentage&#x60; - Percentage | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |

### Return type

[**\ProxyRequest\Dto\PaginatedCouponShortList**](../Model/PaginatedCouponShortList.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listRedeems()`

```php
listRedeems($id, $code, $limit, $offset, $ordering, $type, $acceptLanguage): \ProxyRequest\Dto\PaginatedCouponRedeemList
```

List coupon redemptions

Returns accounts and invoices that redeemed the selected coupon.

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


$apiInstance = new ProxyRequest\Api\CouponsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | A unique value identifying this Coupon.
$code = 'code_example'; // string
$limit = 56; // int | Number of results to return per page.
$offset = 56; // int | The initial index from which to return the results.
$ordering = 'ordering_example'; // string | Which field to use when ordering the results.
$type = 'type_example'; // string | * `free_data` - Free Data * `monetary` - Money * `percentage` - Percentage
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English.

try {
    $result = $apiInstance->listRedeems($id, $code, $limit, $offset, $ordering, $type, $acceptLanguage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CouponsResource->listRedeems: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| A unique value identifying this Coupon. | |
| **code** | **string**|  | [optional] |
| **limit** | **int**| Number of results to return per page. | [optional] |
| **offset** | **int**| The initial index from which to return the results. | [optional] |
| **ordering** | **string**| Which field to use when ordering the results. | [optional] |
| **type** | **string**| * &#x60;free_data&#x60; - Free Data * &#x60;monetary&#x60; - Money * &#x60;percentage&#x60; - Percentage | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |

### Return type

[**\ProxyRequest\Dto\PaginatedCouponRedeemList**](../Model/PaginatedCouponRedeemList.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `replace()`

```php
replace($id, $couponUpdateRequest, $acceptLanguage): \ProxyRequest\Dto\Coupon
```

Replace a coupon

Replaces the writable fields of a coupon. Staff access is required.

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


$apiInstance = new ProxyRequest\Api\CouponsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | A unique value identifying this Coupon.
$couponUpdateRequest = {"value":1,"code":"us","is_multi_use":true,"is_available_to_one_time":true,"marketer":"550e8400-e29b-41d4-a716-446655440001","type":"free_data","limit":100,"valid_until":"2026-07-01T12:30:00Z","packages":["package"]}; // \ProxyRequest\Dto\CouponUpdateRequest
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English.

try {
    $result = $apiInstance->replace($id, $couponUpdateRequest, $acceptLanguage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CouponsResource->replace: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| A unique value identifying this Coupon. | |
| **couponUpdateRequest** | [**\ProxyRequest\Dto\CouponUpdateRequest**](../Model/CouponUpdateRequest.md)|  | |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |

### Return type

[**\ProxyRequest\Dto\Coupon**](../Model/Coupon.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: `application/json`, `application/x-www-form-urlencoded`, `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `update()`

```php
update($id, $acceptLanguage, $patchedCouponUpdateRequest): \ProxyRequest\Dto\Coupon
```

Update a coupon

Updates selected coupon fields. Staff access is required.

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


$apiInstance = new ProxyRequest\Api\CouponsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | A unique value identifying this Coupon.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$patchedCouponUpdateRequest = {"value":1,"code":"us","is_multi_use":true,"is_available_to_one_time":true,"marketer":"550e8400-e29b-41d4-a716-446655440001","type":"free_data","limit":100,"valid_until":"2026-07-01T12:30:00Z","packages":["package"]}; // \ProxyRequest\Dto\PatchedCouponUpdateRequest

try {
    $result = $apiInstance->update($id, $acceptLanguage, $patchedCouponUpdateRequest);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CouponsResource->update: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| A unique value identifying this Coupon. | |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **patchedCouponUpdateRequest** | [**\ProxyRequest\Dto\PatchedCouponUpdateRequest**](../Model/PatchedCouponUpdateRequest.md)|  | [optional] |

### Return type

[**\ProxyRequest\Dto\Coupon**](../Model/Coupon.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: `application/json`, `application/x-www-form-urlencoded`, `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
