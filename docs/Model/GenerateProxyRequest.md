# GenerateProxyRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**packageId** | **string** | ProxyRequest package UUID used to generate credentials. Headless integrations must resolve this from their local product mapping. |
**userId** | **string** | ProxyRequest sub-user UUID that will use the generated credentials. Headless integrations must resolve this from their local customer mapping. | [optional]
**quantity** | **int** | Number of proxies to generate |
**targeting** | [**\ProxyRequest\Dto\ProxyGenerationTargetingRequest**](ProxyGenerationTargetingRequest.md) |  | [optional]
**connection** | [**\ProxyRequest\Dto\ProxyGenerationConnectionRequest**](ProxyGenerationConnectionRequest.md) |  | [optional]
**session** | [**\ProxyRequest\Dto\ProxyGenerationSessionRequest**](ProxyGenerationSessionRequest.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
