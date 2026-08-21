# ProxyRequest\PackagesResource

Browse available proxy products, pricing, and targeting capabilities.

All URIs are relative to https://api.proxyrequest.com/api/v1, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**list()**](PackagesResource.md#list) | **GET** /packages | List available proxy packages |
| [**listCommissions()**](PackagesResource.md#listCommissions) | **GET** /packages/commissions | List affiliate package commissions |


## `list()`

```php
list($alias, $limit, $offset, $ordering, $pricingUnit, $search, $type, $acceptLanguage): \ProxyRequest\Dto\PaginatedPackageList
```

List available proxy packages

Returns public packages and private packages already assigned to the authenticated account, including pricing and targeting capabilities.

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


$apiInstance = new ProxyRequest\Api\PackagesResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$alias = 'alias_example'; // string
$limit = 56; // int | Number of results to return per page.
$offset = 56; // int | The initial index from which to return the results.
$ordering = 'ordering_example'; // string | Which field to use when ordering the results.
$pricingUnit = 'pricingUnit_example'; // string | Unit customers purchase — determines how the billing model amounts are interpreted. * `data` - Data * `proxy` - Proxy
$search = 'search_example'; // string | Case-insensitive partial search across Package fields: `name` and `alias`. Separate multiple terms with spaces or commas; every term must match at least one listed field.
$type = 'type_example'; // string | * `static` - Static * `residential` - Residential
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English.

try {
    $result = $apiInstance->list($alias, $limit, $offset, $ordering, $pricingUnit, $search, $type, $acceptLanguage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PackagesResource->list: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **alias** | **string**|  | [optional] |
| **limit** | **int**| Number of results to return per page. | [optional] |
| **offset** | **int**| The initial index from which to return the results. | [optional] |
| **ordering** | **string**| Which field to use when ordering the results. | [optional] |
| **pricingUnit** | **string**| Unit customers purchase — determines how the billing model amounts are interpreted. * &#x60;data&#x60; - Data * &#x60;proxy&#x60; - Proxy | [optional] |
| **search** | **string**| Case-insensitive partial search across Package fields: &#x60;name&#x60; and &#x60;alias&#x60;. Separate multiple terms with spaces or commas; every term must match at least one listed field. | [optional] |
| **type** | **string**| * &#x60;static&#x60; - Static * &#x60;residential&#x60; - Residential | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |

### Return type

[**\ProxyRequest\Dto\PaginatedPackageList**](../Model/PaginatedPackageList.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listCommissions()`

```php
listCommissions($alias, $limit, $offset, $ordering, $pricingUnit, $type, $acceptLanguage): \ProxyRequest\Dto\PaginatedPackageCommissionList
```

List affiliate package commissions

Returns commission rates, paid earnings, pending earnings, and referred order totals for each package visible to an approved marketer.

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


$apiInstance = new ProxyRequest\Api\PackagesResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$alias = 'alias_example'; // string
$limit = 56; // int | Number of results to return per page.
$offset = 56; // int | The initial index from which to return the results.
$ordering = 'ordering_example'; // string | Which field to use when ordering the results.
$pricingUnit = 'pricingUnit_example'; // string | Unit customers purchase — determines how the billing model amounts are interpreted. * `data` - Data * `proxy` - Proxy
$type = 'type_example'; // string | * `static` - Static * `residential` - Residential
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English.

try {
    $result = $apiInstance->listCommissions($alias, $limit, $offset, $ordering, $pricingUnit, $type, $acceptLanguage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PackagesResource->listCommissions: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **alias** | **string**|  | [optional] |
| **limit** | **int**| Number of results to return per page. | [optional] |
| **offset** | **int**| The initial index from which to return the results. | [optional] |
| **ordering** | **string**| Which field to use when ordering the results. | [optional] |
| **pricingUnit** | **string**| Unit customers purchase — determines how the billing model amounts are interpreted. * &#x60;data&#x60; - Data * &#x60;proxy&#x60; - Proxy | [optional] |
| **type** | **string**| * &#x60;static&#x60; - Static * &#x60;residential&#x60; - Residential | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |

### Return type

[**\ProxyRequest\Dto\PaginatedPackageCommissionList**](../Model/PaginatedPackageCommissionList.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
