# CouponUpdateRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**value** | **int** | Arbitrary coupon value |
**code** | **string** | Coupon code cannot be changed if already set | [optional]
**isMultiUse** | **bool** | If true, coupon can be used multiple times. | [optional]
**isAvailableToOneTime** | **bool** | If true, coupon can not be used for one-time package tiers. | [optional]
**marketer** | **string** | The marketer who owns this coupon. Required if is_marketer is true. | [optional]
**type** | [**\ProxyRequest\Dto\CouponTypeEnum**](CouponTypeEnum.md) |  |
**limit** | **int** | Number of times coupon can be used | [optional]
**validUntil** | **\DateTime** | Leave empty for coupons that never expire | [optional]
**packages** | **string[]** | Select packages for which this coupon is available. If no packages are selected, the coupon is available to all packages. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
