# AffiliateReward

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** |  | [optional]
**email** | **string** |  | [readonly]
**status** | [**\ProxyRequest\Dto\RewardStatusEnum**](RewardStatusEnum.md) | After changing invoice status to PAID, the invoice will be processed and user package created in case none exists. If you need to cancel the invoice, make sure to subtract data from the user package after changing the invoice status. Changing the status from PAID to any other will not affect the user package&#39;s data or proxies. * &#x60;pending&#x60; - Pending * &#x60;paid&#x60; - Paid * &#x60;review&#x60; - Review * &#x60;cancelled&#x60; - Cancelled | [optional]
**package** | [**\ProxyRequest\Dto\PackageShort**](PackageShort.md) |  | [readonly]
**priceTotal** | **int** |  | [readonly]
**data** | **int** | The amount of data in bytes. | [optional]
**commissionAmount** | **int** |  | [readonly]
**created** | **\DateTime** |  | [readonly]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
