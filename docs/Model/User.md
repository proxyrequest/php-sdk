# User

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** |  | [readonly]
**username** | **string** | Value must contain only letters, numbers, and underscores. It must not start or end with an underscore. |
**email** | **string** |  |
**isReseller** | **bool** | Reseller can create sub-users and manage their data. | [optional]
**isMarketer** | **bool** | Marketer can manage marketing campaigns and view analytics. | [optional]
**isSuperuser** | **bool** | Designates that this user has all permissions without explicitly assigning them. | [optional]
**dateJoined** | **\DateTime** |  | [readonly]
**dateJoinedTs** | **int** | Timestamp of when the user joined | [readonly]
**firstName** | **string** |  | [optional]
**lastName** | **string** |  | [optional]
**balance** | **int** |  | [optional]
**language** | [**\ProxyRequest\Dto\LanguageEnum**](LanguageEnum.md) |  | [optional]
**country** | **string** |  | [optional]
**state** | **string** |  | [optional]
**city** | **string** |  | [optional]
**address** | **string** |  | [optional]
**zip** | **string** |  | [optional]
**companyName** | **string** |  | [optional]
**companyAddress** | **string** |  | [optional]
**companyCity** | **string** |  | [optional]
**companyPostalCode** | **string** |  | [optional]
**companyCountry** | **string** |  | [optional]
**companyVatNumber** | **string** |  | [optional]
**allowedIps** | **string[]** | List of IP addresses allowed for this user | [readonly]
**blockedDomains** | **string[]** | List of domains blocked for this user | [readonly]
**connectionLimit** | **int** | The maximum number of concurrent connections allowed for this package. | [optional]
**parentId** | **string** | ID of the parent user (for sub-accounts) | [readonly]
**subUsers** | **int** | Number of sub-users managed by this reseller | [readonly]
**referrals** | **int** | Number of users referred by this user | [readonly]
**referralId** | **string** |  | [optional]
**referralCode** | **string** |  | [readonly]
**referralDataEarned** | **int** |  | [readonly]
**referralDataPending** | **int** |  | [readonly]
**referralBalancePending** | **int** |  | [readonly]
**referralBalanceEarned** | **int** |  | [readonly]
**currency** | **array<string,string>** | Currency information for the user&#39;s transactions | [readonly]
**coupons** | **array<string,mixed>[]** | Available coupons for this user | [readonly]
**data** | **int** | Available data allowance for the user | [readonly]
**dataSpent** | **int** | Amount of data consumed by the user | [readonly]
**dataUpdated** | **\DateTime** | Last update timestamp for user&#39;s data | [readonly]
**proxyPassword** | **string** | Proxy authentication password | [readonly]
**proxyPasswordReset** | **\DateTime** | Last proxy password reset timestamp | [readonly]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
