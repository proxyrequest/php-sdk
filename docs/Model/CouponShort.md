# CouponShort

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** |  | [optional]
**isExpired** | **bool** |  | [readonly]
**isRedeemed** | **bool** |  | [readonly]
**packages** | **array<string,mixed>[]** |  | [readonly]
**created** | **\DateTime** |  | [readonly]
**value** | **int** | Arbitrary coupon value |
**code** | **string** | Leaving this field empty will generate a random code. | [readonly]
**isMultiUse** | **bool** | If true, coupon can be used multiple times. | [optional]
**isAvailableToOneTime** | **bool** | If true, coupon can not be used for one-time package tiers. | [optional]
**type** | [**\ProxyRequest\Dto\CouponTypeEnum**](CouponTypeEnum.md) |  |
**limit** | **int** | Number of times coupon can be used | [optional]
**validUntil** | **\DateTime** | Leave empty for coupons that never expire | [optional]
**marketer** | **string** | The marketer who owns this coupon. Required if is_marketer is true. | [optional]
**user** | **string** | The user who created this coupon. | [readonly]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
