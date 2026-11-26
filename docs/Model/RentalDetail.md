# RentalDetail

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**requested** | **int** |  | [optional]
**fulfilled** | **int** |  | [optional]
**refunded** | **int** |  | [optional]
**pending** | **int** |  | [optional]
**refundedCents** | **int** |  | [optional]
**count** | **int** |  |
**next** | **string** |  |
**previous** | **string** |  |
**results** | [**\ProxyRequest\Dto\RentalDetailEndpoint[]**](RentalDetailEndpoint.md) |  |
**groups** | [**\ProxyRequest\Dto\RentalDetailGroup[]**](RentalDetailGroup.md) |  |
**orderId** | **string** |  |
**userId** | **string** |  |
**packageId** | **string** |  |
**packageName** | **string** |  |
**status** | [**\ProxyRequest\Dto\StaticRentalStatusEnum**](StaticRentalStatusEnum.md) |  |
**renewableCount** | **int** |  |
**snapshot** | [**\ProxyRequest\Dto\RentalQuote**](RentalQuote.md) |  |
**invoiceId** | **string** |  |
**reservedUntil** | **\DateTime** |  |
**terms** | [**\ProxyRequest\Dto\RentalDetailTerm[]**](RentalDetailTerm.md) |  |
**invoices** | [**\ProxyRequest\Dto\RentalDetailInvoice[]**](RentalDetailInvoice.md) |  |
**credentialMode** | [**\ProxyRequest\Dto\CredentialModeEnum**](CredentialModeEnum.md) |  |
**capabilities** | **array<string,bool>** |  |
**username** | **string** |  | [optional]
**proxyPassword** | **string** |  | [optional]
**mobile** | **bool** |  | [optional]
**gateways** | [**\ProxyRequest\Dto\RentalGateway[]**](RentalGateway.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
