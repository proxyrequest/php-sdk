# PatchedUserUpdateRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**email** | **string** | User&#39;s email address. Must be unique across the system. | [optional]
**firstName** | **string** | User&#39;s first name. | [optional]
**lastName** | **string** | User&#39;s last name. | [optional]
**country** | **string** | User&#39;s country of residence. | [optional]
**state** | **string** | User&#39;s state or province. | [optional]
**city** | **string** | User&#39;s city. | [optional]
**address** | **string** | User&#39;s street address. | [optional]
**zip** | **string** | User&#39;s postal/ZIP code. | [optional]
**companyName** | **string** | Name of the user&#39;s company. | [optional]
**companyCountry** | **string** | Country where the company is located. | [optional]
**companyCity** | **string** | City where the company is located. | [optional]
**companyAddress** | **string** | Company&#39;s street address. | [optional]
**companyPostalCode** | **string** | Company&#39;s postal code. | [optional]
**companyVatNumber** | **string** | Company&#39;s VAT number. | [optional]
**isReseller** | **bool** | Whether the user has reseller privileges. Only superusers can modify. | [optional]
**blockedDomains** | **string[]** | List of domains to block for this user. | [optional]
**allowedIps** | **string[]** | List of source IP addresses allowed for this user. The maximum list size is configured per deployment. | [optional]
**connectionLimit** | **int** | Maximum number of concurrent connections allowed for the user. | [optional]
**newPassword** | **string** | New password for the user. Must be 8-128 characters long. | [optional]
**meta** | **array<string,mixed>** | Additional metadata for the user. Maximum 50 fields. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
