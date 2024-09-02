<?php

namespace Ampeco\OmnipayKapitalbankJson\Message;

class CreateInitialOrderRequest extends AbstractRequest
{
    public function getData(): array
    {
        return [
            ...$this->getAuthParams(),
            'order' => [
                'typeRid' => $this->getOrderType(),
                'amount' => $this->getAmount(),
                'currency' => $this->getCurrency(),
            ],
        ];
    }

    protected function createResponse(array $data, int $statusCode): Response
    {
        return $this->response = new CreateInitialOrderResponse($this, $data, $statusCode);
    }
}
