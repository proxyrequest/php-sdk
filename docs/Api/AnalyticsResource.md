# ProxyRequest\AnalyticsResource

Inspect proxy traffic, connections, domains, errors, and data transactions.

All URIs are relative to https://api.proxyrequest.com/api/v1, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getConnections()**](AnalyticsResource.md#getConnections) | **GET** /analytics/connections | List active proxy connections |
| [**getOverall()**](AnalyticsResource.md#getOverall) | **GET** /analytics/overall | Get traffic totals over time |
| [**getTransactions()**](AnalyticsResource.md#getTransactions) | **GET** /analytics/{id}/transactions | List data transactions |
| [**listDomains()**](AnalyticsResource.md#listDomains) | **GET** /analytics/domains | List top destination domains |
| [**listFeed()**](AnalyticsResource.md#listFeed) | **GET** /analytics/feed | List proxy request activity |
| [**listLogs()**](AnalyticsResource.md#listLogs) | **GET** /analytics/logs | List proxy error logs |


## `getConnections()`

```php
getConnections($limit, $offset, $packageId, $userId, $acceptLanguage): \ProxyRequest\Dto\ConnectionsResponse
```

List active proxy connections

Returns a paginated snapshot of active connections for the selected user and package scope.

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


$apiInstance = new ProxyRequest\Api\AnalyticsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$limit = 56; // int | Maximum records returned on this page.
$offset = 56; // int | Zero-based number of matching records to skip.
$packageId = 550e8400-e29b-41d4-a716-446655440002; // string | Restrict results to one purchased package.
$userId = 550e8400-e29b-41d4-a716-446655440001; // string | Restrict results to the current account or an accessible sub-user.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English.

try {
    $result = $apiInstance->getConnections($limit, $offset, $packageId, $userId, $acceptLanguage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AnalyticsResource->getConnections: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **limit** | **int**| Maximum records returned on this page. | [optional] |
| **offset** | **int**| Zero-based number of matching records to skip. | [optional] |
| **packageId** | **string**| Restrict results to one purchased package. | [optional] |
| **userId** | **string**| Restrict results to the current account or an accessible sub-user. | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |

### Return type

[**\ProxyRequest\Dto\ConnectionsResponse**](../Model/ConnectionsResponse.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getOverall()`

```php
getOverall($end, $includeSubUsers, $limit, $offset, $packageId, $start, $timezone, $userId, $acceptLanguage): \ProxyRequest\Dto\OverallResponse
```

Get traffic totals over time

Returns transferred bytes and request counts grouped into time buckets for charts and usage reporting.

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


$apiInstance = new ProxyRequest\Api\AnalyticsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$end = 2026-07-02T00:00:00Z; // \DateTime | Exclusive end of the reporting window.
$includeSubUsers = false; // bool | Aggregate the selected user's data with all of their sub-users. Superusers can apply this to any selected user; resellers can apply it to their own account. Ignored for regular users. Defaults to false.
$limit = 56; // int | Maximum records returned on this page.
$offset = 56; // int | Zero-based number of matching records to skip.
$packageId = 550e8400-e29b-41d4-a716-446655440002; // string | Restrict results to one purchased package.
$start = 2026-07-01T00:00:00Z; // \DateTime | Inclusive start of the reporting window. Defaults to a recent window.
$timezone = UTC; // string | IANA timezone used for bucket boundaries. Defaults to UTC.
$userId = 550e8400-e29b-41d4-a716-446655440001; // string | Restrict results to the current account or an accessible sub-user.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English.

try {
    $result = $apiInstance->getOverall($end, $includeSubUsers, $limit, $offset, $packageId, $start, $timezone, $userId, $acceptLanguage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AnalyticsResource->getOverall: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **end** | **\DateTime**| Exclusive end of the reporting window. | [optional] |
| **includeSubUsers** | **bool**| Aggregate the selected user&#39;s data with all of their sub-users. Superusers can apply this to any selected user; resellers can apply it to their own account. Ignored for regular users. Defaults to false. | [optional] [default to false] |
| **limit** | **int**| Maximum records returned on this page. | [optional] |
| **offset** | **int**| Zero-based number of matching records to skip. | [optional] |
| **packageId** | **string**| Restrict results to one purchased package. | [optional] |
| **start** | **\DateTime**| Inclusive start of the reporting window. Defaults to a recent window. | [optional] |
| **timezone** | **string**| IANA timezone used for bucket boundaries. Defaults to UTC. | [optional] |
| **userId** | **string**| Restrict results to the current account or an accessible sub-user. | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |

### Return type

[**\ProxyRequest\Dto\OverallResponse**](../Model/OverallResponse.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getTransactions()`

```php
getTransactions($id, $end, $limit, $offset, $recipientId, $senderId, $start, $timezone, $type, $acceptLanguage): \ProxyRequest\Dto\TransactionsResponse
```

List data transactions

Returns data allocation and consumption transactions visible to the caller. Sender and recipient filters are restricted to the caller's scope.

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


$apiInstance = new ProxyRequest\Api\AnalyticsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | Route identifier for this analytics action. Use query parameters to filter transactions.
$end = 2026-07-02T00:00:00Z; // \DateTime | Exclusive end of the reporting window.
$limit = 56; // int | Maximum records returned on this page.
$offset = 56; // int | Zero-based number of matching records to skip.
$recipientId = 'recipientId_example'; // string | Restrict transactions to this recipient account.
$senderId = 'senderId_example'; // string | Restrict transactions to this sender account.
$start = 2026-07-01T00:00:00Z; // \DateTime | Inclusive start of the reporting window. Defaults to a recent window.
$timezone = UTC; // string | IANA timezone used for bucket boundaries. Defaults to UTC.
$type = 56; // int | Transaction type identifier. Defaults to data transactions.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English.

try {
    $result = $apiInstance->getTransactions($id, $end, $limit, $offset, $recipientId, $senderId, $start, $timezone, $type, $acceptLanguage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AnalyticsResource->getTransactions: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| Route identifier for this analytics action. Use query parameters to filter transactions. | |
| **end** | **\DateTime**| Exclusive end of the reporting window. | [optional] |
| **limit** | **int**| Maximum records returned on this page. | [optional] |
| **offset** | **int**| Zero-based number of matching records to skip. | [optional] |
| **recipientId** | **string**| Restrict transactions to this recipient account. | [optional] |
| **senderId** | **string**| Restrict transactions to this sender account. | [optional] |
| **start** | **\DateTime**| Inclusive start of the reporting window. Defaults to a recent window. | [optional] |
| **timezone** | **string**| IANA timezone used for bucket boundaries. Defaults to UTC. | [optional] |
| **type** | **int**| Transaction type identifier. Defaults to data transactions. | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |

### Return type

[**\ProxyRequest\Dto\TransactionsResponse**](../Model/TransactionsResponse.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listDomains()`

```php
listDomains($end, $hostname, $includeSubUsers, $ledgerId, $limit, $offset, $ordering, $packageId, $search, $start, $timezone, $userId, $acceptLanguage): \ProxyRequest\Dto\DomainsResponse
```

List top destination domains

Aggregates request count and transferred bytes by destination hostname for the selected reporting window and account scope.

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


$apiInstance = new ProxyRequest\Api\AnalyticsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$end = 2026-07-02T00:00:00Z; // \DateTime | Exclusive end of the reporting window.
$hostname = example.com,api.example.com; // string | Comma-separated hostnames to include.
$includeSubUsers = false; // bool | Aggregate the selected user's data with all of their sub-users. Superusers can apply this to any selected user; resellers can apply it to their own account. Ignored for regular users. Defaults to false.
$ledgerId = 550e8400-e29b-41d4-a716-446655440005; // string | Restrict results to one data ledger when supported.
$limit = 56; // int | Maximum records returned on this page.
$offset = 56; // int | Zero-based number of matching records to skip.
$ordering = '-data'; // string | Sort domains by transferred data or request count.
$packageId = 550e8400-e29b-41d4-a716-446655440002; // string | Restrict results to one purchased package.
$search = 'search_example'; // string | Case-insensitive partial match against the listed field: `hostname`.
$start = 2026-07-01T00:00:00Z; // \DateTime | Inclusive start of the reporting window. Defaults to a recent window.
$timezone = UTC; // string | IANA timezone used for bucket boundaries. Defaults to UTC.
$userId = 550e8400-e29b-41d4-a716-446655440001; // string | Restrict results to the current account or an accessible sub-user.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English.

try {
    $result = $apiInstance->listDomains($end, $hostname, $includeSubUsers, $ledgerId, $limit, $offset, $ordering, $packageId, $search, $start, $timezone, $userId, $acceptLanguage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AnalyticsResource->listDomains: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **end** | **\DateTime**| Exclusive end of the reporting window. | [optional] |
| **hostname** | **string**| Comma-separated hostnames to include. | [optional] |
| **includeSubUsers** | **bool**| Aggregate the selected user&#39;s data with all of their sub-users. Superusers can apply this to any selected user; resellers can apply it to their own account. Ignored for regular users. Defaults to false. | [optional] [default to false] |
| **ledgerId** | **string**| Restrict results to one data ledger when supported. | [optional] |
| **limit** | **int**| Maximum records returned on this page. | [optional] |
| **offset** | **int**| Zero-based number of matching records to skip. | [optional] |
| **ordering** | **string**| Sort domains by transferred data or request count. | [optional] [default to &#39;-data&#39;] |
| **packageId** | **string**| Restrict results to one purchased package. | [optional] |
| **search** | **string**| Case-insensitive partial match against the listed field: &#x60;hostname&#x60;. | [optional] |
| **start** | **\DateTime**| Inclusive start of the reporting window. Defaults to a recent window. | [optional] |
| **timezone** | **string**| IANA timezone used for bucket boundaries. Defaults to UTC. | [optional] |
| **userId** | **string**| Restrict results to the current account or an accessible sub-user. | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |

### Return type

[**\ProxyRequest\Dto\DomainsResponse**](../Model/DomainsResponse.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listFeed()`

```php
listFeed($city, $country, $end, $hostname, $ledgerId, $limit, $offset, $packageId, $protocol, $region, $search, $start, $timezone, $userId, $acceptLanguage): \ProxyRequest\Dto\FeedResponse
```

List proxy request activity

Returns recent proxy requests with traffic, endpoint, location, protocol, package, and sticky-session details.

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


$apiInstance = new ProxyRequest\Api\AnalyticsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$city = los_angeles; // string | Normalized city targeting code. country and region are required.
$country = us; // string | Lowercase ISO 3166-1 alpha-2 country code.
$end = 2026-07-02T00:00:00Z; // \DateTime | Exclusive end of the reporting window.
$hostname = example.com,api.example.com; // string | Comma-separated hostnames to include.
$ledgerId = 550e8400-e29b-41d4-a716-446655440005; // string | Restrict results to one data ledger when supported.
$limit = 56; // int | Maximum records returned on this page.
$offset = 56; // int | Zero-based number of matching records to skip.
$packageId = 550e8400-e29b-41d4-a716-446655440002; // string | Restrict results to one purchased package.
$protocol = 'protocol_example'; // string | Proxy protocol: http or socks5.
$region = california; // string | Normalized region targeting code. country is required.
$search = 'search_example'; // string | Case-insensitive partial match against the listed field: `hostname`.
$start = 2026-07-01T00:00:00Z; // \DateTime | Inclusive start of the reporting window. Defaults to a recent window.
$timezone = UTC; // string | IANA timezone used for bucket boundaries. Defaults to UTC.
$userId = 550e8400-e29b-41d4-a716-446655440001; // string | Restrict results to the current account or an accessible sub-user.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English.

try {
    $result = $apiInstance->listFeed($city, $country, $end, $hostname, $ledgerId, $limit, $offset, $packageId, $protocol, $region, $search, $start, $timezone, $userId, $acceptLanguage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AnalyticsResource->listFeed: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **city** | **string**| Normalized city targeting code. country and region are required. | [optional] |
| **country** | **string**| Lowercase ISO 3166-1 alpha-2 country code. | [optional] |
| **end** | **\DateTime**| Exclusive end of the reporting window. | [optional] |
| **hostname** | **string**| Comma-separated hostnames to include. | [optional] |
| **ledgerId** | **string**| Restrict results to one data ledger when supported. | [optional] |
| **limit** | **int**| Maximum records returned on this page. | [optional] |
| **offset** | **int**| Zero-based number of matching records to skip. | [optional] |
| **packageId** | **string**| Restrict results to one purchased package. | [optional] |
| **protocol** | **string**| Proxy protocol: http or socks5. | [optional] |
| **region** | **string**| Normalized region targeting code. country is required. | [optional] |
| **search** | **string**| Case-insensitive partial match against the listed field: &#x60;hostname&#x60;. | [optional] |
| **start** | **\DateTime**| Inclusive start of the reporting window. Defaults to a recent window. | [optional] |
| **timezone** | **string**| IANA timezone used for bucket boundaries. Defaults to UTC. | [optional] |
| **userId** | **string**| Restrict results to the current account or an accessible sub-user. | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |

### Return type

[**\ProxyRequest\Dto\FeedResponse**](../Model/FeedResponse.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listLogs()`

```php
listLogs($city, $country, $end, $errorCode, $hostname, $ledgerId, $limit, $offset, $packageId, $protocol, $region, $start, $timezone, $userId, $acceptLanguage): \ProxyRequest\Dto\LogsResponse
```

List proxy error logs

Returns request-level proxy errors with server, client, targeting, package, and error-code context.

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


$apiInstance = new ProxyRequest\Api\AnalyticsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$city = los_angeles; // string | Normalized city targeting code. country and region are required.
$country = us; // string | Lowercase ISO 3166-1 alpha-2 country code.
$end = 2026-07-02T00:00:00Z; // \DateTime | Exclusive end of the reporting window.
$errorCode = 56; // int | Restrict results to one non-negative proxy error code.
$hostname = example.com,api.example.com; // string | Comma-separated hostnames to include.
$ledgerId = 550e8400-e29b-41d4-a716-446655440005; // string | Restrict results to one data ledger when supported.
$limit = 56; // int | Maximum records returned on this page.
$offset = 56; // int | Zero-based number of matching records to skip.
$packageId = 550e8400-e29b-41d4-a716-446655440002; // string | Restrict results to one purchased package.
$protocol = 'protocol_example'; // string | Proxy protocol: http or socks5.
$region = california; // string | Normalized region targeting code. country is required.
$start = 2026-07-01T00:00:00Z; // \DateTime | Inclusive start of the reporting window. Defaults to a recent window.
$timezone = UTC; // string | IANA timezone used for bucket boundaries. Defaults to UTC.
$userId = 550e8400-e29b-41d4-a716-446655440001; // string | Restrict results to the current account or an accessible sub-user.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English.

try {
    $result = $apiInstance->listLogs($city, $country, $end, $errorCode, $hostname, $ledgerId, $limit, $offset, $packageId, $protocol, $region, $start, $timezone, $userId, $acceptLanguage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AnalyticsResource->listLogs: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **city** | **string**| Normalized city targeting code. country and region are required. | [optional] |
| **country** | **string**| Lowercase ISO 3166-1 alpha-2 country code. | [optional] |
| **end** | **\DateTime**| Exclusive end of the reporting window. | [optional] |
| **errorCode** | **int**| Restrict results to one non-negative proxy error code. | [optional] |
| **hostname** | **string**| Comma-separated hostnames to include. | [optional] |
| **ledgerId** | **string**| Restrict results to one data ledger when supported. | [optional] |
| **limit** | **int**| Maximum records returned on this page. | [optional] |
| **offset** | **int**| Zero-based number of matching records to skip. | [optional] |
| **packageId** | **string**| Restrict results to one purchased package. | [optional] |
| **protocol** | **string**| Proxy protocol: http or socks5. | [optional] |
| **region** | **string**| Normalized region targeting code. country is required. | [optional] |
| **start** | **\DateTime**| Inclusive start of the reporting window. Defaults to a recent window. | [optional] |
| **timezone** | **string**| IANA timezone used for bucket boundaries. Defaults to UTC. | [optional] |
| **userId** | **string**| Restrict results to the current account or an accessible sub-user. | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |

### Return type

[**\ProxyRequest\Dto\LogsResponse**](../Model/LogsResponse.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
