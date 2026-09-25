# Region

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** |  | [optional]
**code** | **string** | Raw region code as it appears in the source data. Used together with country to form a unique identifier. california ile_de_france |
**iso31662** | **string** | ISO 3166-2 subdivision code for this region. US-CA FR-IDF | [optional]
**name** | **string** | English display name of the region used across the admin and API responses. |
**originalName** | **string** | Native-language name of the region as it appears in the source data. | [optional]
**country** | [**\ProxyRequest\Dto\LocationCountrySummary**](LocationCountrySummary.md) |  | [readonly]
**isps** | [**\ProxyRequest\Dto\LocationCodeName[]**](LocationCodeName.md) |  | [readonly]
**asns** | [**\ProxyRequest\Dto\LocationCodeName[]**](LocationCodeName.md) | The asns field is always present and defaults to an empty array. Pass include_asns&#x3D;true to include available autonomous system numbers. This option does not affect the standalone /locations/asn endpoint or the compact proxy-node response format. | [readonly]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
