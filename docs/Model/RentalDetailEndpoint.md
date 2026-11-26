# RentalDetailEndpoint

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** |  | [optional]
**orderId** | **string** |  | [readonly]
**label** | **string** |  | [optional]
**isActive** | **bool** |  | [optional]
**allowedIps** | **string[]** |  | [readonly]
**periods** | [**\ProxyRequest\Dto\Period[]**](Period.md) |  | [readonly]
**connections** | [**\ProxyRequest\Dto\StaticConnection[]**](StaticConnection.md) |  | [readonly]
**maxBandwidthMbps** | **int** |  | [readonly]
**capabilities** | **array<string,bool>** |  | [readonly]
**passwordRotationStatus** | **string** |  | [optional]
**groupId** | **string** |  |
**groupSize** | **int** |  |
**renewable** | **bool** |  |
**ready** | **bool** |  |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
