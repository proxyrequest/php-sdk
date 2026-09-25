# ProviderDataBalance

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**checkpointId** | **string** |  |
**providerId** | **string** |  |
**providerName** | **string** |  |
**observedAt** | **\DateTime** | Time the available balance was observed. |
**availableBytes** | **string** | Observed balance in bytes, as a decimal string. |
**usedBytes** | **string** | Calculated usage since the observation, in bytes. |
**remainingBytes** | **string** | Remaining bytes at calculated_at, as a decimal string. |
**remainingPercent** | **float** |  |
**severity** | **string** |  |
**freshness** | [**\ProxyRequest\Dto\FreshnessEnum**](FreshnessEnum.md) |  |
**error** | **string** |  |
**calculatedAt** | **\DateTime** | Time of the last successful calculation. |
**history** | [**\ProxyRequest\Dto\ProviderBalanceCheckpoint[]**](ProviderBalanceCheckpoint.md) | Latest entries by creation time, limited by PROVIDER_DATA_BALANCE_HISTORY_LIMIT (default 10). |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
