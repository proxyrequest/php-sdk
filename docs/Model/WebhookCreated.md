# WebhookCreated

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** |  | [optional]
**type** | [**\ProxyRequest\Dto\WebhookScopeEnum**](WebhookScopeEnum.md) | Context in which this webhook operates. Determines which events are delivered. User events scoped to the associated user account Reseller events scoped to the reseller and their sub-accounts System platform-wide system events * &#x60;user&#x60; - User * &#x60;reseller&#x60; - Reseller * &#x60;system&#x60; - System | [optional]
**endpoint** | **string** | HTTPS URL that receives webhook POST requests when events are triggered. https://example.com/webhooks/proxy The endpoint must be publicly accessible and respond within the configured read timeout. |
**secret** | **string** | Secret used to sign each webhook payload. The receiving endpoint should verify the signature to confirm the request originated from this platform. Auto-generated if left blank. Store this value securely on the receiving end. | [optional]
**readTimeout** | **int** | Maximum time to wait for the endpoint to return a response. Requests that exceed this limit are treated as failed and may be retried. | [optional]
**writeTimeout** | **int** | Maximum time to wait while sending the payload to the endpoint. Requests that exceed this limit are treated as failed and may be retried. | [optional]
**retries** | **int** | Number of additional delivery attempts after an initial failure. Set to 0 to disable retries. 3 → up to 4 total delivery attempts | [optional]
**retryTimeout** | **int** | How long to wait before each retry attempt after a failed delivery. 10 → retry after 10 seconds | [optional]
**created** | **\DateTime** |  | [readonly]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
