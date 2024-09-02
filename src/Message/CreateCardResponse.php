<?php

namespace Ampeco\OmnipayKapitalbankJson\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

class CreateCardResponse extends Response implements RedirectResponseInterface
{
    public function isSuccessful() : bool
    {
        return parent::isSuccessful()
            && $this->getOrder()
            && isset($this->getOrder()['id'])
            && isset($this->getOrder()['hppUrl'])
            && isset($this->getOrder()['password']);
    }

    public function isRedirect(): bool
    {
        return true;
    }

    public function getRedirectMethod(): string
    {
        return 'GET';
    }

    public function getRedirectUrl(): string
    {
        return sprintf(
            "%s?orderId=%s&password=%s",
            $this->getHppUrl(),
            $this->getId(),
            $this->getPassword()
        );
    }

    public function getTransactionReference(): string
    {
        return $this->getId();
    }

    private function getHppUrl(): string
    {
        return $this->data['order']['hppUrl'];
    }

    private function getId(): string
    {
        return $this->data['order']['id'];
    }

    private function getPassword(): string
    {
        return $this->data['order']['password'];
    }
}
