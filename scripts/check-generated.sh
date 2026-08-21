#!/usr/bin/env bash

set -euo pipefail

sdk_root="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
before_manifest="$(mktemp)"
after_manifest="$(mktemp)"

cleanup() {
    rm -f "$before_manifest" "$after_manifest"
}
trap cleanup EXIT

snapshot() {
    local destination="$1"

    {
        find \
            "$sdk_root/src/Resource" \
            "$sdk_root/src/Dto" \
            "$sdk_root/docs" \
            "$sdk_root/.openapi-generator" \
            -type f -print0
        printf '%s\0' \
            "$sdk_root/src/Configuration.php" \
            "$sdk_root/src/FormDataProcessor.php" \
            "$sdk_root/src/HeaderSelector.php" \
            "$sdk_root/src/ObjectSerializer.php"
    } | LC_ALL=C sort -z \
        | xargs -0 sha256sum \
        | sed "s#  $sdk_root/#  #" > "$destination"
}

snapshot "$before_manifest"
"$sdk_root/scripts/generate.sh"
snapshot "$after_manifest"

if ! diff -u "$before_manifest" "$after_manifest"; then
    printf 'Generated SDK files are out of date. Run scripts/generate.sh and commit the result.\n' >&2
    exit 1
fi

printf 'Generated SDK files match the pinned OpenAPI schema.\n'
