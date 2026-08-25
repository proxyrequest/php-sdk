# Changelog

All notable changes follow [Keep a Changelog](https://keepachangelog.com/) and
the package uses [Semantic Versioning](https://semver.org/).

## [Unreleased]

### Changed

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
