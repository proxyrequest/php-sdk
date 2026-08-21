# UserCreateRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**email** | **string** | User&#39;s email address. Must be unique if provided. | [optional]
**username** | **string** | Unique username for the account. Must be 4-128 characters. |
**password** | **string** | Account password. Must be 8-128 characters long. |
**firstName** | **string** | User&#39;s first name. | [optional]
**lastName** | **string** | User&#39;s last name. | [optional]
**country** | **string** | User&#39;s country of residence. | [optional]
**state** | **string** | User&#39;s state or province. | [optional]
**city** | **string** | User&#39;s city. | [optional]
**address** | **string** | User&#39;s street address. | [optional]
**zip** | **string** | User&#39;s postal/ZIP code. | [optional]
**blockedDomains** | **string[]** | List of domains to block for this user. | [optional]
**allowedIps** | **string[]** | List of source IP addresses allowed for this user. The maximum list size is configured per deployment. | [optional]
**connectionLimit** | **int** | Maximum number of concurrent connections allowed for the user. | [optional]
**isReseller** | **bool** | Whether the user should have reseller privileges. Only superusers can create resellers. | [optional] [default to false]
**isTopLevel** | **bool** | Whether the user is a sub-user under the parent account. | [optional] [default to false]
**data** | **int** | Initial data allocation for the user (traditional auth mode only). | [optional]
**packageId** | **string** | ProxyRequest package UUID to assign to the user (package-based auth mode only). Headless integrations resolve it from their local product mapping. | [optional]
**meta** | **array<string,mixed>** | Additional metadata for the user. Maximum 50 fields. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
