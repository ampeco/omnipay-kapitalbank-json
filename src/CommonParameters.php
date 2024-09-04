<?php

namespace Ampeco\OmnipayKapitalbankJson;

trait CommonParameters
{
    public function setMerchantUsername($value): void
    {
        $this->setParameter('merchantUsername', $value);
    }

    public function getMerchantUsername(): string
    {
        return $this->getParameter('merchantUsername');
    }

    public function setMerchantPassword($value): void
    {
        $this->setParameter('merchantPassword', $value);
    }

    public function getMerchantPassword(): string
    {
        return $this->getParameter('merchantPassword');
    }

    public function getLanguage(): string
    {
        return $this->getParameter('language');
    }

    public function setLanguage($value): void
    {
        $this->setParameter('language', $value);
    }

    public function getHppRedirectUrl(): string
    {
        return $this->getParameter('hppRedirectUrl');
    }

    public function setHppRedirectUrl($value): void
    {
        $this->setParameter('hppRedirectUrl', $value);
    }

    public function getOrderId(): string
    {
        return $this->getParameter('orderId');
    }

    public function setOrderId($value): void
    {
        $this->setParameter('orderId', $value);
    }

    public function getPassword(): string
    {
        return $this->getParameter('password');
    }

    public function setPassword($value): void
    {
        $this->setParameter('password', $value);
    }

    public function getOrderType(): string
    {
        return $this->getParameter('orderType');
    }

    public function setOrderType($value): void
    {
        $this->setParameter('orderType', $value);
    }

    public function getPhase(): string
    {
        return $this->getParameter('phase');
    }

    public function setPhase($value): void
    {
        $this->setParameter('phase', $value);
    }

    public function getPurpose(): string
    {
        return $this->getParameter('purpose');
    }

    public function setPurpose($value): void
    {
        $this->setParameter('purpose', $value);
    }
}
