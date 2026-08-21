# Package

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** |  | [optional]
**name** | **string** | Unique display name for this package shown to customers and in the admin. Residential Starter Business Pro |
**alias** | **string** | Lowercase alphanumeric identifier used internally for package resolution and proxy username routing. Cannot be changed without affecting active connections. residential01 bizpro |
**type** | [**\ProxyRequest\Dto\ProxyTypeEnum**](ProxyTypeEnum.md) |  | [optional]
**order** | **int** | Display order in the UI. Lower values appear first. | [optional]
**isContinentTargeting** | **bool** | When enabled, users on this package can target proxies by continent. If disabled, they will only be able to target by country or city. | [optional]
**isCountryTargeting** | **bool** | Allow users to target a specific country in their proxy username. country-us country-de | [optional]
**isRegionTargeting** | **bool** | Allow users to target a specific region in their proxy username. Requires country targeting to be enabled. country-us-region-california | [optional]
**isCityTargeting** | **bool** | Allow users to target a specific city in their proxy username. Requires country and region targeting to be enabled. country-us-region-california-city-los_angeles | [optional]
**isAsnTargeting** | **bool** | Allow users to target a specific ASN in their proxy username. ASNs must be configured in the provider&#39;s location vocabulary. country-us-asn-3602 | [optional]
**features** | **mixed[]** |  | [readonly]
**description** | **string** | Customer-facing description shown on the package listing page. | [optional]
**pricing** | [**\ProxyRequest\Dto\PricingEnum**](PricingEnum.md) | Pricing model applied when customers purchase data on this package. Fixed a fixed price per data amount — 10 GB for $10, 50 GB for $50 Range tiered pricing where the unit price decreases as quantity increases * &#x60;fixed&#x60; - Fixed * &#x60;range&#x60; - Range | [optional]
**pricingUnit** | [**\ProxyRequest\Dto\PricingUnitEnum**](PricingUnitEnum.md) | Unit customers purchase — determines how the billing model amounts are interpreted. * &#x60;data&#x60; - Data * &#x60;proxy&#x60; - Proxy | [optional]
**billingCycle** | **int** | Number of days before purchased data expires. Set to -1 for data that never expires. 30 monthly -1 never expires |
**billingModel** | **array<string,mixed>** |  | [readonly]
**commissionRate** | **float** | Reseller commission rate as a percentage of the sale price. Applies to all purchases of this package. 10.00 → 10 percent commission on every purchase | [optional]
**commissionType** | [**\ProxyRequest\Dto\CommissionTypeEnum**](CommissionTypeEnum.md) | How the commission rate is applied to reseller sales. Fixed a fixed percentage regardless of sale amount Flexible rate may vary based on negotiated reseller terms * &#x60;flexible&#x60; - Flexible * &#x60;percentage&#x60; - Percentage * &#x60;fixed&#x60; - Fixed | [optional]
**targetingOptions** | [**\ProxyRequest\Dto\TargetingOptions**](TargetingOptions.md) |  | [readonly]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
