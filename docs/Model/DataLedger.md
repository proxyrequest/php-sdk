# DataLedger

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** |  | [readonly]
**data** | **int** | Total data allocated to this ledger entry in bytes. 1073741824 &#x3D; 1 GiB 10737418240 &#x3D; 10 GiB | [readonly]
**dataRemaining** | **int** | Bytes still available for consumption from this ledger entry. Decremented in FIFO order as the customer uses the proxy. When this reaches zero the entry is exhausted. | [readonly]
**expires** | **\DateTime** | Date and time when this ledger entry expires and any remaining data is forfeited. Leave blank for entries that do not expire. | [readonly]
**updated** | **\DateTime** |  | [readonly]
**created** | **\DateTime** |  | [readonly]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
