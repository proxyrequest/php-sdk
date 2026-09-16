# InvoiceCreateRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**packageId** | **string** | Package to purchase. Required for package purchases. | [optional]
**userId** | **string** | Account receiving the purchase. Omit for your own account. Sending user_id requires is_reseller; a reseller can target its own sub-user, while a superuser with is_reseller can target another account. Do not send your own ID. | [optional]
**gateway** | [**\ProxyRequest\Dto\InvoiceCreateRequestGatewayEnum**](InvoiceCreateRequestGatewayEnum.md) |  |
**status** | [**\ProxyRequest\Dto\InvoiceCreateRequestStatusEnum**](InvoiceCreateRequestStatusEnum.md) | Initial invoice status. Defaults to pending. Only superusers may set paid; other authenticated users receive a 403 response. * &#x60;pending&#x60; - pending * &#x60;paid&#x60; - paid | [optional] [default to InvoiceCreateRequestStatusEnum::PENDING]
**cryptoCurrency** | **string** |  | [optional]
**paymentCurrency** | **string** | ISO 4217 currency charged by a regional fiat provider. | [optional]
**couponCode** | **string** |  | [optional]
**countryCode** | **string** |  | [optional]
**data** | **int** | Residential proxy data to purchase, in integer bytes (1 GiB &#x3D; 1073741824). Required with package_id for a residential purchase. A paid purchase funds the recipient&#39;s order; it is not a virtual allocation from a parent pool. | [optional]
**quantity** | **int** | Number of static proxies to purchase. | [optional]
**amount** | **int** | Account balance amount to purchase, in the smallest currency unit. Use for a wallet top-up without package_id, not for buying proxy data. | [optional]
**connectionLimit** | **int** |  | [optional]
**expires** | **int** | Optional future expiration as a Unix timestamp in seconds, not milliseconds. Otherwise a positive package billing cycle determines the purchased data&#39;s expiration from the payment date; a zero cycle has no automatic expiration. A later purchase does not extend earlier finite, expiring ledgers. | [optional]
**companyName** | **string** |  | [optional]
**companyRegistrationNumber** | **string** |  | [optional]
**companyVatNumber** | **string** |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
