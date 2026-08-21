# ProxyRequest\LocationsResource

Browse locations, networks, and providers available for proxy targeting.

All URIs are relative to https://api.proxyrequest.com/api/v1, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getCity()**](LocationsResource.md#getCity) | **GET** /locations/cities/{id} | Get a city |
| [**getContinent()**](LocationsResource.md#getContinent) | **GET** /locations/continents/{id} | Get a continent |
| [**getCountry()**](LocationsResource.md#getCountry) | **GET** /locations/countries/{id} | Get a country |
| [**getRegion()**](LocationsResource.md#getRegion) | **GET** /locations/regions/{id} | Get a region |
| [**listAsns()**](LocationsResource.md#listAsns) | **GET** /locations/asn | List available autonomous systems |
| [**listCities()**](LocationsResource.md#listCities) | **GET** /locations/cities | List available cities |
| [**listContinents()**](LocationsResource.md#listContinents) | **GET** /locations/continents | List available continents |
| [**listCountries()**](LocationsResource.md#listCountries) | **GET** /locations/countries | List available countries |
| [**listIsps()**](LocationsResource.md#listIsps) | **GET** /locations/isps | List available internet service providers |
| [**listRegions()**](LocationsResource.md#listRegions) | **GET** /locations/regions | List available regions |


## `getCity()`

```php
getCity($id, $acceptLanguage): \ProxyRequest\Dto\City
```

Get a city

Returns one city and its available network targeting options.

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


$apiInstance = new ProxyRequest\Api\LocationsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English.

try {
    $result = $apiInstance->getCity($id, $acceptLanguage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LocationsResource->getCity: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**|  | |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |

### Return type

[**\ProxyRequest\Dto\City**](../Model/City.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getContinent()`

```php
getContinent($id, $acceptLanguage): \ProxyRequest\Dto\Continent
```

Get a continent

Returns one continent from the proxy targeting dictionary.

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


$apiInstance = new ProxyRequest\Api\LocationsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English.

try {
    $result = $apiInstance->getContinent($id, $acceptLanguage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LocationsResource->getContinent: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**|  | |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |

### Return type

[**\ProxyRequest\Dto\Continent**](../Model/Continent.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getCountry()`

```php
getCountry($id, $acceptLanguage): \ProxyRequest\Dto\Country
```

Get a country

Returns one country and its available network targeting options.

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


$apiInstance = new ProxyRequest\Api\LocationsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English.

try {
    $result = $apiInstance->getCountry($id, $acceptLanguage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LocationsResource->getCountry: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**|  | |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |

### Return type

[**\ProxyRequest\Dto\Country**](../Model/Country.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getRegion()`

```php
getRegion($id, $acceptLanguage): \ProxyRequest\Dto\Region
```

Get a region

Returns one region and its available network targeting options.

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


$apiInstance = new ProxyRequest\Api\LocationsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English.

try {
    $result = $apiInstance->getRegion($id, $acceptLanguage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LocationsResource->getRegion: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**|  | |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |

### Return type

[**\ProxyRequest\Dto\Region**](../Model/Region.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listAsns()`

```php
listAsns($code, $countryCode, $global, $limit, $name, $offset, $ordering, $packageId, $search, $acceptLanguage): \ProxyRequest\Dto\PaginatedLocationASNRecordList
```

List available autonomous systems

Returns targetable ASNs for the selected package. Geo-scoped records include the country, region, or city where the ASN can be selected.

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


$apiInstance = new ProxyRequest\Api\LocationsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$code = 'code_example'; // string
$countryCode = 'countryCode_example'; // string
$global = True; // bool | Set to true to return only globally targetable ASNs.
$limit = 56; // int | Number of results to return per page.
$name = 'name_example'; // string
$offset = 56; // int | The initial index from which to return the results.
$ordering = 'ordering_example'; // string | Which field to use when ordering the results.
$packageId = 550e8400-e29b-41d4-a716-446655440002; // string | Package whose targeting availability should be returned. Required when package-based authentication is enabled.
$search = 'search_example'; // string | Case-insensitive partial search across ASN fields: `code` and `name`. Separate multiple terms with spaces or commas; every term must match at least one listed field.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English.

try {
    $result = $apiInstance->listAsns($code, $countryCode, $global, $limit, $name, $offset, $ordering, $packageId, $search, $acceptLanguage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LocationsResource->listAsns: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **code** | **string**|  | [optional] |
| **countryCode** | **string**|  | [optional] |
| **global** | **bool**| Set to true to return only globally targetable ASNs. | [optional] |
| **limit** | **int**| Number of results to return per page. | [optional] |
| **name** | **string**|  | [optional] |
| **offset** | **int**| The initial index from which to return the results. | [optional] |
| **ordering** | **string**| Which field to use when ordering the results. | [optional] |
| **packageId** | **string**| Package whose targeting availability should be returned. Required when package-based authentication is enabled. | [optional] |
| **search** | **string**| Case-insensitive partial search across ASN fields: &#x60;code&#x60; and &#x60;name&#x60;. Separate multiple terms with spaces or commas; every term must match at least one listed field. | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |

### Return type

[**\ProxyRequest\Dto\PaginatedLocationASNRecordList**](../Model/PaginatedLocationASNRecordList.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listCities()`

```php
listCities($code, $countryCode, $limit, $name, $offset, $ordering, $packageId, $regionCode, $search, $acceptLanguage): \ProxyRequest\Dto\PaginatedCityList
```

List available cities

Returns cities supported by the selected package, country, and region, including targetable ISPs and autonomous system numbers.

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


$apiInstance = new ProxyRequest\Api\LocationsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$code = 'code_example'; // string
$countryCode = 'countryCode_example'; // string
$limit = 56; // int | Number of results to return per page.
$name = 'name_example'; // string
$offset = 56; // int | The initial index from which to return the results.
$ordering = 'ordering_example'; // string | Which field to use when ordering the results.
$packageId = 550e8400-e29b-41d4-a716-446655440002; // string | Package whose targeting availability should be returned. Required when package-based authentication is enabled.
$regionCode = 'regionCode_example'; // string
$search = 'search_example'; // string | Case-insensitive partial search across City fields: `code` and `name`. Separate multiple terms with spaces or commas; every term must match at least one listed field.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English.

try {
    $result = $apiInstance->listCities($code, $countryCode, $limit, $name, $offset, $ordering, $packageId, $regionCode, $search, $acceptLanguage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LocationsResource->listCities: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **code** | **string**|  | [optional] |
| **countryCode** | **string**|  | [optional] |
| **limit** | **int**| Number of results to return per page. | [optional] |
| **name** | **string**|  | [optional] |
| **offset** | **int**| The initial index from which to return the results. | [optional] |
| **ordering** | **string**| Which field to use when ordering the results. | [optional] |
| **packageId** | **string**| Package whose targeting availability should be returned. Required when package-based authentication is enabled. | [optional] |
| **regionCode** | **string**|  | [optional] |
| **search** | **string**| Case-insensitive partial search across City fields: &#x60;code&#x60; and &#x60;name&#x60;. Separate multiple terms with spaces or commas; every term must match at least one listed field. | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |

### Return type

[**\ProxyRequest\Dto\PaginatedCityList**](../Model/PaginatedCityList.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listContinents()`

```php
listContinents($code, $limit, $name, $offset, $ordering, $packageId, $search, $acceptLanguage): \ProxyRequest\Dto\PaginatedContinentList
```

List available continents

Returns continents containing at least one country supported by the selected package's active proxy providers.

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


$apiInstance = new ProxyRequest\Api\LocationsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$code = 'code_example'; // string
$limit = 56; // int | Number of results to return per page.
$name = 'name_example'; // string
$offset = 56; // int | The initial index from which to return the results.
$ordering = 'ordering_example'; // string | Which field to use when ordering the results.
$packageId = 550e8400-e29b-41d4-a716-446655440002; // string | Package whose targeting availability should be returned. Required when package-based authentication is enabled.
$search = 'search_example'; // string | Case-insensitive partial search across Continent fields: `code` and `name`. Separate multiple terms with spaces or commas; every term must match at least one listed field.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English.

try {
    $result = $apiInstance->listContinents($code, $limit, $name, $offset, $ordering, $packageId, $search, $acceptLanguage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LocationsResource->listContinents: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **code** | **string**|  | [optional] |
| **limit** | **int**| Number of results to return per page. | [optional] |
| **name** | **string**|  | [optional] |
| **offset** | **int**| The initial index from which to return the results. | [optional] |
| **ordering** | **string**| Which field to use when ordering the results. | [optional] |
| **packageId** | **string**| Package whose targeting availability should be returned. Required when package-based authentication is enabled. | [optional] |
| **search** | **string**| Case-insensitive partial search across Continent fields: &#x60;code&#x60; and &#x60;name&#x60;. Separate multiple terms with spaces or commas; every term must match at least one listed field. | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |

### Return type

[**\ProxyRequest\Dto\PaginatedContinentList**](../Model/PaginatedContinentList.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listCountries()`

```php
listCountries($code, $limit, $name, $offset, $ordering, $packageId, $search, $acceptLanguage): \ProxyRequest\Dto\PaginatedCountryList
```

List available countries

Returns countries supported by the selected package, including targetable ISPs and autonomous system numbers when available.

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


$apiInstance = new ProxyRequest\Api\LocationsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$code = 'code_example'; // string
$limit = 56; // int | Number of results to return per page.
$name = 'name_example'; // string
$offset = 56; // int | The initial index from which to return the results.
$ordering = 'ordering_example'; // string | Which field to use when ordering the results.
$packageId = 550e8400-e29b-41d4-a716-446655440002; // string | Package whose targeting availability should be returned. Required when package-based authentication is enabled.
$search = 'search_example'; // string | Case-insensitive partial search across Country fields: `code` and `name`. Separate multiple terms with spaces or commas; every term must match at least one listed field.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English.

try {
    $result = $apiInstance->listCountries($code, $limit, $name, $offset, $ordering, $packageId, $search, $acceptLanguage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LocationsResource->listCountries: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **code** | **string**|  | [optional] |
| **limit** | **int**| Number of results to return per page. | [optional] |
| **name** | **string**|  | [optional] |
| **offset** | **int**| The initial index from which to return the results. | [optional] |
| **ordering** | **string**| Which field to use when ordering the results. | [optional] |
| **packageId** | **string**| Package whose targeting availability should be returned. Required when package-based authentication is enabled. | [optional] |
| **search** | **string**| Case-insensitive partial search across Country fields: &#x60;code&#x60; and &#x60;name&#x60;. Separate multiple terms with spaces or commas; every term must match at least one listed field. | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |

### Return type

[**\ProxyRequest\Dto\PaginatedCountryList**](../Model/PaginatedCountryList.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listIsps()`

```php
listIsps($code, $countryCode, $limit, $name, $offset, $ordering, $packageId, $search, $acceptLanguage): \ProxyRequest\Dto\PaginatedISPList
```

List available internet service providers

Returns ISPs that can be targeted by the selected package and location scope. Use country filters to narrow the result.

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


$apiInstance = new ProxyRequest\Api\LocationsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$code = 'code_example'; // string
$countryCode = 'countryCode_example'; // string
$limit = 56; // int | Number of results to return per page.
$name = 'name_example'; // string
$offset = 56; // int | The initial index from which to return the results.
$ordering = 'ordering_example'; // string | Which field to use when ordering the results.
$packageId = 550e8400-e29b-41d4-a716-446655440002; // string | Package whose targeting availability should be returned. Required when package-based authentication is enabled.
$search = 'search_example'; // string | Case-insensitive partial search across ISP fields: `code` and `name`. Separate multiple terms with spaces or commas; every term must match at least one listed field.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English.

try {
    $result = $apiInstance->listIsps($code, $countryCode, $limit, $name, $offset, $ordering, $packageId, $search, $acceptLanguage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LocationsResource->listIsps: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **code** | **string**|  | [optional] |
| **countryCode** | **string**|  | [optional] |
| **limit** | **int**| Number of results to return per page. | [optional] |
| **name** | **string**|  | [optional] |
| **offset** | **int**| The initial index from which to return the results. | [optional] |
| **ordering** | **string**| Which field to use when ordering the results. | [optional] |
| **packageId** | **string**| Package whose targeting availability should be returned. Required when package-based authentication is enabled. | [optional] |
| **search** | **string**| Case-insensitive partial search across ISP fields: &#x60;code&#x60; and &#x60;name&#x60;. Separate multiple terms with spaces or commas; every term must match at least one listed field. | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |

### Return type

[**\ProxyRequest\Dto\PaginatedISPList**](../Model/PaginatedISPList.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listRegions()`

```php
listRegions($code, $countryCode, $limit, $name, $offset, $ordering, $packageId, $search, $acceptLanguage): \ProxyRequest\Dto\PaginatedRegionList
```

List available regions

Returns regions supported by the selected package and country, including targetable ISPs and autonomous system numbers.

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


$apiInstance = new ProxyRequest\Api\LocationsResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$code = 'code_example'; // string
$countryCode = 'countryCode_example'; // string
$limit = 56; // int | Number of results to return per page.
$name = 'name_example'; // string
$offset = 56; // int | The initial index from which to return the results.
$ordering = 'ordering_example'; // string | Which field to use when ordering the results.
$packageId = 550e8400-e29b-41d4-a716-446655440002; // string | Package whose targeting availability should be returned. Required when package-based authentication is enabled.
$search = 'search_example'; // string | Case-insensitive partial search across Region fields: `code` and `name`. Separate multiple terms with spaces or commas; every term must match at least one listed field.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English.

try {
    $result = $apiInstance->listRegions($code, $countryCode, $limit, $name, $offset, $ordering, $packageId, $search, $acceptLanguage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LocationsResource->listRegions: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **code** | **string**|  | [optional] |
| **countryCode** | **string**|  | [optional] |
| **limit** | **int**| Number of results to return per page. | [optional] |
| **name** | **string**|  | [optional] |
| **offset** | **int**| The initial index from which to return the results. | [optional] |
| **ordering** | **string**| Which field to use when ordering the results. | [optional] |
| **packageId** | **string**| Package whose targeting availability should be returned. Required when package-based authentication is enabled. | [optional] |
| **search** | **string**| Case-insensitive partial search across Region fields: &#x60;code&#x60; and &#x60;name&#x60;. Separate multiple terms with spaces or commas; every term must match at least one listed field. | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es, zh-hans, ja. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |

### Return type

[**\ProxyRequest\Dto\PaginatedRegionList**](../Model/PaginatedRegionList.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
