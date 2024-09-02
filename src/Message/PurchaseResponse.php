<?php

namespace Ampeco\OmnipayKapitalbankJson\Message;

class PurchaseResponse extends Response
{
    public function isSuccessful(): bool
    {
        return $this->isTransactionSuccessful();
    }
}
