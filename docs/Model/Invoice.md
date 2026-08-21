# Invoice

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** |  | [optional]
**package** | [**\ProxyRequest\Dto\PackageShort**](PackageShort.md) |  | [readonly]
**country** | [**\ProxyRequest\Dto\Country**](Country.md) |  | [readonly]
**userId** | **string** |  | [readonly]
**coupon** | [**\ProxyRequest\Dto\CouponShort**](CouponShort.md) |  | [readonly]
**updated** | **\DateTime** |  | [readonly]
**created** | **\DateTime** |  | [readonly]
**type** | [**\ProxyRequest\Dto\InvoiceTypeEnum**](InvoiceTypeEnum.md) | The type of invoice, indicating the type of proxy service. Options include: RESIDENTIAL: Residential proxies. STATIC: Static proxies. * &#x60;static&#x60; - Static * &#x60;residential&#x60; - Residential * &#x60;balance&#x60; - Balance | [optional]
**isOneTime** | **bool** | Indicates whether this invoice is for a one-time purchase. Default is False, meaning it is a recurring invoice. | [optional]
**isPayout** | **bool** | Indicates whether this invoice is a payout to the marketer. Default is False. | [optional]
**internalId** | **string** | A unique identifier for the invoice, generated automatically. | [optional]
**status** | [**\ProxyRequest\Dto\InvoiceStatusEnum**](InvoiceStatusEnum.md) | After changing invoice status to PAID, the invoice will be processed and user package created in case none exists. If you need to cancel the invoice, make sure to subtract data from the user package after changing the invoice status. Changing the status from PAID to any other will not affect the user package&#39;s data or proxies. * &#x60;pending&#x60; - Pending * &#x60;paid&#x60; - Paid * &#x60;unpaid&#x60; - Unpaid * &#x60;error&#x60; - Error | [optional]
**description** | **string** | A description of the invoice. This field is optional and can be left blank. | [optional]
**connectionLimit** | **int** | The maximum number of concurrent connections allowed for this package. | [optional]
**quantity** | **int** | The number of proxies to assign. | [optional]
**data** | **int** | The amount of data in bytes. | [optional]
**balance** | **int** | The balance to top up for the user. Must be zero or positive. | [optional]
**priceTotal** | **int** | The total price of the invoice, including any discounts. Must be at least 1 cent. | [optional]
**gateway** | [**\ProxyRequest\Dto\InvoiceGatewayEnum**](InvoiceGatewayEnum.md) | The payment gateway used for processing the payment. * &#x60;coinbase&#x60; - Coinbase * &#x60;cryptomus&#x60; - Cryptomus * &#x60;stripe&#x60; - Stripe * &#x60;coingate&#x60; - Coingate * &#x60;wallet&#x60; - Wallet * &#x60;manual&#x60; - Manual | [optional]
**paymentUrl** | **string** | The URL for making the payment. Optional field with a maximum length of 500 characters. | [optional]
**coingateOrderToken** | **string** | The Coingate order token for the payment. Optional field with a maximum length of 255 characters. | [optional]
**coinbaseChargeId** | **string** | The Coinbase charge ID for the payment. Optional field with a maximum length of 255 characters. | [optional]
**vat** | **float** | The VAT percentage applied to the invoice. Must be between 0 and 100. | [optional]
**companyName** | **string** |  | [optional]
**companyAddress** | **string** |  | [optional]
**companyCity** | **string** |  | [optional]
**companyPostalCode** | **string** |  | [optional]
**companyRegistrationNumber** | **string** |  | [optional]
**companyVatNumber** | **string** |  | [optional]
**paid** | **\DateTime** | The date and time when the invoice was paid. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
