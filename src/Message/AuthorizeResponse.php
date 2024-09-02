<?php

namespace Ampeco\OmnipayKapitalbankJson\Message;

class AuthorizeResponse extends Response
{
    public function isSuccessful(): bool
    {
        return $this->isTransactionSuccessful();
    }
}
