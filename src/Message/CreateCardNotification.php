<?php

namespace Ampeco\OmnipayKapitalbankJson\Message;

use Omnipay\Common\Message\NotificationInterface;

class CreateCardNotification implements NotificationInterface
{
    public function __construct(protected array $data)
    {
    }

    public function getData(): string
    {
        return json_encode($this->data);
    }

    public function getTransactionReference(): ?string
    {
        return $this->data['ID'] ?? null;
    }

    public function getTransactionStatus(): string
    {
        return (isset($this->data['ID']) && isset($this->data['STATUS']) && $this->data['STATUS'] === Response::STATUS_FULLY_PAID)
            ? self::STATUS_COMPLETED : self::STATUS_FAILED;
    }

    public function getMessage(): string
    {
        return json_encode($this->data);
    }
}
