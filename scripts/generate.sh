#!/usr/bin/env bash
set -euo pipefail

SDK_ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
GENERATOR_IMAGE="openapitools/openapi-generator-cli:v7.23.0"

docker run --rm \
  --user "$(id -u):$(id -g)" \
  --volume "${SDK_ROOT}:/local" \
  "${GENERATOR_IMAGE}" generate \
  --input-spec /local/openapi/openapi.yaml \
  --generator-name php \
  --output /local \
  --config /local/openapi/generator.yaml \
  --api-name-suffix Resource \
  --global-property apiTests=false,modelTests=false,apiDocs=true,modelDocs=true

# The stock Guzzle template returns documented 4xx bodies as model unions when
# http_errors is disabled by an injected client. Keep one predictable SDK error
# contract regardless of the consumer's Guzzle defaults.
find "${SDK_ROOT}/src/Resource" -type f -name '*Resource.php' -exec \
  perl -0pi -e 's/\$options = \[\];/\$options = [RequestOptions::HTTP_ERRORS => true];/g' {} +

# Let the client-wide language header apply unless a call explicitly overrides
# it. The generated request builders already omit the header for null values.
find "${SDK_ROOT}/src/Resource" -type f -name '*Resource.php' -exec \
  perl -0pi -e "s/\\\$acceptLanguage = 'en'/\\\$acceptLanguage = null/g" {} +

# Guzzle 8 removed Utils::jsonEncode(); route generated JSON serialization
# through the SDK compatibility helper while retaining Guzzle 7 support.
find "${SDK_ROOT}/src/Resource" -type f -name '*Resource.php' -exec \
  perl -0pi -e 's/\\GuzzleHttp\\Utils::jsonEncode/\\ProxyRequest\\Support\\Json::encode/g' {} +
