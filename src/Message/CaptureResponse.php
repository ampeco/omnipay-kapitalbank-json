<?php

namespace Ampeco\OmnipayKapitalbankJson\Message;

class CaptureResponse extends Response
{
    public function isSuccessful(): bool
    {
        return $this->isTransactionSuccessful();
    }
}
