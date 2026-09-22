# Changelog

All notable changes follow [Keep a Changelog](https://keepachangelog.com/) and
the package uses [Semantic Versioning](https://semver.org/).

## [Unreleased]

## [4.0.0] - 2026-09-22

- **Breaking:** deserialize nested response objects into the concrete DTOs used by the API contract.
- Type order packages as `PackageShort`, order ledgers as `DataLedger[]`, coupon packages and stats as `PackageShort[]` and `CouponStats`, and user coupons and currency as `CouponShort[]` and `UserCurrency`.
- Regenerate the SDK Reference from backend contract commit `a2d7245`, including expandable nested model fields.
- Start the synchronized JavaScript, Python, and PHP SDK release train at version 4.0.0.

## [3.0.0] - 2026-09-21

- Keep the client version and User-Agent synchronized with the package release.
- Install dependencies before the generated-contract CI check.

- Synchronize the public OpenAPI contract from backend commit `2c4505a`.
- Accept Unix seconds and all documented date strings while preserving existing date inputs.
- Keep the legacy logs hostname argument and existing response contracts.
- Cover feed/domains pagination, nullable feed timestamps, and UInt64 IDs with regression tests.
- **Breaking:** return every feed ID as an exact decimal string; see [migration notes](docs/analytics.md).
- Serialize analytics include_sub_users booleans as documented true/false values.

## [2.1.0] - 2026-09-17

- Add atomic per-package data reset with typed requests, response metadata, and idempotent retries.
- Refresh the public API contract and document root balances versus child allocations.

## [2.0.0] - 2026-09-16

### Changed

- Replace the incorrect webhook verifier with the actual `X-Signature`
  Base64 HMAC-SHA256 format over exact raw bytes.

- Regenerated from the public backend contract (81 operations, 130 schemas),
  excluding the two disabled sessions-management operations from the SDK.
- Added the optional `pending`/`paid` status to invoice creation requests.
- Corrected OTP login response selection, MFA bodies, nullable and variant models,
  payment fields, and forward-compatible payment gateway values.
- Unified sync/async HTTP and JSON error handling, retaining raw response metadata,
  original exceptions, and actual idempotency keys.
- Preserved unknown DTO properties and fixed default/per-request language precedence.
- Replaced fixed contract-size gates and added backend-serializer regression fixtures.

- Expanded the README with the ProxyRequest platform model and added practical
  invoice-purchase and reseller-provisioning guides.

### Added

- Automatic and explicit idempotency keys with bounded ambiguous-outcome retries.
- Response metadata variants and explicit ETag/`If-Match` optimistic concurrency support.

## [1.0.0] - 2026-08-21

### Added

- Complete typed coverage of the 82-operation ProxyRequest public API.
- Static API-key, manual Bearer token, and Telegram service authentication.
- Pagination, invoice download, normalized API errors, and webhook signature verification.
- Reproducible OpenAPI generation and PHP 8.5 quality gates.
