# InvoiceCreateRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**packageId** | **string** | Package to purchase. Required for package purchases. | [optional]
**userId** | **string** | Managed sub-user that should receive the purchase. | [optional]
**gateway** | [**\ProxyRequest\Dto\InvoiceCreateRequestGatewayEnum**](InvoiceCreateRequestGatewayEnum.md) |  |
**status** | [**\ProxyRequest\Dto\InvoiceCreateRequestStatusEnum**](InvoiceCreateRequestStatusEnum.md) | Initial invoice status. Defaults to pending. Only superusers may set paid; other authenticated users receive a 403 response. * &#x60;pending&#x60; - pending * &#x60;paid&#x60; - paid | [optional] [default to InvoiceCreateRequestStatusEnum::PENDING]
**cryptoCurrency** | **string** |  | [optional]
**paymentCurrency** | **string** | ISO 4217 currency charged by a regional fiat provider. | [optional]
**couponCode** | **string** |  | [optional]
**countryCode** | **string** |  | [optional]
**data** | **int** | Residential proxy data to purchase, in bytes. | [optional]
**quantity** | **int** | Number of static proxies to purchase. | [optional]
**amount** | **int** | Account balance amount to purchase, in the smallest currency unit. | [optional]
**connectionLimit** | **int** |  | [optional]
**expires** | **int** | Optional expiration as a Unix timestamp in seconds. | [optional]
**companyName** | **string** |  | [optional]
**companyRegistrationNumber** | **string** |  | [optional]
**companyVatNumber** | **string** |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
