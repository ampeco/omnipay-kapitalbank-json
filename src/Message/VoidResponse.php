<?php

namespace Ampeco\OmnipayKapitalbankJson\Message;

class VoidResponse extends Response
{
    public function isSuccessful(): bool
    {
        return $this->isTransactionSuccessful();
    }
}