# ProxyRequest PHP SDK

Official PHP 8.5 client for the [ProxyRequest](https://proxyrequest.com/)
public API. The package covers all 82 operations from the current OpenAPI
contract, including users, orders, proxy generation, analytics, invoices,
packages, locations, webhooks, API keys, and Telegram integration.

## What is ProxyRequest?

ProxyRequest is a white-label proxy platform for operators and resellers that
already have upstream proxy supply. It provides the product and control layer
needed to turn that supply into a customer-facing service:

- managed HTTP, HTTPS, SOCKS5, and SOCKS5h gateways;
- packages, users, orders, proxy credentials, limits, and byte accounting;
- geographic and network targeting, sticky sessions, and multi-provider routing;
- customer and reseller dashboards, invoices, coupons, and payment flows;
- analytics, signed webhooks, API keys, and operational reporting.

You can use the complete managed backend and customer dashboard, or keep your
own frontend, identity, and billing while ProxyRequest handles provisioning,
routing, accounting, and analytics headlessly. You retain your brand, pricing,
customer relationships, and upstream provider contracts.

ProxyRequest is not an upstream bandwidth plan. Provider traffic and contracts
remain separate from the platform subscription. See the
[platform overview](https://proxyrequest.com/docs/) for the complete operating
boundary.

## How this SDK fits

The REST API is the control plane around proxy traffic. This SDK provisions
resources and reads their state; customer proxy requests go to the managed
gateway servers instead of passing through the SDK or REST API.

```text
Your PHP backend ── HTTPS/JSON ──> ProxyRequest API
Customer traffic ── HTTP/SOCKS ──> Managed gateways ──> Destination
```

Keep the credentials for those paths separate: API keys belong only in trusted
backend code, while generated proxy usernames and passwords are supplied only
to the customer or workload that connects to a gateway.

The most important resource relationships are:

```text
Customer purchase:
Package -> Invoice -> Paid invoice -> Order / data ledger -> Proxy credentials

Reseller provisioning:
Eligible root order -> Sub-user + child allocation -> Proxy credentials
```

Invoices describe commercial state. Orders and data ledgers describe service
entitlement. Creating an invoice or returning from checkout is therefore not
proof that proxy access is active.

## Choose an integration path

| Scenario | Use this path |
| --- | --- |
| Built-in customer checkout | Select a package, create an invoice, obtain its payment link, confirm payment and entitlement, then generate proxy credentials. |
| Reseller-managed customer | Create a sub-user, assign a package and byte limit from an eligible root order, then generate credentials for that user. |
| Existing headless platform | Keep your own customer and billing records, persist mappings to ProxyRequest users/packages/orders, and provision through the API. |

For complete PHP examples, see [purchase a package with an invoice](docs/Guides/PurchaseFlow.md)
and [provision a reseller customer](docs/Guides/ResellerProvisioning.md).

## Installation

```bash
composer require proxyrequest/php-sdk:^1.0
```

The SDK requires 64-bit PHP 8.5 or newer. It includes Guzzle as the ready-to-use
HTTP transport.

## Quick start

```php
<?php

require __DIR__.'/vendor/autoload.php';

use ProxyRequest\Client;
use ProxyRequest\Dto\UserCreateRequest;

$client = Client::withApiKey($_ENV['PROXYREQUEST_API_KEY']);

$profile = $client->profile()->get();

$user = $client->users()->create(new UserCreateRequest([
    'username' => 'customer-reference',
    'password' => bin2hex(random_bytes(32)),
]));

echo $user->getId();
```

Static API keys are sent as `Authorization: Static YOUR_API_KEY`. Never expose
them to browser code.

## Common workflows

- [Purchase a package with an invoice](docs/Guides/PurchaseFlow.md) explains
  package selection, coupon previews, checkout, payment confirmation,
  entitlement checks, and credential generation.
- [Provision a reseller customer](docs/Guides/ResellerProvisioning.md) explains
  sub-user creation, direct allocation, root-versus-child accounting, and
  credential generation when your application owns the billing flow.

## Resource API

`Client` exposes one resource object per API group:

```php
$client->authorization();
$client->users();
$client->profile();
$client->orders();
$client->proxies();
$client->analytics();
$client->invoices();
$client->coupons();
$client->rewards();
$client->affiliates();
$client->packages();
$client->locations();
$client->apiKeys();
$client->webhooks();
$client->telegram();
$client->telegramService();
$client->sessions();
$client->settings();
$client->news();
```

All operation parameters and return types are documented in the generated
[API resource reference](docs/Api/) and [DTO model reference](docs/Model/).
IDs are opaque strings and byte amounts use 64-bit integers.

## Pagination

List endpoints return their typed OpenAPI page model. Use `paginate()` when all
pages should be followed lazily:

```php
$users = $client->paginate(
    fn (int $limit, int $offset) => $client->users()->list(
        limit: $limit,
        offset: $offset,
    ),
    limit: 100,
);

foreach ($users as $user) {
    echo $user->getUsername(), PHP_EOL;
}
```

## Errors

HTTP failures throw `ProxyRequest\ApiException`. The original body and headers
remain available, together with normalized helpers:

```php
use ProxyRequest\ApiException;
use ProxyRequest\Exception\ErrorKind;

try {
    $client->profile()->get();
} catch (ApiException $error) {
    if (ErrorKind::Authentication === $error->getErrorKind()) {
        // Replace the invalid API key or token.
    }

    $requestId = $error->getRequestId();
    $fieldErrors = $error->getFieldErrors();
}
```

The SDK does not automatically retry writes or refresh JWTs. Applications may
call `$client->authorization()->refresh(...)` explicitly. A manual access token
can be configured with `Client::withBearerToken()`.

## Configuration and custom deployments

```php
$client = Client::builder()
    ->withApiKey($_ENV['PROXYREQUEST_API_KEY'])
    ->withBaseUri('https://customer-api.example/api/v1')
    ->withLanguage('uk')
    ->withTimeout(20, connectTimeout: 5)
    ->build();
```

An existing `GuzzleHttp\ClientInterface` can be supplied through
`withHttpClient()`. The generated resource layer forces `http_errors=true` so
documented 4xx responses follow the same exception contract with every client.

## Invoice downloads

```php
$pdf = $client->downloadInvoicePdf($invoiceId);
$pdf->saveTo(__DIR__.'/'.$pdf->filename);
```

## Telegram service operations

Account-side Telegram operations use the client's API key. Bot service
operations require the service secret explicitly:

```php
use ProxyRequest\Dto\TelegramSessionRequest;

$session = $client->telegramService()->createSession(
    $_ENV['PROXYREQUEST_TELEGRAM_SECRET'],
    new TelegramSessionRequest([
        'telegramUserId' => 123456789,
        'chatId' => 123456789,
    ]),
);
```

## Webhook verification

Verify the exact raw request body before decoding it:

```php
use ProxyRequest\Webhook\WebhookVerifier;

$payload = WebhookVerifier::decodeVerifiedJson(
    $rawBody,
    $_SERVER['HTTP_X_WEBHOOK_SIGNATURE'] ?? '',
    $_ENV['PROXYREQUEST_WEBHOOK_SECRET'],
    timestampHeader: $_SERVER['HTTP_X_WEBHOOK_TIMESTAMP'] ?? null,
);
```

## Platform documentation

- [Platform documentation](https://proxyrequest.com/docs/): capabilities,
  responsibility boundaries, deployment modes, and starting points.
- [Integration overview](https://proxyrequest.com/docs/integration/overview/):
  control-plane boundary and common API flows.
- [API fundamentals](https://proxyrequest.com/docs/integration/api-fundamentals/)
  and [API resource map](https://proxyrequest.com/docs/integration/api-resource-map/):
  authentication, errors, pagination, and resource relationships.
- [Billing and growth](https://proxyrequest.com/docs/integration/billing-and-growth/):
  invoices, payment links, coupons, and entitlement reconciliation.
- [Reseller workflow](https://proxyrequest.com/docs/integration/reseller-workflow/)
  and [users and data](https://proxyrequest.com/docs/integration/users-and-data/):
  sub-user provisioning and safe byte allocation.
- [Catalog and proxy generation](https://proxyrequest.com/docs/integration/catalog-and-proxies/):
  packages, orders, locations, and credentials.
- [Webhooks](https://proxyrequest.com/docs/integration/webhooks/) and
  [usage accounting](https://proxyrequest.com/docs/proxy/usage-accounting/):
  event handling, root ledgers, child limits, and reconciliation.
- [API Reference](https://proxyrequest.com/docs/api/): exact endpoints,
  request schemas, responses, and examples.

## Development

```bash
composer install
make quality
make generate-check
```

The vendored schema is pinned in `openapi/source.json`. To synchronize a newer
canonical schema, run `make sync-openapi SOURCE=/path/to/openapi.yml`. The sync
command records the upstream Git commit automatically. Then run `make generate`
and review the public API diff.

## License

MIT
