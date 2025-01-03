<?php

namespace Ampeco\OmnipayKapitalbankJson\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

class Response extends AbstractResponse
{
    public const STATUS_FULLY_PAID = 'FullyPaid';
    protected const STATUS_PREPARING = 'Preparing';
    protected const PMO_RESULT_CODE_APPROVED = '1';

    public function __construct(RequestInterface $request, array $data, protected int $code)
    {
        parent::__construct($request, $data);
    }

    public function isSuccessful(): bool
    {
        return $this->code == 0;
    }

    public function getMessage(): string
    {
        return isset($this->data['errorCode']) || isset($this->data['errorDescription'])
            ? sprintf("%s %s", $this->data['errorCode'] ?? '', $this->data['errorDescription'] ?? '')
            : '';
    }

    protected function isTransactionSuccessful(): bool
    {
        return self::isSuccessful()
            && $this->getTran()
            && isset($this->getTran()['pmoResultCode'])
            && $this->getTran()['pmoResultCode'] === self::PMO_RESULT_CODE_APPROVED;
    }

    protected function getOrder(): ?array
    {
        return $this->data['order'] ?? null;
    }

    protected function getTran(): ?array
    {
        return $this->data['tran'] ?? null;
    }
}
