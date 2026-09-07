# InvoiceShort

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** |  | [optional]
**coupon** | [**\ProxyRequest\Dto\Coupon**](Coupon.md) |  | [readonly]
**country** | [**\ProxyRequest\Dto\Country**](Country.md) |  | [readonly]
**updated** | **\DateTime** |  | [readonly]
**created** | **\DateTime** |  | [readonly]
**isOneTime** | **bool** | Indicates whether this invoice is for a one-time purchase. Default is False, meaning it is a recurring invoice. | [optional]
**isPayout** | **bool** | Indicates whether this invoice is a payout to the marketer. Default is False. | [optional]
**internalId** | **string** | A unique identifier for the invoice, generated automatically. | [optional]
**status** | [**\ProxyRequest\Dto\InvoiceStatusEnum**](InvoiceStatusEnum.md) | After changing invoice status to PAID, the invoice will be processed and user package created in case none exists. If you need to cancel the invoice, make sure to subtract data from the user package after changing the invoice status. Changing the status from PAID to any other will not affect the user package&#39;s data or proxies. * &#x60;pending&#x60; - Pending * &#x60;paid&#x60; - Paid * &#x60;unpaid&#x60; - Unpaid * &#x60;error&#x60; - Error | [optional]
**description** | **string** | A description of the invoice. This field is optional and can be left blank. | [optional]
**connectionLimit** | **int** | The maximum number of concurrent connections allowed for this package. | [optional]
**data** | **int** | The amount of data in bytes. | [optional]
**balance** | **int** | The balance to top up for the user. Must be zero or positive. | [optional]
**priceTotal** | **int** | The total price of the invoice, including any discounts. Must be at least 1 cent. | [optional]
**gateway** | [**\ProxyRequest\Dto\InvoiceGatewayEnum**](InvoiceGatewayEnum.md) | The payment gateway used for processing the payment. * &#x60;coinbase&#x60; - Coinbase * &#x60;cryptomus&#x60; - Cryptomus * &#x60;stripe&#x60; - Stripe * &#x60;coingate&#x60; - Coingate * &#x60;wallet&#x60; - Wallet * &#x60;manual&#x60; - Manual * &#x60;whitepay&#x60; - Whitepay * &#x60;wayforpay&#x60; - WayForPay * &#x60;usegateway&#x60; - UseGateway * &#x60;binance&#x60; - Binance Pay * &#x60;anymoney&#x60; - Any.Money * &#x60;coinpayments&#x60; - CoinPayments * &#x60;checkoutcom&#x60; - Checkout.com * &#x60;nowpayments&#x60; - NOWPayments * &#x60;btcpay&#x60; - BTCPay Server * &#x60;braintree&#x60; - Braintree * &#x60;monobank&#x60; - monobank * &#x60;liqpay&#x60; - LiqPay * &#x60;iyzico&#x60; - iyzico * &#x60;paytr&#x60; - PayTR * &#x60;payu&#x60; - PayU * &#x60;tpay&#x60; - Tpay * &#x60;przelewy24&#x60; - Przelewy24 * &#x60;gopay&#x60; - GoPay * &#x60;comgate&#x60; - Comgate * &#x60;monei&#x60; - MONEI * &#x60;redsys&#x60; - Redsys * &#x60;payplug&#x60; - PayPlug * &#x60;mollie&#x60; - Mollie * &#x60;unzer&#x60; - Unzer * &#x60;payone&#x60; - PAYONE * &#x60;nexi_xpay&#x60; - Nexi XPay * &#x60;halyk_epay&#x60; - Halyk ePay * &#x60;kaspi_pay&#x60; - Kaspi Pay * &#x60;vipps_mobilepay&#x60; - Vipps MobilePay * &#x60;paytrail&#x60; - Paytrail | [optional]
**currency** | **string** | ISO 4217 currency captured when the invoice is created. | [optional]
**providerCheckoutId** | **string** | Provider-side hosted checkout identifier used for reconciliation. | [optional]
**providerPaymentId** | **string** | Provider-side payment or transaction identifier used for reconciliation. | [optional]
**checkoutStatus** | [**\ProxyRequest\Dto\CheckoutStatusEnum**](CheckoutStatusEnum.md) |  | [optional]
**vat** | **float** | The VAT percentage applied to the invoice. Must be between 0 and 100. | [optional]
**companyName** | **string** |  | [optional]
**companyAddress** | **string** |  | [optional]
**companyCity** | **string** |  | [optional]
**companyPostalCode** | **string** |  | [optional]
**companyRegistrationNumber** | **string** |  | [optional]
**companyVatNumber** | **string** |  | [optional]
**paid** | **\DateTime** | The date and time when the invoice was paid. | [optional]
**expires** | **\DateTime** | The date and time when the invoice expires. If not set, the invoice does not expire. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
