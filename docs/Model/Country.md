# Country

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** |  | [optional]
**code** | **string** | Two-letter ISO 3166-1 alpha-2 country code. Must be unique. us de fr |
**name** | **string** | English display name of the country used across the admin and API responses. |
**originalName** | **string** | Native-language name of the country as it appears in the source data. Deutschland Français | [optional]
**isps** | [**\ProxyRequest\Dto\LocationCodeName[]**](LocationCodeName.md) |  | [readonly]
**asns** | [**\ProxyRequest\Dto\LocationCodeName[]**](LocationCodeName.md) | The asns field is always present and defaults to an empty array. Pass include_asns&#x3D;true to include available autonomous system numbers. This option does not affect the standalone /locations/asn endpoint or the compact proxy-node response format. | [readonly]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
