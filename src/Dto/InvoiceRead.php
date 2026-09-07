<?php

namespace ProxyRequest\Dto;

/** Generated invoice read union; implemented by Invoice and InvoiceShort. */
interface InvoiceRead extends ModelInterface, \ArrayAccess, \JsonSerializable
{
    public function getModelName();
    public function getId();
    public function getCountry();
    public function getCoupon();
    public function getUpdated();
    public function getCreated();
    public function getIsOneTime();
    public function getIsPayout();
    public function getInternalId();
    public function getStatus();
    public function getDescription();
    public function getConnectionLimit();
    public function getData();
    public function getBalance();
    public function getPriceTotal();
    public function getGateway();
    public function getCurrency();
    public function getProviderCheckoutId();
    public function getProviderPaymentId();
    public function getCheckoutStatus();
    public function getVat();
    public function getCompanyName();
    public function getCompanyAddress();
    public function getCompanyCity();
    public function getCompanyPostalCode();
    public function getCompanyRegistrationNumber();
    public function getCompanyVatNumber();
    public function getPaid();
}
