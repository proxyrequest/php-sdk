# GenerateProxyRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**packageId** | **string** | ProxyRequest package UUID used to generate credentials. Headless integrations must resolve this from their local product mapping. |
**userId** | **string** | ProxyRequest sub-user UUID that will use the generated credentials. Resolve it from your local customer mapping. Must be the caller&#39;s own sub-user, even for superusers. Omit to generate for the authenticated account. For an independent top-level customer, authenticate as that customer rather than sending its ID with a global key. | [optional]
**quantity** | **int** | Number of proxies to generate |
**targeting** | [**\ProxyRequest\Dto\ProxyGenerationTargetingRequest**](ProxyGenerationTargetingRequest.md) |  | [optional]
**connection** | [**\ProxyRequest\Dto\ProxyGenerationConnectionRequest**](ProxyGenerationConnectionRequest.md) |  | [optional]
**session** | [**\ProxyRequest\Dto\ProxyGenerationSessionRequest**](ProxyGenerationSessionRequest.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
