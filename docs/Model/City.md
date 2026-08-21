# City

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** |  | [optional]
**code** | **string** | Raw city code as it appears in the source data. los_angeles paris |
**name** | **string** | English display name of the city used across the admin and API responses. |
**country** | [**\ProxyRequest\Dto\LocationCountrySummary**](LocationCountrySummary.md) |  | [readonly]
**region** | [**\ProxyRequest\Dto\LocationRegionSummary**](LocationRegionSummary.md) |  | [readonly]
**isps** | [**\ProxyRequest\Dto\LocationCodeName[]**](LocationCodeName.md) |  | [readonly]
**asns** | [**\ProxyRequest\Dto\LocationCodeName[]**](LocationCodeName.md) |  | [readonly]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
