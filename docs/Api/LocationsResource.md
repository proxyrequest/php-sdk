# ProxyRequest\LocationsResource

Browse locations, networks, and providers available for proxy targeting.

All URIs are relative to https://api.proxyrequest.com/api/v1, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getCity()**](LocationsResource.md#getCity) | **GET** /locations/cities/{id} | Get a city |
| [**getContinent()**](LocationsResource.md#getContinent) | **GET** /locations/continents/{id} | Get a continent |
| [**getCountry()**](LocationsResource.md#getCountry) | **GET** /locations/countries/{id} | Get a country |
| [**getRegion()**](LocationsResource.md#getRegion) | **GET** /locations/regions/{id} | Get a region |
| [**getZipcode()**](LocationsResource.md#getZipcode) | **GET** /locations/zipcodes/{id} | Get an available ZIP code |
| [**listAsns()**](LocationsResource.md#listAsns) | **GET** /locations/asn | List available autonomous systems |
| [**listCities()**](LocationsResource.md#listCities) | **GET** /locations/cities | List available cities |
| [**listContinents()**](LocationsResource.md#listContinents) | **GET** /locations/continents | List available continents |
| [**listCountries()**](LocationsResource.md#listCountries) | **GET** /locations/countries | List available countries |
| [**listIsps()**](LocationsResource.md#listIsps) | **GET** /locations/isps | List available internet service providers |
| [**listRegions()**](LocationsResource.md#listRegions) | **GET** /locations/regions | List available regions |
| [**listZipcodes()**](LocationsResource.md#listZipcodes) | **GET** /locations/zipcodes | List available ZIP codes |


## `getCity()`

```php
getCity($id, $packageId, $acceptLanguage, $xImpersonateUser, includeAsns: $includeAsns, maxCount: $maxCount, minCount: $minCount): \ProxyRequest\Dto\City
```

Get a city

Returns one city and its available network targeting options. The asns field is always present and defaults to an empty array. Pass include_asns=true to include available autonomous system numbers. This option does not affect the standalone /locations/asn endpoint or the compact proxy-node response format.

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
$packageId = 550e8400-e29b-41d4-a716-446655440002; // string | Package whose targeting availability should be returned.
$includeAsns = true; // bool | The asns field is always present and defaults to an empty array. Pass include_asns=true to include available autonomous system numbers. This option does not affect the standalone /locations/asn endpoint or the compact proxy-node response format.
$maxCount = 56; // int | Inclusive maximum node count in the published location dictionary. Either bound may be omitted. Decimal digits only, with surrounding whitespace ignored; empty values, signs, fractions, overflow and min_count > max_count return 400. Unknown counts are zero. Filters primary records before ordering/pagination; nested networks, parents and ASN geo are unchanged. A detail outside the range returns 404. Counts describe dictionary membership, not live node health.
$minCount = 56; // int | Inclusive minimum node count in the published location dictionary. Either bound may be omitted. Decimal digits only, with surrounding whitespace ignored; empty values, signs, fractions, overflow and min_count > max_count return 400. Unknown counts are zero. Filters primary records before ordering/pagination; nested networks, parents and ASN geo are unchanged. A detail outside the range returns 404. Counts describe dictionary membership, not live node health.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->getCity($id, $packageId, $acceptLanguage, $xImpersonateUser, includeAsns: $includeAsns, maxCount: $maxCount, minCount: $minCount);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LocationsResource->getCity: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**|  | |
| **packageId** | **string**| Package whose targeting availability should be returned. | |
| **includeAsns** | **bool**| The asns field is always present and defaults to an empty array. Pass include_asns&#x3D;true to include available autonomous system numbers. This option does not affect the standalone /locations/asn endpoint or the compact proxy-node response format. | [optional] [default to false] |
| **maxCount** | **int**| Inclusive maximum node count in the published location dictionary. Either bound may be omitted. Decimal digits only, with surrounding whitespace ignored; empty values, signs, fractions, overflow and min_count &gt; max_count return 400. Unknown counts are zero. Filters primary records before ordering/pagination; nested networks, parents and ASN geo are unchanged. A detail outside the range returns 404. Counts describe dictionary membership, not live node health. | [optional] |
| **minCount** | **int**| Inclusive minimum node count in the published location dictionary. Either bound may be omitted. Decimal digits only, with surrounding whitespace ignored; empty values, signs, fractions, overflow and min_count &gt; max_count return 400. Unknown counts are zero. Filters primary records before ordering/pagination; nested networks, parents and ASN geo are unchanged. A detail outside the range returns 404. Counts describe dictionary membership, not live node health. | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

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
getContinent($id, $packageId, $acceptLanguage, $xImpersonateUser): \ProxyRequest\Dto\Continent
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
$packageId = 550e8400-e29b-41d4-a716-446655440002; // string | Package whose targeting availability should be returned.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->getContinent($id, $packageId, $acceptLanguage, $xImpersonateUser);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LocationsResource->getContinent: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**|  | |
| **packageId** | **string**| Package whose targeting availability should be returned. | |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

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
getCountry($id, $packageId, $acceptLanguage, $xImpersonateUser, includeAsns: $includeAsns, maxCount: $maxCount, minCount: $minCount): \ProxyRequest\Dto\Country
```

Get a country

Returns one country and its available network targeting options. The asns field is always present and defaults to an empty array. Pass include_asns=true to include available autonomous system numbers. This option does not affect the standalone /locations/asn endpoint or the compact proxy-node response format.

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
$packageId = 550e8400-e29b-41d4-a716-446655440002; // string | Package whose targeting availability should be returned.
$includeAsns = true; // bool | The asns field is always present and defaults to an empty array. Pass include_asns=true to include available autonomous system numbers. This option does not affect the standalone /locations/asn endpoint or the compact proxy-node response format.
$maxCount = 56; // int | Inclusive maximum node count in the published location dictionary. Either bound may be omitted. Decimal digits only, with surrounding whitespace ignored; empty values, signs, fractions, overflow and min_count > max_count return 400. Unknown counts are zero. Filters primary records before ordering/pagination; nested networks, parents and ASN geo are unchanged. A detail outside the range returns 404. Counts describe dictionary membership, not live node health.
$minCount = 56; // int | Inclusive minimum node count in the published location dictionary. Either bound may be omitted. Decimal digits only, with surrounding whitespace ignored; empty values, signs, fractions, overflow and min_count > max_count return 400. Unknown counts are zero. Filters primary records before ordering/pagination; nested networks, parents and ASN geo are unchanged. A detail outside the range returns 404. Counts describe dictionary membership, not live node health.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->getCountry($id, $packageId, $acceptLanguage, $xImpersonateUser, includeAsns: $includeAsns, maxCount: $maxCount, minCount: $minCount);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LocationsResource->getCountry: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**|  | |
| **packageId** | **string**| Package whose targeting availability should be returned. | |
| **includeAsns** | **bool**| The asns field is always present and defaults to an empty array. Pass include_asns&#x3D;true to include available autonomous system numbers. This option does not affect the standalone /locations/asn endpoint or the compact proxy-node response format. | [optional] [default to false] |
| **maxCount** | **int**| Inclusive maximum node count in the published location dictionary. Either bound may be omitted. Decimal digits only, with surrounding whitespace ignored; empty values, signs, fractions, overflow and min_count &gt; max_count return 400. Unknown counts are zero. Filters primary records before ordering/pagination; nested networks, parents and ASN geo are unchanged. A detail outside the range returns 404. Counts describe dictionary membership, not live node health. | [optional] |
| **minCount** | **int**| Inclusive minimum node count in the published location dictionary. Either bound may be omitted. Decimal digits only, with surrounding whitespace ignored; empty values, signs, fractions, overflow and min_count &gt; max_count return 400. Unknown counts are zero. Filters primary records before ordering/pagination; nested networks, parents and ASN geo are unchanged. A detail outside the range returns 404. Counts describe dictionary membership, not live node health. | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

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
getRegion($id, $packageId, $acceptLanguage, $xImpersonateUser, includeAsns: $includeAsns, maxCount: $maxCount, minCount: $minCount): \ProxyRequest\Dto\Region
```

Get a region

Returns one region and its available network targeting options. The asns field is always present and defaults to an empty array. Pass include_asns=true to include available autonomous system numbers. This option does not affect the standalone /locations/asn endpoint or the compact proxy-node response format.

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
$packageId = 550e8400-e29b-41d4-a716-446655440002; // string | Package whose targeting availability should be returned.
$includeAsns = true; // bool | The asns field is always present and defaults to an empty array. Pass include_asns=true to include available autonomous system numbers. This option does not affect the standalone /locations/asn endpoint or the compact proxy-node response format.
$maxCount = 56; // int | Inclusive maximum node count in the published location dictionary. Either bound may be omitted. Decimal digits only, with surrounding whitespace ignored; empty values, signs, fractions, overflow and min_count > max_count return 400. Unknown counts are zero. Filters primary records before ordering/pagination; nested networks, parents and ASN geo are unchanged. A detail outside the range returns 404. Counts describe dictionary membership, not live node health.
$minCount = 56; // int | Inclusive minimum node count in the published location dictionary. Either bound may be omitted. Decimal digits only, with surrounding whitespace ignored; empty values, signs, fractions, overflow and min_count > max_count return 400. Unknown counts are zero. Filters primary records before ordering/pagination; nested networks, parents and ASN geo are unchanged. A detail outside the range returns 404. Counts describe dictionary membership, not live node health.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->getRegion($id, $packageId, $acceptLanguage, $xImpersonateUser, includeAsns: $includeAsns, maxCount: $maxCount, minCount: $minCount);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LocationsResource->getRegion: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**|  | |
| **packageId** | **string**| Package whose targeting availability should be returned. | |
| **includeAsns** | **bool**| The asns field is always present and defaults to an empty array. Pass include_asns&#x3D;true to include available autonomous system numbers. This option does not affect the standalone /locations/asn endpoint or the compact proxy-node response format. | [optional] [default to false] |
| **maxCount** | **int**| Inclusive maximum node count in the published location dictionary. Either bound may be omitted. Decimal digits only, with surrounding whitespace ignored; empty values, signs, fractions, overflow and min_count &gt; max_count return 400. Unknown counts are zero. Filters primary records before ordering/pagination; nested networks, parents and ASN geo are unchanged. A detail outside the range returns 404. Counts describe dictionary membership, not live node health. | [optional] |
| **minCount** | **int**| Inclusive minimum node count in the published location dictionary. Either bound may be omitted. Decimal digits only, with surrounding whitespace ignored; empty values, signs, fractions, overflow and min_count &gt; max_count return 400. Unknown counts are zero. Filters primary records before ordering/pagination; nested networks, parents and ASN geo are unchanged. A detail outside the range returns 404. Counts describe dictionary membership, not live node health. | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

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

## `getZipcode()`

```php
getZipcode($id, $packageId, $asnCode, $cityCode, $code, $countryCode, $ispCode, maxCount: $maxCount, minCount: $minCount, $regionCode, $acceptLanguage, $xImpersonateUser): \ProxyRequest\Dto\Postal
```

Get an available ZIP code

Returns a ZIP code from the selected package coverage. Unavailable or excluded ZIP codes return 404.

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
$packageId = 550e8400-e29b-41d4-a716-446655440002; // string | Package whose targeting availability should be returned.
$asnCode = 'asnCode_example'; // string | ASN in the same observed combination.
$cityCode = 'cityCode_example'; // string | City code in the same observed combination.
$code = 'code_example'; // string | Postal identifier; case, spaces and hyphens are normalized. Leading zeros are preserved.
$countryCode = 'countryCode_example'; // string | Country code of an observed provider ZIP combination.
$ispCode = 'ispCode_example'; // string | ISP in the same observed combination.
$maxCount = 56; // int | Inclusive maximum node count in the published location dictionary. Either bound may be omitted. Decimal digits only, with surrounding whitespace ignored; empty values, signs, fractions, overflow and min_count > max_count return 400. Unknown counts are zero. Filters primary records before ordering/pagination; nested networks, parents and ASN geo are unchanged. A detail outside the range returns 404. Counts describe dictionary membership, not live node health.
$minCount = 56; // int | Inclusive minimum node count in the published location dictionary. Either bound may be omitted. Decimal digits only, with surrounding whitespace ignored; empty values, signs, fractions, overflow and min_count > max_count return 400. Unknown counts are zero. Filters primary records before ordering/pagination; nested networks, parents and ASN geo are unchanged. A detail outside the range returns 404. Counts describe dictionary membership, not live node health.
$regionCode = 'regionCode_example'; // string | Region code in the same observed combination.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->getZipcode($id, $packageId, $asnCode, $cityCode, $code, $countryCode, $ispCode, maxCount: $maxCount, minCount: $minCount, $regionCode, $acceptLanguage, $xImpersonateUser);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LocationsResource->getZipcode: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**|  | |
| **packageId** | **string**| Package whose targeting availability should be returned. | |
| **asnCode** | **string**| ASN in the same observed combination. | [optional] |
| **cityCode** | **string**| City code in the same observed combination. | [optional] |
| **code** | **string**| Postal identifier; case, spaces and hyphens are normalized. Leading zeros are preserved. | [optional] |
| **countryCode** | **string**| Country code of an observed provider ZIP combination. | [optional] |
| **ispCode** | **string**| ISP in the same observed combination. | [optional] |
| **maxCount** | **int**| Inclusive maximum node count in the published location dictionary. Either bound may be omitted. Decimal digits only, with surrounding whitespace ignored; empty values, signs, fractions, overflow and min_count &gt; max_count return 400. Unknown counts are zero. Filters primary records before ordering/pagination; nested networks, parents and ASN geo are unchanged. A detail outside the range returns 404. Counts describe dictionary membership, not live node health. | [optional] |
| **minCount** | **int**| Inclusive minimum node count in the published location dictionary. Either bound may be omitted. Decimal digits only, with surrounding whitespace ignored; empty values, signs, fractions, overflow and min_count &gt; max_count return 400. Unknown counts are zero. Filters primary records before ordering/pagination; nested networks, parents and ASN geo are unchanged. A detail outside the range returns 404. Counts describe dictionary membership, not live node health. | [optional] |
| **regionCode** | **string**| Region code in the same observed combination. | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

### Return type

[**\ProxyRequest\Dto\Postal**](../Model/Postal.md)

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
listAsns($packageId, $code, $countryCode, $global, $limit, $name, $offset, $ordering, $search, $acceptLanguage, $xImpersonateUser, includeGeo: $includeGeo, maxCount: $maxCount, minCount: $minCount): \ProxyRequest\Dto\PaginatedLocationASNRecordList
```

List available autonomous systems

Returns targetable ASNs for the selected package. The geo field is empty unless include_geo=true; then it contains targetable geographic scopes.

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
$packageId = 550e8400-e29b-41d4-a716-446655440002; // string | Package whose targeting availability should be returned.
$code = 'code_example'; // string
$countryCode = 'countryCode_example'; // string
$global = True; // bool | Set to true to return only globally targetable ASNs when country__code is absent. A country filter takes precedence.
$includeGeo = true; // bool | Include geographic scopes for each ASN. By default geo is an empty list.
$limit = 56; // int | Number of results to return per page.
$maxCount = 56; // int | Inclusive maximum node count in the published location dictionary. Either bound may be omitted. Decimal digits only, with surrounding whitespace ignored; empty values, signs, fractions, overflow and min_count > max_count return 400. Unknown counts are zero. Filters primary records before ordering/pagination; nested networks, parents and ASN geo are unchanged. A detail outside the range returns 404. Counts describe dictionary membership, not live node health.
$minCount = 56; // int | Inclusive minimum node count in the published location dictionary. Either bound may be omitted. Decimal digits only, with surrounding whitespace ignored; empty values, signs, fractions, overflow and min_count > max_count return 400. Unknown counts are zero. Filters primary records before ordering/pagination; nested networks, parents and ASN geo are unchanged. A detail outside the range returns 404. Counts describe dictionary membership, not live node health.
$name = 'name_example'; // string
$offset = 56; // int | The initial index from which to return the results.
$ordering = 'ordering_example'; // string | Comma-separated fields: code, name. Prefix a field with - for descending order. Unsupported fields are ignored. Name ordering follows the catalog collation.
$search = 'search_example'; // string | Case-insensitive partial search across ASN fields: `code` and `name`. Separate multiple terms with spaces or commas; every term must match at least one listed field.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->listAsns($packageId, $code, $countryCode, $global, $limit, $name, $offset, $ordering, $search, $acceptLanguage, $xImpersonateUser, includeGeo: $includeGeo, maxCount: $maxCount, minCount: $minCount);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LocationsResource->listAsns: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **packageId** | **string**| Package whose targeting availability should be returned. | |
| **code** | **string**|  | [optional] |
| **countryCode** | **string**|  | [optional] |
| **global** | **bool**| Set to true to return only globally targetable ASNs when country__code is absent. A country filter takes precedence. | [optional] |
| **includeGeo** | **bool**| Include geographic scopes for each ASN. By default geo is an empty list. | [optional] [default to false] |
| **limit** | **int**| Number of results to return per page. | [optional] |
| **maxCount** | **int**| Inclusive maximum node count in the published location dictionary. Either bound may be omitted. Decimal digits only, with surrounding whitespace ignored; empty values, signs, fractions, overflow and min_count &gt; max_count return 400. Unknown counts are zero. Filters primary records before ordering/pagination; nested networks, parents and ASN geo are unchanged. A detail outside the range returns 404. Counts describe dictionary membership, not live node health. | [optional] |
| **minCount** | **int**| Inclusive minimum node count in the published location dictionary. Either bound may be omitted. Decimal digits only, with surrounding whitespace ignored; empty values, signs, fractions, overflow and min_count &gt; max_count return 400. Unknown counts are zero. Filters primary records before ordering/pagination; nested networks, parents and ASN geo are unchanged. A detail outside the range returns 404. Counts describe dictionary membership, not live node health. | [optional] |
| **name** | **string**|  | [optional] |
| **offset** | **int**| The initial index from which to return the results. | [optional] |
| **ordering** | **string**| Comma-separated fields: code, name. Prefix a field with - for descending order. Unsupported fields are ignored. Name ordering follows the catalog collation. | [optional] |
| **search** | **string**| Case-insensitive partial search across ASN fields: &#x60;code&#x60; and &#x60;name&#x60;. Separate multiple terms with spaces or commas; every term must match at least one listed field. | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

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
listCities($packageId, $code, $countryCode, $limit, $name, $offset, $ordering, $regionCode, $search, $acceptLanguage, $xImpersonateUser, includeAsns: $includeAsns, maxCount: $maxCount, minCount: $minCount): \ProxyRequest\Dto\PaginatedCityList
```

List available cities

Returns cities supported by the selected package, country, and region, including targetable ISPs. The asns field is always present and defaults to an empty array. Pass include_asns=true to include available autonomous system numbers. This option does not affect the standalone /locations/asn endpoint or the compact proxy-node response format.

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
$packageId = 550e8400-e29b-41d4-a716-446655440002; // string | Package whose targeting availability should be returned.
$code = 'code_example'; // string
$countryCode = 'countryCode_example'; // string
$includeAsns = true; // bool | The asns field is always present and defaults to an empty array. Pass include_asns=true to include available autonomous system numbers. This option does not affect the standalone /locations/asn endpoint or the compact proxy-node response format.
$limit = 56; // int | Number of results to return per page.
$maxCount = 56; // int | Inclusive maximum node count in the published location dictionary. Either bound may be omitted. Decimal digits only, with surrounding whitespace ignored; empty values, signs, fractions, overflow and min_count > max_count return 400. Unknown counts are zero. Filters primary records before ordering/pagination; nested networks, parents and ASN geo are unchanged. A detail outside the range returns 404. Counts describe dictionary membership, not live node health.
$minCount = 56; // int | Inclusive minimum node count in the published location dictionary. Either bound may be omitted. Decimal digits only, with surrounding whitespace ignored; empty values, signs, fractions, overflow and min_count > max_count return 400. Unknown counts are zero. Filters primary records before ordering/pagination; nested networks, parents and ASN geo are unchanged. A detail outside the range returns 404. Counts describe dictionary membership, not live node health.
$name = 'name_example'; // string
$offset = 56; // int | The initial index from which to return the results.
$ordering = 'ordering_example'; // string | Comma-separated fields: id, code, name. Prefix a field with - for descending order. Unsupported fields are ignored. Name ordering follows the catalog collation.
$regionCode = 'regionCode_example'; // string
$search = 'search_example'; // string | Case-insensitive partial search across City fields: `code` and `name`. Separate multiple terms with spaces or commas; every term must match at least one listed field.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->listCities($packageId, $code, $countryCode, $limit, $name, $offset, $ordering, $regionCode, $search, $acceptLanguage, $xImpersonateUser, includeAsns: $includeAsns, maxCount: $maxCount, minCount: $minCount);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LocationsResource->listCities: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **packageId** | **string**| Package whose targeting availability should be returned. | |
| **code** | **string**|  | [optional] |
| **countryCode** | **string**|  | [optional] |
| **includeAsns** | **bool**| The asns field is always present and defaults to an empty array. Pass include_asns&#x3D;true to include available autonomous system numbers. This option does not affect the standalone /locations/asn endpoint or the compact proxy-node response format. | [optional] [default to false] |
| **limit** | **int**| Number of results to return per page. | [optional] |
| **maxCount** | **int**| Inclusive maximum node count in the published location dictionary. Either bound may be omitted. Decimal digits only, with surrounding whitespace ignored; empty values, signs, fractions, overflow and min_count &gt; max_count return 400. Unknown counts are zero. Filters primary records before ordering/pagination; nested networks, parents and ASN geo are unchanged. A detail outside the range returns 404. Counts describe dictionary membership, not live node health. | [optional] |
| **minCount** | **int**| Inclusive minimum node count in the published location dictionary. Either bound may be omitted. Decimal digits only, with surrounding whitespace ignored; empty values, signs, fractions, overflow and min_count &gt; max_count return 400. Unknown counts are zero. Filters primary records before ordering/pagination; nested networks, parents and ASN geo are unchanged. A detail outside the range returns 404. Counts describe dictionary membership, not live node health. | [optional] |
| **name** | **string**|  | [optional] |
| **offset** | **int**| The initial index from which to return the results. | [optional] |
| **ordering** | **string**| Comma-separated fields: id, code, name. Prefix a field with - for descending order. Unsupported fields are ignored. Name ordering follows the catalog collation. | [optional] |
| **regionCode** | **string**|  | [optional] |
| **search** | **string**| Case-insensitive partial search across City fields: &#x60;code&#x60; and &#x60;name&#x60;. Separate multiple terms with spaces or commas; every term must match at least one listed field. | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

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
listContinents($packageId, $code, $limit, $name, $offset, $ordering, $search, $acceptLanguage, $xImpersonateUser): \ProxyRequest\Dto\PaginatedContinentList
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
$packageId = 550e8400-e29b-41d4-a716-446655440002; // string | Package whose targeting availability should be returned.
$code = 'code_example'; // string
$limit = 56; // int | Number of results to return per page.
$name = 'name_example'; // string
$offset = 56; // int | The initial index from which to return the results.
$ordering = 'ordering_example'; // string | Comma-separated fields: id, code, name. Prefix a field with - for descending order. Unsupported fields are ignored. Name ordering follows the catalog collation.
$search = 'search_example'; // string | Case-insensitive partial search across Continent fields: `code` and `name`. Separate multiple terms with spaces or commas; every term must match at least one listed field.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->listContinents($packageId, $code, $limit, $name, $offset, $ordering, $search, $acceptLanguage, $xImpersonateUser);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LocationsResource->listContinents: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **packageId** | **string**| Package whose targeting availability should be returned. | |
| **code** | **string**|  | [optional] |
| **limit** | **int**| Number of results to return per page. | [optional] |
| **name** | **string**|  | [optional] |
| **offset** | **int**| The initial index from which to return the results. | [optional] |
| **ordering** | **string**| Comma-separated fields: id, code, name. Prefix a field with - for descending order. Unsupported fields are ignored. Name ordering follows the catalog collation. | [optional] |
| **search** | **string**| Case-insensitive partial search across Continent fields: &#x60;code&#x60; and &#x60;name&#x60;. Separate multiple terms with spaces or commas; every term must match at least one listed field. | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

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
listCountries($packageId, $code, $limit, $name, $offset, $ordering, $search, $acceptLanguage, $xImpersonateUser, includeAsns: $includeAsns, maxCount: $maxCount, minCount: $minCount): \ProxyRequest\Dto\PaginatedCountryList
```

List available countries

Returns countries supported by the selected package, including targetable ISPs. The asns field is always present and defaults to an empty array. Pass include_asns=true to include available autonomous system numbers. This option does not affect the standalone /locations/asn endpoint or the compact proxy-node response format.

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
$packageId = 550e8400-e29b-41d4-a716-446655440002; // string | Package whose targeting availability should be returned.
$code = 'code_example'; // string
$includeAsns = true; // bool | The asns field is always present and defaults to an empty array. Pass include_asns=true to include available autonomous system numbers. This option does not affect the standalone /locations/asn endpoint or the compact proxy-node response format.
$limit = 56; // int | Number of results to return per page.
$maxCount = 56; // int | Inclusive maximum node count in the published location dictionary. Either bound may be omitted. Decimal digits only, with surrounding whitespace ignored; empty values, signs, fractions, overflow and min_count > max_count return 400. Unknown counts are zero. Filters primary records before ordering/pagination; nested networks, parents and ASN geo are unchanged. A detail outside the range returns 404. Counts describe dictionary membership, not live node health.
$minCount = 56; // int | Inclusive minimum node count in the published location dictionary. Either bound may be omitted. Decimal digits only, with surrounding whitespace ignored; empty values, signs, fractions, overflow and min_count > max_count return 400. Unknown counts are zero. Filters primary records before ordering/pagination; nested networks, parents and ASN geo are unchanged. A detail outside the range returns 404. Counts describe dictionary membership, not live node health.
$name = 'name_example'; // string
$offset = 56; // int | The initial index from which to return the results.
$ordering = 'ordering_example'; // string | Comma-separated fields: id, code, name, original_name. Prefix a field with - for descending order. Unsupported fields are ignored. Name ordering follows the catalog collation.
$search = 'search_example'; // string | Case-insensitive partial search across Country fields: `code` and `name`. Separate multiple terms with spaces or commas; every term must match at least one listed field.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->listCountries($packageId, $code, $limit, $name, $offset, $ordering, $search, $acceptLanguage, $xImpersonateUser, includeAsns: $includeAsns, maxCount: $maxCount, minCount: $minCount);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LocationsResource->listCountries: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **packageId** | **string**| Package whose targeting availability should be returned. | |
| **code** | **string**|  | [optional] |
| **includeAsns** | **bool**| The asns field is always present and defaults to an empty array. Pass include_asns&#x3D;true to include available autonomous system numbers. This option does not affect the standalone /locations/asn endpoint or the compact proxy-node response format. | [optional] [default to false] |
| **limit** | **int**| Number of results to return per page. | [optional] |
| **maxCount** | **int**| Inclusive maximum node count in the published location dictionary. Either bound may be omitted. Decimal digits only, with surrounding whitespace ignored; empty values, signs, fractions, overflow and min_count &gt; max_count return 400. Unknown counts are zero. Filters primary records before ordering/pagination; nested networks, parents and ASN geo are unchanged. A detail outside the range returns 404. Counts describe dictionary membership, not live node health. | [optional] |
| **minCount** | **int**| Inclusive minimum node count in the published location dictionary. Either bound may be omitted. Decimal digits only, with surrounding whitespace ignored; empty values, signs, fractions, overflow and min_count &gt; max_count return 400. Unknown counts are zero. Filters primary records before ordering/pagination; nested networks, parents and ASN geo are unchanged. A detail outside the range returns 404. Counts describe dictionary membership, not live node health. | [optional] |
| **name** | **string**|  | [optional] |
| **offset** | **int**| The initial index from which to return the results. | [optional] |
| **ordering** | **string**| Comma-separated fields: id, code, name, original_name. Prefix a field with - for descending order. Unsupported fields are ignored. Name ordering follows the catalog collation. | [optional] |
| **search** | **string**| Case-insensitive partial search across Country fields: &#x60;code&#x60; and &#x60;name&#x60;. Separate multiple terms with spaces or commas; every term must match at least one listed field. | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

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
listIsps($packageId, $code, $countryCode, $limit, maxCount: $maxCount, minCount: $minCount, $name, $offset, $ordering, $search, $acceptLanguage, $xImpersonateUser): \ProxyRequest\Dto\PaginatedISPList
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
$packageId = 550e8400-e29b-41d4-a716-446655440002; // string | Package whose targeting availability should be returned.
$code = 'code_example'; // string
$countryCode = 'countryCode_example'; // string
$limit = 56; // int | Number of results to return per page.
$maxCount = 56; // int | Inclusive maximum node count in the published location dictionary. Either bound may be omitted. Decimal digits only, with surrounding whitespace ignored; empty values, signs, fractions, overflow and min_count > max_count return 400. Unknown counts are zero. Filters primary records before ordering/pagination; nested networks, parents and ASN geo are unchanged. A detail outside the range returns 404. Counts describe dictionary membership, not live node health.
$minCount = 56; // int | Inclusive minimum node count in the published location dictionary. Either bound may be omitted. Decimal digits only, with surrounding whitespace ignored; empty values, signs, fractions, overflow and min_count > max_count return 400. Unknown counts are zero. Filters primary records before ordering/pagination; nested networks, parents and ASN geo are unchanged. A detail outside the range returns 404. Counts describe dictionary membership, not live node health.
$name = 'name_example'; // string
$offset = 56; // int | The initial index from which to return the results.
$ordering = 'ordering_example'; // string | Comma-separated fields: code, name. Prefix a field with - for descending order. Unsupported fields are ignored. Name ordering follows the catalog collation.
$search = 'search_example'; // string | Case-insensitive partial search across ISP fields: `code` and `name`. Separate multiple terms with spaces or commas; every term must match at least one listed field.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->listIsps($packageId, $code, $countryCode, $limit, maxCount: $maxCount, minCount: $minCount, $name, $offset, $ordering, $search, $acceptLanguage, $xImpersonateUser);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LocationsResource->listIsps: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **packageId** | **string**| Package whose targeting availability should be returned. | |
| **code** | **string**|  | [optional] |
| **countryCode** | **string**|  | [optional] |
| **limit** | **int**| Number of results to return per page. | [optional] |
| **maxCount** | **int**| Inclusive maximum node count in the published location dictionary. Either bound may be omitted. Decimal digits only, with surrounding whitespace ignored; empty values, signs, fractions, overflow and min_count &gt; max_count return 400. Unknown counts are zero. Filters primary records before ordering/pagination; nested networks, parents and ASN geo are unchanged. A detail outside the range returns 404. Counts describe dictionary membership, not live node health. | [optional] |
| **minCount** | **int**| Inclusive minimum node count in the published location dictionary. Either bound may be omitted. Decimal digits only, with surrounding whitespace ignored; empty values, signs, fractions, overflow and min_count &gt; max_count return 400. Unknown counts are zero. Filters primary records before ordering/pagination; nested networks, parents and ASN geo are unchanged. A detail outside the range returns 404. Counts describe dictionary membership, not live node health. | [optional] |
| **name** | **string**|  | [optional] |
| **offset** | **int**| The initial index from which to return the results. | [optional] |
| **ordering** | **string**| Comma-separated fields: code, name. Prefix a field with - for descending order. Unsupported fields are ignored. Name ordering follows the catalog collation. | [optional] |
| **search** | **string**| Case-insensitive partial search across ISP fields: &#x60;code&#x60; and &#x60;name&#x60;. Separate multiple terms with spaces or commas; every term must match at least one listed field. | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

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
listRegions($packageId, $code, $countryCode, $limit, $name, $offset, $ordering, $search, $acceptLanguage, $xImpersonateUser, includeAsns: $includeAsns, maxCount: $maxCount, minCount: $minCount): \ProxyRequest\Dto\PaginatedRegionList
```

List available regions

Returns regions supported by the selected package and country, including targetable ISPs. The asns field is always present and defaults to an empty array. Pass include_asns=true to include available autonomous system numbers. This option does not affect the standalone /locations/asn endpoint or the compact proxy-node response format.

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
$packageId = 550e8400-e29b-41d4-a716-446655440002; // string | Package whose targeting availability should be returned.
$code = 'code_example'; // string
$countryCode = 'countryCode_example'; // string
$includeAsns = true; // bool | The asns field is always present and defaults to an empty array. Pass include_asns=true to include available autonomous system numbers. This option does not affect the standalone /locations/asn endpoint or the compact proxy-node response format.
$limit = 56; // int | Number of results to return per page.
$maxCount = 56; // int | Inclusive maximum node count in the published location dictionary. Either bound may be omitted. Decimal digits only, with surrounding whitespace ignored; empty values, signs, fractions, overflow and min_count > max_count return 400. Unknown counts are zero. Filters primary records before ordering/pagination; nested networks, parents and ASN geo are unchanged. A detail outside the range returns 404. Counts describe dictionary membership, not live node health.
$minCount = 56; // int | Inclusive minimum node count in the published location dictionary. Either bound may be omitted. Decimal digits only, with surrounding whitespace ignored; empty values, signs, fractions, overflow and min_count > max_count return 400. Unknown counts are zero. Filters primary records before ordering/pagination; nested networks, parents and ASN geo are unchanged. A detail outside the range returns 404. Counts describe dictionary membership, not live node health.
$name = 'name_example'; // string
$offset = 56; // int | The initial index from which to return the results.
$ordering = 'ordering_example'; // string | Comma-separated fields: id, code, name, original_name, iso31662. Prefix a field with - for descending order. Unsupported fields are ignored. Name ordering follows the catalog collation.
$search = 'search_example'; // string | Case-insensitive partial search across Region fields: `code` and `name`. Separate multiple terms with spaces or commas; every term must match at least one listed field.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->listRegions($packageId, $code, $countryCode, $limit, $name, $offset, $ordering, $search, $acceptLanguage, $xImpersonateUser, includeAsns: $includeAsns, maxCount: $maxCount, minCount: $minCount);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LocationsResource->listRegions: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **packageId** | **string**| Package whose targeting availability should be returned. | |
| **code** | **string**|  | [optional] |
| **countryCode** | **string**|  | [optional] |
| **includeAsns** | **bool**| The asns field is always present and defaults to an empty array. Pass include_asns&#x3D;true to include available autonomous system numbers. This option does not affect the standalone /locations/asn endpoint or the compact proxy-node response format. | [optional] [default to false] |
| **limit** | **int**| Number of results to return per page. | [optional] |
| **maxCount** | **int**| Inclusive maximum node count in the published location dictionary. Either bound may be omitted. Decimal digits only, with surrounding whitespace ignored; empty values, signs, fractions, overflow and min_count &gt; max_count return 400. Unknown counts are zero. Filters primary records before ordering/pagination; nested networks, parents and ASN geo are unchanged. A detail outside the range returns 404. Counts describe dictionary membership, not live node health. | [optional] |
| **minCount** | **int**| Inclusive minimum node count in the published location dictionary. Either bound may be omitted. Decimal digits only, with surrounding whitespace ignored; empty values, signs, fractions, overflow and min_count &gt; max_count return 400. Unknown counts are zero. Filters primary records before ordering/pagination; nested networks, parents and ASN geo are unchanged. A detail outside the range returns 404. Counts describe dictionary membership, not live node health. | [optional] |
| **name** | **string**|  | [optional] |
| **offset** | **int**| The initial index from which to return the results. | [optional] |
| **ordering** | **string**| Comma-separated fields: id, code, name, original_name, iso31662. Prefix a field with - for descending order. Unsupported fields are ignored. Name ordering follows the catalog collation. | [optional] |
| **search** | **string**| Case-insensitive partial search across Region fields: &#x60;code&#x60; and &#x60;name&#x60;. Separate multiple terms with spaces or commas; every term must match at least one listed field. | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

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

## `listZipcodes()`

```php
listZipcodes($packageId, $asnCode, $cityCode, $code, $countryCode, $ispCode, $limit, maxCount: $maxCount, minCount: $minCount, $offset, $ordering, $regionCode, $search, $acceptLanguage, $xImpersonateUser): \ProxyRequest\Dto\PaginatedPostalList
```

List available ZIP codes

Returns active ZIP codes observed in the selected package provider dictionaries. All geographic and network filters intersect actual provider combinations. Counts are dictionary node counts, not live health.

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
$packageId = 550e8400-e29b-41d4-a716-446655440002; // string | Package whose targeting availability should be returned.
$asnCode = 'asnCode_example'; // string | ASN in the same observed combination.
$cityCode = 'cityCode_example'; // string | City code in the same observed combination.
$code = 'code_example'; // string | Postal identifier; case, spaces and hyphens are normalized. Leading zeros are preserved.
$countryCode = 'countryCode_example'; // string | Country code of an observed provider ZIP combination.
$ispCode = 'ispCode_example'; // string | ISP in the same observed combination.
$limit = 56; // int | Number of results to return per page.
$maxCount = 56; // int | Inclusive maximum node count in the published location dictionary. Either bound may be omitted. Decimal digits only, with surrounding whitespace ignored; empty values, signs, fractions, overflow and min_count > max_count return 400. Unknown counts are zero. Filters primary records before ordering/pagination; nested networks, parents and ASN geo are unchanged. A detail outside the range returns 404. Counts describe dictionary membership, not live node health.
$minCount = 56; // int | Inclusive minimum node count in the published location dictionary. Either bound may be omitted. Decimal digits only, with surrounding whitespace ignored; empty values, signs, fractions, overflow and min_count > max_count return 400. Unknown counts are zero. Filters primary records before ordering/pagination; nested networks, parents and ASN geo are unchanged. A detail outside the range returns 404. Counts describe dictionary membership, not live node health.
$offset = 56; // int | The initial index from which to return the results.
$ordering = 'ordering_example'; // string | Which field to use when ordering the results.
$regionCode = 'regionCode_example'; // string | Region code in the same observed combination.
$search = 'search_example'; // string | Case-insensitive partial search across zip code fields: `code` and `normalized_code`. Separate multiple terms with spaces or commas; every term must match at least one listed field.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->listZipcodes($packageId, $asnCode, $cityCode, $code, $countryCode, $ispCode, $limit, maxCount: $maxCount, minCount: $minCount, $offset, $ordering, $regionCode, $search, $acceptLanguage, $xImpersonateUser);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LocationsResource->listZipcodes: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **packageId** | **string**| Package whose targeting availability should be returned. | |
| **asnCode** | **string**| ASN in the same observed combination. | [optional] |
| **cityCode** | **string**| City code in the same observed combination. | [optional] |
| **code** | **string**| Postal identifier; case, spaces and hyphens are normalized. Leading zeros are preserved. | [optional] |
| **countryCode** | **string**| Country code of an observed provider ZIP combination. | [optional] |
| **ispCode** | **string**| ISP in the same observed combination. | [optional] |
| **limit** | **int**| Number of results to return per page. | [optional] |
| **maxCount** | **int**| Inclusive maximum node count in the published location dictionary. Either bound may be omitted. Decimal digits only, with surrounding whitespace ignored; empty values, signs, fractions, overflow and min_count &gt; max_count return 400. Unknown counts are zero. Filters primary records before ordering/pagination; nested networks, parents and ASN geo are unchanged. A detail outside the range returns 404. Counts describe dictionary membership, not live node health. | [optional] |
| **minCount** | **int**| Inclusive minimum node count in the published location dictionary. Either bound may be omitted. Decimal digits only, with surrounding whitespace ignored; empty values, signs, fractions, overflow and min_count &gt; max_count return 400. Unknown counts are zero. Filters primary records before ordering/pagination; nested networks, parents and ASN geo are unchanged. A detail outside the range returns 404. Counts describe dictionary membership, not live node health. | [optional] |
| **offset** | **int**| The initial index from which to return the results. | [optional] |
| **ordering** | **string**| Which field to use when ordering the results. | [optional] |
| **regionCode** | **string**| Region code in the same observed combination. | [optional] |
| **search** | **string**| Case-insensitive partial search across zip code fields: &#x60;code&#x60; and &#x60;normalized_code&#x60;. Separate multiple terms with spaces or commas; every term must match at least one listed field. | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

### Return type

[**\ProxyRequest\Dto\PaginatedPostalList**](../Model/PaginatedPostalList.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
