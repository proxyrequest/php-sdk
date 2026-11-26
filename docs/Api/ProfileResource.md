# ProxyRequest\ProfileResource

Read and update the authenticated account and its security settings.

All URIs are relative to https://api.proxyrequest.com/api/v1, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**changePassword()**](ProfileResource.md#changePassword) | **POST** /profile/change-password | Change the account password |
| [**confirmTwoFactor()**](ProfileResource.md#confirmTwoFactor) | **POST** /profile/2fa/confirm | Manage two-factor authentication |
| [**connectGoogle()**](ProfileResource.md#connectGoogle) | **POST** /profile/social-accounts/google | Connect Google to the signed-in account |
| [**delete()**](ProfileResource.md#delete) | **DELETE** /profile | Delete the current account |
| [**disableTwoFactor()**](ProfileResource.md#disableTwoFactor) | **POST** /profile/2fa/disable | Manage two-factor authentication |
| [**get()**](ProfileResource.md#get) | **GET** /profile | Get the current profile |
| [**getTwoFactorStatus()**](ProfileResource.md#getTwoFactorStatus) | **GET** /profile/2fa/status | Get two-factor authentication status |
| [**listLoginHistory()**](ProfileResource.md#listLoginHistory) | **GET** /profile/login-history | List your recent successful sign-ins |
| [**listSocialAccounts()**](ProfileResource.md#listSocialAccounts) | **GET** /profile/social-accounts | List social account connections |
| [**regenerateTwoFactorCodes()**](ProfileResource.md#regenerateTwoFactorCodes) | **POST** /profile/2fa/regenerate | Manage two-factor authentication |
| [**setupTwoFactor()**](ProfileResource.md#setupTwoFactor) | **POST** /profile/2fa/setup | Manage two-factor authentication |
| [**update()**](ProfileResource.md#update) | **PATCH** /profile | Update the current profile |


## `changePassword()`

```php
changePassword($changePasswordRequest, $acceptLanguage, $xImpersonateUser): \ProxyRequest\Dto\MessageResponse
```

Change the account password

Verifies the current password, applies the new password, and keeps the current authenticated session active.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: StaticAuth
$config = ProxyRequest\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = ProxyRequest\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');

// Configure Bearer (JWT) authorization: BearerAuth
$config = ProxyRequest\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new ProxyRequest\Api\ProfileResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$changePasswordRequest = {"old_password":"Previous-Password-42","new_password1":"New-Secure-Password-43","new_password2":"New-Secure-Password-43"}; // \ProxyRequest\Dto\ChangePasswordRequest
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->changePassword($changePasswordRequest, $acceptLanguage, $xImpersonateUser);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProfileResource->changePassword: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **changePasswordRequest** | [**\ProxyRequest\Dto\ChangePasswordRequest**](../Model/ChangePasswordRequest.md)|  | |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

### Return type

[**\ProxyRequest\Dto\MessageResponse**](../Model/MessageResponse.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: `application/json`, `application/x-www-form-urlencoded`, `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `confirmTwoFactor()`

```php
confirmTwoFactor($twoFactorConfirmRequest, $acceptLanguage, $xImpersonateUser): \ProxyRequest\Dto\EnabledResponse
```

Manage two-factor authentication

Prepare or confirm an authenticator, disable it, or replace recovery codes. Changes revoke previous authentication proofs. Setup returns an SVG QR code and recovery codes are returned once.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: StaticAuth
$config = ProxyRequest\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = ProxyRequest\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');

// Configure Bearer (JWT) authorization: BearerAuth
$config = ProxyRequest\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new ProxyRequest\Api\ProfileResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$twoFactorConfirmRequest = {"password":"Correct-Horse-Battery-Staple-42","credential":"credential","code":"us","confirmed":true}; // \ProxyRequest\Dto\TwoFactorConfirmRequest
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->confirmTwoFactor($twoFactorConfirmRequest, $acceptLanguage, $xImpersonateUser);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProfileResource->confirmTwoFactor: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **twoFactorConfirmRequest** | [**\ProxyRequest\Dto\TwoFactorConfirmRequest**](../Model/TwoFactorConfirmRequest.md)|  | |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

### Return type

[**\ProxyRequest\Dto\EnabledResponse**](../Model/EnabledResponse.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: `application/json`, `application/x-www-form-urlencoded`, `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `connectGoogle()`

```php
connectGoogle($googleConnectRequestRequest, $acceptLanguage, $xImpersonateUser): \ProxyRequest\Dto\SocialAccountState[]
```

Connect Google to the signed-in account

Connect a verified Google identity to the signed-in account after confirming its password.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: BearerAuth
$config = ProxyRequest\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new ProxyRequest\Api\ProfileResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$googleConnectRequestRequest = {"credential":"credential","password":"Correct-Horse-Battery-Staple-42"}; // \ProxyRequest\Dto\GoogleConnectRequestRequest
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->connectGoogle($googleConnectRequestRequest, $acceptLanguage, $xImpersonateUser);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProfileResource->connectGoogle: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **googleConnectRequestRequest** | [**\ProxyRequest\Dto\GoogleConnectRequestRequest**](../Model/GoogleConnectRequestRequest.md)|  | |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

### Return type

[**\ProxyRequest\Dto\SocialAccountState[]**](../Model/SocialAccountState.md)

### Authorization

[BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: `application/json`, `application/x-www-form-urlencoded`, `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `delete()`

```php
delete($ifMatch, $acceptLanguage, $xImpersonateUser): \ProxyRequest\Dto\UsageClosureResponse
```

Delete the current account

Permanently deletes the authenticated customer account. Superusers and reseller sub-accounts cannot delete themselves with this operation. An account with outstanding proxy accounting returns 202 and is disabled immediately.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: StaticAuth
$config = ProxyRequest\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = ProxyRequest\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');

// Configure Bearer (JWT) authorization: BearerAuth
$config = ProxyRequest\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new ProxyRequest\Api\ProfileResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$ifMatch = 'ifMatch_example'; // string | Strong ETag from the latest representation of this resource.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->delete($ifMatch, $acceptLanguage, $xImpersonateUser);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProfileResource->delete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **ifMatch** | **string**| Strong ETag from the latest representation of this resource. | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

### Return type

[**\ProxyRequest\Dto\UsageClosureResponse**](../Model/UsageClosureResponse.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `disableTwoFactor()`

```php
disableTwoFactor($twoFactorDisableRequest, $acceptLanguage, $xImpersonateUser): \ProxyRequest\Dto\EnabledResponse
```

Manage two-factor authentication

Prepare or confirm an authenticator, disable it, or replace recovery codes. Changes revoke previous authentication proofs. Setup returns an SVG QR code and recovery codes are returned once.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: StaticAuth
$config = ProxyRequest\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = ProxyRequest\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');

// Configure Bearer (JWT) authorization: BearerAuth
$config = ProxyRequest\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new ProxyRequest\Api\ProfileResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$twoFactorDisableRequest = {"password":"Correct-Horse-Battery-Staple-42","credential":"credential","code":"us","confirmed":true}; // \ProxyRequest\Dto\TwoFactorDisableRequest
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->disableTwoFactor($twoFactorDisableRequest, $acceptLanguage, $xImpersonateUser);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProfileResource->disableTwoFactor: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **twoFactorDisableRequest** | [**\ProxyRequest\Dto\TwoFactorDisableRequest**](../Model/TwoFactorDisableRequest.md)|  | |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

### Return type

[**\ProxyRequest\Dto\EnabledResponse**](../Model/EnabledResponse.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: `application/json`, `application/x-www-form-urlencoded`, `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `get()`

```php
get($acceptLanguage, $xImpersonateUser): \ProxyRequest\Dto\User
```

Get the current profile

Returns the authenticated account, including contact details and the security state needed by account settings screens.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: StaticAuth
$config = ProxyRequest\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = ProxyRequest\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');

// Configure Bearer (JWT) authorization: BearerAuth
$config = ProxyRequest\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new ProxyRequest\Api\ProfileResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->get($acceptLanguage, $xImpersonateUser);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProfileResource->get: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

### Return type

[**\ProxyRequest\Dto\User**](../Model/User.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getTwoFactorStatus()`

```php
getTwoFactorStatus($acceptLanguage, $xImpersonateUser): \ProxyRequest\Dto\EnabledResponse
```

Get two-factor authentication status

Return the current factor state, primary-factor availability and remaining recovery-code count.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: StaticAuth
$config = ProxyRequest\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = ProxyRequest\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');

// Configure Bearer (JWT) authorization: BearerAuth
$config = ProxyRequest\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new ProxyRequest\Api\ProfileResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->getTwoFactorStatus($acceptLanguage, $xImpersonateUser);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProfileResource->getTwoFactorStatus: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

### Return type

[**\ProxyRequest\Dto\EnabledResponse**](../Model/EnabledResponse.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listLoginHistory()`

```php
listLoginHistory($limit, $offset, $acceptLanguage, $xImpersonateUser): \ProxyRequest\Dto\PaginatedLoginHistoryList
```

List your recent successful sign-ins

Returns only the authenticated user's latest personal sign-ins, newest first. At most 50 records are retained per account. Refreshes, API key requests, failed attempts and impersonation are excluded. Client metadata is descriptive, not proof of identity; location is present only when supplied by trusted Cloudflare edges.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: StaticAuth
$config = ProxyRequest\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = ProxyRequest\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');

// Configure Bearer (JWT) authorization: BearerAuth
$config = ProxyRequest\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new ProxyRequest\Api\ProfileResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$limit = 56; // int | Number of results to return per page.
$offset = 56; // int | The initial index from which to return the results.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->listLoginHistory($limit, $offset, $acceptLanguage, $xImpersonateUser);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProfileResource->listLoginHistory: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **limit** | **int**| Number of results to return per page. | [optional] |
| **offset** | **int**| The initial index from which to return the results. | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

### Return type

[**\ProxyRequest\Dto\PaginatedLoginHistoryList**](../Model/PaginatedLoginHistoryList.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listSocialAccounts()`

```php
listSocialAccounts($acceptLanguage, $xImpersonateUser): \ProxyRequest\Dto\SocialAccountState[]
```

List social account connections

Returns social sign-in connections and unlink restrictions for the signed-in account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: BearerAuth
$config = ProxyRequest\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new ProxyRequest\Api\ProfileResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->listSocialAccounts($acceptLanguage, $xImpersonateUser);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProfileResource->listSocialAccounts: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

### Return type

[**\ProxyRequest\Dto\SocialAccountState[]**](../Model/SocialAccountState.md)

### Authorization

[BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `regenerateTwoFactorCodes()`

```php
regenerateTwoFactorCodes($acceptLanguage, $xImpersonateUser, $mFAActionRequest): \ProxyRequest\Dto\MFAResponse
```

Manage two-factor authentication

Prepare or confirm an authenticator, disable it, or replace recovery codes. Changes revoke previous authentication proofs. Setup returns an SVG QR code and recovery codes are returned once.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: StaticAuth
$config = ProxyRequest\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = ProxyRequest\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');

// Configure Bearer (JWT) authorization: BearerAuth
$config = ProxyRequest\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new ProxyRequest\Api\ProfileResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.
$mFAActionRequest = {"password":"Correct-Horse-Battery-Staple-42","credential":"credential","code":"us","confirmed":true}; // \ProxyRequest\Dto\MFAActionRequest

try {
    $result = $apiInstance->regenerateTwoFactorCodes($acceptLanguage, $xImpersonateUser, $mFAActionRequest);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProfileResource->regenerateTwoFactorCodes: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |
| **mFAActionRequest** | [**\ProxyRequest\Dto\MFAActionRequest**](../Model/MFAActionRequest.md)|  | [optional] |

### Return type

[**\ProxyRequest\Dto\MFAResponse**](../Model/MFAResponse.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: `application/json`, `application/x-www-form-urlencoded`, `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `setupTwoFactor()`

```php
setupTwoFactor($twoFactorSetupRequestRequest, $acceptLanguage, $xImpersonateUser): \ProxyRequest\Dto\TwoFactorSetupResponse
```

Manage two-factor authentication

Prepare or confirm an authenticator, disable it, or replace recovery codes. Changes revoke previous authentication proofs. Setup returns an SVG QR code and recovery codes are returned once.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: StaticAuth
$config = ProxyRequest\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = ProxyRequest\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');

// Configure Bearer (JWT) authorization: BearerAuth
$config = ProxyRequest\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new ProxyRequest\Api\ProfileResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$twoFactorSetupRequestRequest = {"password":"Correct-Horse-Battery-Staple-42","credential":"credential","code":"us","confirmed":true}; // \ProxyRequest\Dto\TwoFactorSetupRequestRequest
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.

try {
    $result = $apiInstance->setupTwoFactor($twoFactorSetupRequestRequest, $acceptLanguage, $xImpersonateUser);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProfileResource->setupTwoFactor: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **twoFactorSetupRequestRequest** | [**\ProxyRequest\Dto\TwoFactorSetupRequestRequest**](../Model/TwoFactorSetupRequestRequest.md)|  | |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |

### Return type

[**\ProxyRequest\Dto\TwoFactorSetupResponse**](../Model/TwoFactorSetupResponse.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: `application/json`, `application/x-www-form-urlencoded`, `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `update()`

```php
update($ifMatch, $acceptLanguage, $xImpersonateUser, $patchedProfileUpdateRequest): \ProxyRequest\Dto\User
```

Update the current profile

Updates the supplied profile fields and returns the latest account state. Fields omitted from the request are left unchanged.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: StaticAuth
$config = ProxyRequest\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = ProxyRequest\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');

// Configure Bearer (JWT) authorization: BearerAuth
$config = ProxyRequest\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new ProxyRequest\Api\ProfileResource(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$ifMatch = 'ifMatch_example'; // string | Strong ETag from the latest representation of this resource.
$acceptLanguage = de; // string | Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English.
$xImpersonateUser = 'xImpersonateUser_example'; // string | Act as this reseller for this request only. Requires a superuser Static API key.
$patchedProfileUpdateRequest = {"first_name":"Dana","last_name":"Morgan"}; // \ProxyRequest\Dto\PatchedProfileUpdateRequest

try {
    $result = $apiInstance->update($ifMatch, $acceptLanguage, $xImpersonateUser, $patchedProfileUpdateRequest);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProfileResource->update: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **ifMatch** | **string**| Strong ETag from the latest representation of this resource. | [optional] |
| **acceptLanguage** | **string**| Preferred language for human-readable API errors. Supported languages: en, ru, uk, de, it, fr, es. Regional language tags and quality weights are accepted; unsupported or omitted values use English. | [optional] [default to &#39;en&#39;] |
| **xImpersonateUser** | **string**| Act as this reseller for this request only. Requires a superuser Static API key. | [optional] |
| **patchedProfileUpdateRequest** | [**\ProxyRequest\Dto\PatchedProfileUpdateRequest**](../Model/PatchedProfileUpdateRequest.md)|  | [optional] |

### Return type

[**\ProxyRequest\Dto\User**](../Model/User.md)

### Authorization

[StaticAuth](../../README.md#StaticAuth), [BearerAuth](../../README.md#BearerAuth)

### HTTP request headers

- **Content-Type**: `application/json`, `application/x-www-form-urlencoded`, `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
