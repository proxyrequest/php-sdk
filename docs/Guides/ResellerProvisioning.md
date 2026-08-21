# Provision a reseller customer

Use this flow when your application is authoritative for customer identity and
billing, while ProxyRequest enforces proxy access, byte accounting, routing,
and reporting. The authenticated reseller must already own an eligible root
order for the package being assigned.

```text
Your customer + billing record
        -> ProxyRequest sub-user + child allocation
        -> generated proxy credentials
        -> webhooks + analytics reconciliation
```

This is direct provisioning, not a purchase. Use the
[invoice purchase flow](PurchaseFlow.md) when ProxyRequest should create the
commercial record and payment flow for a package.

## Root entitlement and child allocation

A root order owns the physical data ledgers. A reseller-created child order
carries one managed customer's personal consumption limit while traffic still
uses the shared root ledger. Adding 10 GiB to a child does not reserve or move
10 GiB out of the root ledger, so the sum of child limits can exceed the
remaining shared pool. Monitor both values before promising capacity.

All allocation amounts are integer bytes. Keep the unit conversion in one
place in your own billing system.

## Create and provision a sub-user

The public user contract requires a unique username and an account password. A
headless integration can generate opaque values server-side and omit email.
When assigning a package during user creation, pass `packageId` and `data`
together; pass neither when creating identity only.

```php
<?php

require __DIR__.'/vendor/autoload.php';

use ProxyRequest\Client;
use ProxyRequest\Dto\GenerateProxyRequest;
use ProxyRequest\Dto\UserCreateRequest;

$client = Client::withApiKey($_ENV['PROXYREQUEST_API_KEY']);
$allocationBytes = 10 * 1024 ** 3;

$packagePage = $client->packages()->list(limit: 100);
$package = $packagePage->getResults()[0]
    ?? throw new RuntimeException('No eligible package is available.');
$packageId = $package->getId()
    ?? throw new RuntimeException('The selected package has no ID.');

$user = $client->users()->create(new UserCreateRequest([
    'username' => 'customer-01842',
    'password' => bin2hex(random_bytes(32)),
    'packageId' => $packageId,
    'data' => $allocationBytes,
    'meta' => [
        'customerReference' => 'crm-01842',
    ],
]));

$userId = $user->getId();
// Persist the immutable local customer -> ProxyRequest user mapping now.

$result = $client->proxies()->generate(new GenerateProxyRequest([
    'packageId' => $packageId,
    'userId' => $userId,
    'quantity' => 1,
]));

foreach ($result->getProxies() as $proxy) {
    printf("Proxy: %s\n", $proxy->getConnectionString());
}
```

The optional `meta` object is suitable for non-sensitive correlation data, but
it does not replace an explicit mapping in your database. Treat both the user
password and generated proxy credentials as secrets.

## Add data to an existing child order

Use `addData()` when an existing managed user receives an additional allowance
for a package. Record the intended pre-operation state before sending the
request.

```php
<?php

require __DIR__.'/vendor/autoload.php';

use ProxyRequest\Client;
use ProxyRequest\Dto\AddDataRequest;

$client = Client::withApiKey($_ENV['PROXYREQUEST_API_KEY']);

$userId = 'replace-with-the-mapped-user-id';
$packageId = 'replace-with-the-mapped-package-id';
$additionalBytes = 5 * 1024 ** 3;

$updatedOrder = $client->users()->addData(
    $userId,
    new AddDataRequest([
        'packageId' => $packageId,
        'data' => $additionalBytes,
    ]),
);

printf("Updated order: %s\n", $updatedOrder->getId());
```

Subtraction is a financial action as well as an access-control change. Give it
separate authorization, store the business reason, and verify the resulting
state before reporting success.

## Make provisioning recoverable

Persist these mappings and events as soon as each step succeeds:

| Local record | ProxyRequest record |
| --- | --- |
| Customer ID | User ID |
| Product/SKU | Package ID |
| Entitlement | Order ID and allocation state |
| Billing or provisioning operation | Request context, byte amount, result, and timestamp |

Generate an internal operation ID before the first write. If a user creation or
allocation request has an ambiguous timeout, read the affected user and order
state before retrying; repeating an uncertain data-add can grant the same
allowance twice. Signed webhooks are useful for prompt updates, but reconcile
them with durable order state and analytics rather than treating delivery as
the only source of truth.

## Related documentation

- [Platform integration overview](https://proxyrequest.com/docs/integration/overview/)
- [Reseller workflow](https://proxyrequest.com/docs/integration/reseller-workflow/)
- [Users and data lifecycle](https://proxyrequest.com/docs/integration/users-and-data/)
- [Catalog, locations, and proxy generation](https://proxyrequest.com/docs/integration/catalog-and-proxies/)
- [Usage accounting](https://proxyrequest.com/docs/proxy/usage-accounting/)
- [Webhooks](https://proxyrequest.com/docs/integration/webhooks/)
- [List packages](https://proxyrequest.com/docs/api/operations/packages_list/)
- [Create a sub-user](https://proxyrequest.com/docs/api/operations/users_create/)
- [Add data to a sub-user](https://proxyrequest.com/docs/api/operations/users_data_add_create/)
- [Generate proxy credentials](https://proxyrequest.com/docs/api/operations/proxies_generate_create/)
- SDK references: [Users](../Api/UsersResource.md),
  [UserCreateRequest](../Model/UserCreateRequest.md),
  [AddDataRequest](../Model/AddDataRequest.md), and
  [GenerateProxyRequest](../Model/GenerateProxyRequest.md)

[Back to the SDK README](../../README.md)
