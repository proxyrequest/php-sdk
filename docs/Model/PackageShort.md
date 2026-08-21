# PackageShort

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** |  | [optional]
**name** | **string** | Unique display name for this package shown to customers and in the admin. Residential Starter Business Pro |
**alias** | **string** | Lowercase alphanumeric identifier used internally for package resolution and proxy username routing. Cannot be changed without affecting active connections. residential01 bizpro |
**isUnlimitedData** | **bool** | When enabled, users on this package have no data cap. The proxy will not enforce any bandwidth limit. | [optional]
**targetingOptions** | [**\ProxyRequest\Dto\TargetingOptions**](TargetingOptions.md) |  | [readonly]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
