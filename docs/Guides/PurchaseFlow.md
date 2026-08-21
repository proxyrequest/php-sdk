# Purchase a package with an invoice

Use this flow when ProxyRequest should calculate the current package price,
create the commercial record, and initialize the selected payment provider. A
purchase can apply to the authenticated account or to a managed sub-user.

```text
Package -> optional coupon preview -> pending invoice -> checkout
        -> paid invoice -> order / data ledger -> proxy credentials
```

An invoice is commercial state; an order and its ledger are service state. Do
not activate access because invoice creation succeeded or because the browser
returned from checkout. Confirm the paid invoice server-side and verify the
resulting entitlement.

## 1. Select a package and create the invoice

Package IDs must come from the current deployment instead of being hard-coded
from another environment. Byte amounts are integers; the example below uses 10
GiB. Confirm whether your own product uses decimal GB or binary GiB and perform
that conversion once in your billing layer.

`userId` is optional. Omit it to purchase for the authenticated account, or set
it to a managed sub-user UUID to make that user the recipient of the purchase.
Available payment gateways depend on the deployment; this example uses Stripe.

```php
<?php

require __DIR__.'/vendor/autoload.php';

use ProxyRequest\Client;
use ProxyRequest\Dto\CouponCalculatePriceRequest;
use ProxyRequest\Dto\InvoiceCreateRequest;
use ProxyRequest\Dto\InvoiceCreateRequestGatewayEnum;

$client = Client::withApiKey($_ENV['PROXYREQUEST_API_KEY']);
$dataBytes = 10 * 1024 ** 3;

$packagePage = $client->packages()->list(limit: 100);
$package = $packagePage->getResults()[0]
    ?? throw new RuntimeException('No package is available for this account.');
$packageId = $package->getId()
    ?? throw new RuntimeException('The selected package has no ID.');

$managedUserId = null; // Set a ProxyRequest sub-user UUID when applicable.
$couponCode = null; // Set the customer-supplied code when applicable.

if (null !== $couponCode) {
    $preview = $client->coupons()->calculatePrice(
        new CouponCalculatePriceRequest([
            'packageId' => $packageId,
            'couponCode' => $couponCode,
            'data' => $dataBytes,
        ]),
    );

    printf("Discounted total: %d\n", $preview->getPriceDiscounted());
}

$invoiceData = [
    'packageId' => $packageId,
    'gateway' => InvoiceCreateRequestGatewayEnum::STRIPE,
    'data' => $dataBytes,
];

if (null !== $managedUserId) {
    $invoiceData['userId'] = $managedUserId;
}

if (null !== $couponCode) {
    $invoiceData['couponCode'] = $couponCode;
}

$invoice = $client->invoices()->create(new InvoiceCreateRequest($invoiceData));
$invoiceId = $invoice->getId()
    ?? throw new RuntimeException('The created invoice has no ID.');

// Persist $invoiceId next to your own checkout record before redirecting.
$payment = $client->invoices()->getPaymentLink($invoiceId);
printf("Send the customer to: %s\n", $payment->getPaymentUrl());
```

The coupon preview is informational and does not create or reserve anything.
Recalculate immediately before checkout and treat the total returned by invoice
creation as authoritative.

## 2. Confirm payment and entitlement

Run confirmation from your backend after a verified payment notification, or
when the customer returns to your application. A browser redirect alone is not
proof of settlement.

```php
<?php

require __DIR__.'/vendor/autoload.php';

use ProxyRequest\Client;
use ProxyRequest\Dto\GenerateProxyRequest;
use ProxyRequest\Dto\InvoiceStatusEnum;

$client = Client::withApiKey($_ENV['PROXYREQUEST_API_KEY']);

$invoiceId = 'replace-with-the-persisted-invoice-id';
$packageId = 'replace-with-the-persisted-package-id';
$managedUserId = null; // Use the same recipient recorded at invoice creation.

$invoice = $client->invoices()->get($invoiceId);

if (InvoiceStatusEnum::PAID !== $invoice->getStatus()) {
    throw new RuntimeException('The invoice is not paid; access stays inactive.');
}

$orders = $client->orders()->list(
    limit: 100,
    packageId: $packageId,
    userId: $managedUserId,
);

$order = $orders->getResults()[0]
    ?? throw new RuntimeException('Payment is recorded, but the entitlement is not ready.');

$generationData = [
    'packageId' => $packageId,
    'quantity' => 1,
];

if (null !== $managedUserId) {
    $generationData['userId'] = $managedUserId;
}

$result = $client->proxies()->generate(new GenerateProxyRequest($generationData));

foreach ($result->getProxies() as $proxy) {
    printf("Proxy: %s\n", $proxy->getConnectionString());
}
```

Treat generated connection strings as secrets. Deliver them to the intended
customer over an authenticated channel and do not write them to application
logs.

## Recovery and reconciliation

- Persist your checkout ID, the ProxyRequest invoice ID, package ID, recipient
  user ID, expected byte amount, and current local state.
- If invoice creation times out after the request was sent, inspect invoices
  visible to the account before repeating the write. The API does not promise a
  universal idempotency key for writes.
- Keep payment, invoice, order, allocation, and credential states separate in
  your database so a partially completed workflow can resume safely.
- Use signed webhooks for prompt reactions, then reconcile against invoices,
  durable order/ledger state, and closed analytics windows.

## Related documentation

- [Billing, coupons, and growth](https://proxyrequest.com/docs/integration/billing-and-growth/)
- [Catalog, locations, and proxy generation](https://proxyrequest.com/docs/integration/catalog-and-proxies/)
- [API resource map](https://proxyrequest.com/docs/integration/api-resource-map/)
- [List packages](https://proxyrequest.com/docs/api/operations/packages_list/)
- [Calculate a coupon price](https://proxyrequest.com/docs/api/operations/coupons_calculate_price_create/)
- [Create an invoice](https://proxyrequest.com/docs/api/operations/invoices_create/)
- [Get an invoice](https://proxyrequest.com/docs/api/operations/invoices_retrieve/)
- [Get an invoice payment link](https://proxyrequest.com/docs/api/operations/invoices_pay_retrieve/)
- [List active orders](https://proxyrequest.com/docs/api/operations/orders_list/)
- [Generate proxy credentials](https://proxyrequest.com/docs/api/operations/proxies_generate_create/)
- SDK references: [Invoices](../Api/InvoicesResource.md),
  [InvoiceCreateRequest](../Model/InvoiceCreateRequest.md),
  [Orders](../Api/OrdersResource.md), and [Proxies](../Api/ProxiesResource.md)

[Back to the SDK README](../../README.md)
