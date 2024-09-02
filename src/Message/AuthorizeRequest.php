<?php

namespace Ampeco\OmnipayKapitalbankJson\Message;

class AuthorizeRequest extends AbstractRequest
{
    public function getEndpoint(): string
    {
        return sprintf(
            '%s/%s/exec-tran',
            parent::getEndpoint(),
            parent::PARAM_ORDER_ID
        );
    }

    public function getData(): array
    {
        return [
            ...$this->getAuthParams(),
            'orderId' => $this->getOrderId(),
            'tran' => [
                'phase' => 'Auth',
                'authorizationKind' => 'Preliminary',
                'conditions' => [
                    'cofUsage' => 'Recurring'
                ]
            ],
        ];
    }

    protected function createResponse(array $data, int $statusCode): Response
    {
        return $this->response = new AuthorizeResponse($this, $data, $statusCode);
    }
}