<?php

namespace Ampeco\OmnipayKapitalbankJson\Message;

class GetCardTokenRequest extends AbstractRequest
{
    public function getRequestMethod(): string
    {
        return 'GET';
    }

    public function getEndpoint(): string
    {
        return sprintf(
            '%s/%s?tranDetailLevel=2&tokenDetailLevel=2&orderDetailLevel=2',
            parent::getEndpoint(),
            parent::PARAM_ORDER_ID
        );
    }

    public function getData(): array
    {
        return [
            ...$this->getAuthParams(),
            'orderId' => $this->getOrderId(),
        ];
    }

    protected function createResponse(array $data, int $statusCode): Response
    {
        info('RESPONSEEE GET TOKEN', ['CODE' => $statusCode, 'DATA' => $data]); ////
        return $this->response = new GetCardTokenResponse($this, $data, $statusCode);
    }
}
