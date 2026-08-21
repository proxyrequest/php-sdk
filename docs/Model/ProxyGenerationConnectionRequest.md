# ProxyGenerationConnectionRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**protocol** | [**\ProxyRequest\Dto\ProtocolEnum**](ProtocolEnum.md) | Proxy protocol. * &#x60;http&#x60; - http * &#x60;socks5&#x60; - socks5 * &#x60;auto&#x60; - auto | [optional] [default to ProtocolEnum::HTTP]
**host** | **string** | Gateway host. Leave empty to use the default gateway. | [optional]
**port** | **int** | Gateway port. Leave empty to use the port for the selected protocol. | [optional]
**format** | **string** | Connection string format. | [optional] [default to '{protocol}://{username}:{password}@{host}:{port}']

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
