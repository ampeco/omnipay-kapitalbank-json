<?php

namespace Ampeco\OmnipayKapitalbankJson\Message;

class SetSourceTokenResponse extends Response
{
    public function isSuccessful(): bool
    {
        return parent::isSuccessful()
            && $this->getOrder()
            && isset($this->getOrder()['status'])
            && $this->getOrder()['status'] === Response::STATUS_PREPARING
            && isset($this->getOrder()['srcToken'])
            && count($this->getOrder()['srcToken']) > 0
            && isset($this->getOrder()['srcToken']['id']);
    }
}
