# ProxyRequest\ProvidersResource

Read provider data balances and observation history. Superuser credentials required.

All URIs are relative to https://api.proxyrequest.com/api/v1, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**listDataBalances()**](ProvidersResource.md#listDataBalances) | **GET** /providers/data-balances | List provider data balances |


## `listDataBalances()`

```php
listDataBalances($limit, $offset, $acceptLanguage): \ProxyRequest\Dto\PaginatedProviderDataBalanceList
```

List provider data balances

Requires a JWT belonging to an active superuser or an API key owned by an active superuser, including requests using X-Impersonate-User. Returns one result per provider with recorded balances. The latest observation by observed_at is the baseline; available_bytes is that observation's balance, not a sum of purchased data. All byte amounts are decimal strings. Calculations are saved asynchronously; inspect freshness, error and calculated_at before using them. History is ordered by creation time descending and limited by PROVIDER_DATA_BALANCE_HISTORY_LIMIT (default 10). Pagination counts providers, not history entries.

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


$apiInstance = new ProxyRequest\Api\ProvidersResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$limit = 56; // int | Number of results to return per page.
$offset = 56; // int | The initial index from which to return the results.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English.

try {
    $result = $apiInstance->listDataBalances($limit, $offset, $acceptLanguage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProvidersResource->listDataBalances: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **limit** | **int**| Number of results to return per page. | [optional] |
| **offset** | **int**| The initial index from which to return the results. | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |

### Return type

[**\ProxyRequest\Dto\PaginatedProviderDataBalanceList**](../Model/PaginatedProviderDataBalanceList.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
