# Analytics compatibility

The SDK accepts all documented reporting-window formats for `start` and `end`:
ISO 8601 with or without an offset, `YYYY-MM-DD HH:MM:SS`, `DD-MM-YYYY HH:MM:SS`,
`YYYY-MM-DD`, `DD-MM-YYYY`, and Unix timestamps in **seconds**, including fractions.
Strings pass through unchanged; numeric timestamps are also accepted. Milliseconds
are not converted automatically. Omitted parameters retain the server defaults.

The server interprets offset-free date strings in the requested timezone, converts
explicit offsets, and truncates reporting boundaries to the minute. Date-only
values start at midnight. Missing, empty or unknown timezone names use the server's
deployment timezone (UTC by default). Prefer explicit ISO offsets when timezone
interpretation matters. Response date fields keep their existing types.

The `hostname` filter on feed and domains accepts a comma-separated mixture of
domains, IPv4/IPv6 addresses and HTTP(S) URLs. Normalization belongs to the server;
the SDK preserves the supplied string. Bracket IPv6 addresses when adding a port.
`include_sub_users` is a boolean on domains and overall. The legacy logs `hostname`
argument remains available for source compatibility, but the server ignores it.

Domain records contain `hostname`, `requests` and `data`; the SDK does not add a
`timestamp` or a page `count`. Feed timestamps can legitimately be null.

## Feed identifiers

Version 3 returns every `FeedRecord.id` as a decimal **string**, including small
IDs. The API still sends JSON integers. The SDK decodes large integers before
PHP can convert them to floating point, then normalizes the ID to a string.
This prevents UInt64 overflow warnings from becoming Laravel exceptions.

When upgrading from 2.x, update integer type declarations and strict comparisons
for feed IDs, and store them as strings. Do not cast them back to `int` or `float`.
Other numeric fields retain their existing types. Both sync and async methods,
response metadata methods and pagination use the same decoder.

```php
$page = $client->analytics()->listFeed(
    start: 1782864000.5,
    end: '2026-07-02T00:00:00Z',
    timezone: 'Europe/Kiev',
);
$id = $page->getResults()[0]->getId(); // string, e.g. '11786186255824559223'
```

Existing `DateTime` inputs still work; `DateTimeImmutable` is supported as well.
Custom `ObjectSerializer::setDateTimeFormat()` settings continue to apply to
objects. Strings are never reformatted.
