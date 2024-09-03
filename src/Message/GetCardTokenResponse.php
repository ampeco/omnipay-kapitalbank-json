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
            && $this->getToken()
            && isset($this->getOrder()['srcToken']['displayName'])
            && isset($this->getOrder()['srcToken']['card']['expiration']);
    }

    public function getToken(): ?string
    {
        foreach ($this->getOrder()['storedTokens'] as $token) {
            if (isset($token['cofProviderRid'])) {
                continue;
            }

            if (isset($token['id'])) {
                return $token['id'];
            }
        }

        return null;
    }

    public function getMaskedPAN(): string
    {
        return $this->getOrder()['srcToken']['displayName'];
    }

    public function getExpirationDate(): string
    {
        return $this->getOrder()['srcToken']['card']['expiration'];
    }
}
