# ProxyRequest\InvoicesResource

Create purchases and inspect invoices, payment links, and receipts.

All URIs are relative to https://api.proxyrequest.com/api/v1, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**create()**](InvoicesResource.md#create) | **POST** /invoices | Create an invoice |
| [**delete()**](InvoicesResource.md#delete) | **DELETE** /invoices/{id} | Delete an invoice |
| [**downloadPdf()**](InvoicesResource.md#downloadPdf) | **GET** /invoices/{id}/download/pdf | Download an invoice PDF |
| [**get()**](InvoicesResource.md#get) | **GET** /invoices/{id} | Get an invoice |
| [**getPaymentLink()**](InvoicesResource.md#getPaymentLink) | **GET** /invoices/{id}/pay | Get an invoice payment link |
| [**list()**](InvoicesResource.md#list) | **GET** /invoices | List invoices |


## `create()`

```php
create($invoiceCreateRequest, $acceptLanguage): \ProxyRequest\Dto\Invoice
```

Create an invoice

Calculates package pricing, creates a pending invoice, and initializes the selected payment provider when required.

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


$apiInstance = new ProxyRequest\Api\InvoicesResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$invoiceCreateRequest = {"package_id":"550e8400-e29b-41d4-a716-446655440002","data":10737418240,"gateway":"stripe"}; // \ProxyRequest\Dto\InvoiceCreateRequest
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English.

try {
    $result = $apiInstance->create($invoiceCreateRequest, $acceptLanguage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InvoicesResource->create: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **invoiceCreateRequest** | [**\ProxyRequest\Dto\InvoiceCreateRequest**](../Model/InvoiceCreateRequest.md)|  | |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |

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
delete($id, $acceptLanguage)
```

Delete an invoice

Deletes an invoice that the authenticated account is allowed to remove.

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


$apiInstance = new ProxyRequest\Api\InvoicesResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | A unique value identifying this Invoice.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English.

try {
    $apiInstance->delete($id, $acceptLanguage);
} catch (Exception $e) {
    echo 'Exception when calling InvoicesResource->delete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| A unique value identifying this Invoice. | |
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

## `downloadPdf()`

```php
downloadPdf($id, $acceptLanguage): \SplFileObject
```

Download an invoice PDF

Returns the generated invoice document as a PDF attachment. The file may be downloaded from the billing provider on first access.

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


$apiInstance = new ProxyRequest\Api\InvoicesResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | A unique value identifying this Invoice.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English.

try {
    $result = $apiInstance->downloadPdf($id, $acceptLanguage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InvoicesResource->downloadPdf: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| A unique value identifying this Invoice. | |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |

### Return type

**\SplFileObject**

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/pdf`, `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `get()`

```php
get($id, $acceptLanguage): \ProxyRequest\Dto\Invoice
```

Get an invoice

Returns billing, package, payment, and status details for one invoice visible to the authenticated account.

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


$apiInstance = new ProxyRequest\Api\InvoicesResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | A unique value identifying this Invoice.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English.

try {
    $result = $apiInstance->get($id, $acceptLanguage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InvoicesResource->get: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| A unique value identifying this Invoice. | |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |

### Return type

[**\ProxyRequest\Dto\Invoice**](../Model/Invoice.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getPaymentLink()`

```php
getPaymentLink($id, $acceptLanguage): \ProxyRequest\Dto\PaymentLinkResponse
```

Get an invoice payment link

Returns the hosted checkout URL for a pending invoice. Paid, cancelled, or expired invoices cannot produce a new payment link.

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


$apiInstance = new ProxyRequest\Api\InvoicesResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | A unique value identifying this Invoice.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English.

try {
    $result = $apiInstance->getPaymentLink($id, $acceptLanguage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InvoicesResource->getPaymentLink: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| A unique value identifying this Invoice. | |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |

### Return type

[**\ProxyRequest\Dto\PaymentLinkResponse**](../Model/PaymentLinkResponse.md)

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
list($gateway, $internalId, $limit, $offset, $ordering, $packageId, $search, $status, $type, $userEmail, $userId, $acceptLanguage): \ProxyRequest\Dto\PaginatedInvoiceList
```

List invoices

Returns invoices visible to the authenticated account. Resellers and administrators can filter by an accessible user.

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


$apiInstance = new ProxyRequest\Api\InvoicesResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$gateway = 'gateway_example'; // string | The payment gateway used for processing the payment. * `coinbase` - Coinbase * `cryptomus` - Cryptomus * `stripe` - Stripe * `coingate` - Coingate * `wallet` - Wallet * `manual` - Manual
$internalId = 'internalId_example'; // string
$limit = 56; // int | Number of results to return per page.
$offset = 56; // int | The initial index from which to return the results.
$ordering = 'ordering_example'; // string | Which field to use when ordering the results.
$packageId = 'packageId_example'; // string
$search = 'search_example'; // string | Case-insensitive partial search across Invoice fields: `id`, `internal_id`, and `user.email`. Separate multiple terms with spaces or commas; every term must match at least one listed field.
$status = 'status_example'; // string | After changing invoice status to PAID, the invoice will be processed and user package created in case none exists. If you need to cancel the invoice, make sure to subtract data from the user package after changing the invoice status. Changing the status from PAID to any other will not affect the user package's data or proxies. * `pending` - Pending * `paid` - Paid * `unpaid` - Unpaid * `error` - Error
$type = 'type_example'; // string | The type of invoice, indicating the type of proxy service. Options include: RESIDENTIAL: Residential proxies. STATIC: Static proxies. * `static` - Static * `residential` - Residential * `balance` - Balance
$userEmail = 'userEmail_example'; // string
$userId = 'userId_example'; // string
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English.

try {
    $result = $apiInstance->list($gateway, $internalId, $limit, $offset, $ordering, $packageId, $search, $status, $type, $userEmail, $userId, $acceptLanguage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InvoicesResource->list: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **gateway** | **string**| The payment gateway used for processing the payment. * &#x60;coinbase&#x60; - Coinbase * &#x60;cryptomus&#x60; - Cryptomus * &#x60;stripe&#x60; - Stripe * &#x60;coingate&#x60; - Coingate * &#x60;wallet&#x60; - Wallet * &#x60;manual&#x60; - Manual | [optional] |
| **internalId** | **string**|  | [optional] |
| **limit** | **int**| Number of results to return per page. | [optional] |
| **offset** | **int**| The initial index from which to return the results. | [optional] |
| **ordering** | **string**| Which field to use when ordering the results. | [optional] |
| **packageId** | **string**|  | [optional] |
| **search** | **string**| Case-insensitive partial search across Invoice fields: &#x60;id&#x60;, &#x60;internal_id&#x60;, and &#x60;user.email&#x60;. Separate multiple terms with spaces or commas; every term must match at least one listed field. | [optional] |
| **status** | **string**| After changing invoice status to PAID, the invoice will be processed and user package created in case none exists. If you need to cancel the invoice, make sure to subtract data from the user package after changing the invoice status. Changing the status from PAID to any other will not affect the user package&#39;s data or proxies. * &#x60;pending&#x60; - Pending * &#x60;paid&#x60; - Paid * &#x60;unpaid&#x60; - Unpaid * &#x60;error&#x60; - Error | [optional] |
| **type** | **string**| The type of invoice, indicating the type of proxy service. Options include: RESIDENTIAL: Residential proxies. STATIC: Static proxies. * &#x60;static&#x60; - Static * &#x60;residential&#x60; - Residential * &#x60;balance&#x60; - Balance | [optional] |
| **userEmail** | **string**|  | [optional] |
| **userId** | **string**|  | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |

### Return type

[**\ProxyRequest\Dto\PaginatedInvoiceList**](../Model/PaginatedInvoiceList.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
