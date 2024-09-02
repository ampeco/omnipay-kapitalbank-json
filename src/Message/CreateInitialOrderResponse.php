<?php

namespace Ampeco\OmnipayKapitalbankJson\Message;

class CreateInitialOrderResponse extends Response
{
    public function isSuccessful() : bool
    {
        return parent::isSuccessful()
            && $this->getOrder()
            && isset($this->getOrder()['id'])
            && isset($this->getOrder()['password']);
    }

    public function getId(): string
    {
        return $this->getOrder()['id'];
    }

    public function getPassword(): string
    {
        return $this->getOrder()['password'];
    }
}
