<?php

namespace Ampeco\OmnipayKapitalbankJson\Message;

class GetCardTokenResponse extends Response
{
    public function isSuccessful() : bool
    {
        return parent::isSuccessful()
            && $this->getOrder()
            && isset($this->getOrder()['status'])
            && $this->getOrder()['status'] === Response::STATUS_FULLY_PAID
            && isset($this->getOrder()['storedTokens'])
            && count($this->getOrder()['storedTokens']) > 0
            && isset($this->getOrder()['storedTokens'][0]['id'])
            && isset($this->getOrder()['srcToken']['displayName'])
            && isset($this->getOrder()['srcToken']['card']['expiration']);
    }

    public function getToken(): string
    {
        return $this->data['order']['storedTokens'][0]['id'];
    }

    public function getMaskedPAN(): string
    {
        return $this->data['order']['srcToken']['displayName'];
    }

    public function getExpirationDate(): string
    {
        return $this->data['order']['srcToken']['card']['expiration'];
    }
}
