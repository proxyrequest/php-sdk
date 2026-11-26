# Static proxy rentals

An ISP/DC rental assigns a stable endpoint ID. Its connection details can change when an IP is replaced. Keep the order ID and endpoint ID in your application and fetch current connection details before using the proxy. Use a server-side API key or JWT on a deployment that offers static rentals.

## Use an existing order

```php
use ProxyRequest\Client;

$client = Client::withApiKey($_ENV['PROXYREQUEST_API_KEY']);
$orderId = $_ENV['PROXYREQUEST_STATIC_ORDER_ID'];

$rental = $client->orders()->getRental($orderId, limit: 100);
$ready = array_values(array_filter(
    $rental->getResults(),
    static fn ($endpoint) => $endpoint->getReady(),
));

$proxyUrls = $client->staticProxies()->exportUrls(
    orderId: $orderId,
    protocol: 'http',
);
```

The export contains newline-separated URLs for ready endpoints with the requested protocol. An empty string means there are no matching ready connections. The URLs include credentials. Keep them out of logs and browser code. For structured data and larger orders, page through `getRental()` using `limit` and `offset`.

The rental shows either shared order credentials or credentials on each connection. If an endpoint gets a new IP, fetch its latest connection from the rental or export. A scoped integration key needs `read` for rental status and `credentials` for secrets in that response. A key with only `credentials` can use the text export.

## Buy an ISP/DC bundle

Choose an available offer from `listCatalog()` or select a term and location using `getAvailability()`. Prices are in the smallest unit of the returned currency. Persist a separate key for each intended mutation before sending it.

```php
use ProxyRequest\Dto\IntentRequest;
use ProxyRequest\Dto\PurchaseMutationRequest;
use ProxyRequest\Dto\StaticCheckoutRequest;

$orders = $client->orders();
$offerId = $_ENV['PROXYREQUEST_STATIC_OFFER_ID'];
$reservationKey = $_ENV['STATIC_RESERVATION_KEY'];
$checkoutKey = $_ENV['STATIC_CHECKOUT_KEY'];

$selection = $orders->quotePurchase(intentRequest: new IntentRequest(['offerId' => $offerId]));
$reservation = $orders->reserve(
    idempotencyKey: $reservationKey,
    purchaseMutationRequest: new PurchaseMutationRequest(['offerId' => $offerId]),
);
$orderId = $reservation->getOrderId();

$checkoutQuote = $orders->quoteCheckout($orderId, new StaticCheckoutRequest(['gateway' => 'wallet']));
$invoice = $orders->checkout(
    $orderId,
    new StaticCheckoutRequest([
        'gateway' => 'wallet',
        'expectedTotal' => $checkoutQuote->getTotal(),
    ]),
    idempotencyKey: $checkoutKey,
);
```

For hosted checkout, use the payment link from the invoice or `getPaymentLink()` on the invoices resource. Store both the order and invoice IDs, then poll `getRental()` with a bounded interval and deadline. Observe the matching invoice's payment status, fulfillment status and deadline. `getReady()` identifies usable endpoints during partial fulfillment. If fulfillment terminates with missing addresses, use the invoice's failure reason and refund details. Avoid submitting a new purchase while the original is pending.

If a response is lost, repeat the same request and key. SDK retries within a call preserve the key. `ApiException::getIdempotencyKey()` returns the transmitted key when available. A legacy `idempotency_key` in a rental request body is accepted. If supplying both the body and header keys, use exactly the same value. When the server returns `price_changed`, quote again and confirm the new total before committing a new attempt.

## Renew selected endpoints

Read the available term IDs and the renewable endpoints from `getRental()`. The quotation and charge should use the same endpoint IDs, term and payment settings.

```php
use ProxyRequest\Dto\RenewalCheckoutRequest;
use ProxyRequest\Dto\RenewalRequestRequest;
use ProxyRequest\Dto\RenewalSelectionRequest;

$selection = [
    'termId' => $_ENV['STATIC_RENEWAL_TERM_ID'],
    'endpointIds' => [$_ENV['STATIC_ENDPOINT_ID']],
    'invoice' => new RenewalCheckoutRequest(['gateway' => 'wallet']),
];
$quote = $orders->quoteRenewal($orderId, new RenewalSelectionRequest($selection));
$renewal = $orders->renew(
    $orderId,
    new RenewalRequestRequest([...$selection, 'expectedTotal' => $quote->getTotal()]),
    idempotencyKey: $_ENV['STATIC_RENEWAL_KEY'],
);
```

Set `'allEndpoints' => true` in the request model to quote and renew the whole eligible rental. Calendar renewal settings use `getCalendarRenewal()` and `setCalendarRenewal()`. For a manual replacement, use `requestReplacement()`, poll `listReplacements()`, and refresh the resulting connection parameters.


## Rotate credentials

Check the endpoint's `rotate_password` capability. Select any endpoint in the credential group to rotate that group's password.

```php
$result = $client->orders()->resetProxyPasswordWithResponse($orderId, endpointId: $endpointId);
if (202 === $result->statusCode) {
    $endpoint = $client->staticProxies()->getEndpoint($endpointId);
    $status = $endpoint->getPasswordRotationStatus();
}
```

HTTP 200 confirms synchronous rotation. HTTP 202 queues a supplier request. Poll `getEndpoint()` until the status is `succeeded` and read the credentials again. A `failed` status ends the attempt. With `unknown`, the supplier result is still being reconciled. Omitting `endpointId` requests rotation for the order. If a provider cannot rotate ISP credentials, the API returns HTTP 400 with code `unsupported_operation`.
