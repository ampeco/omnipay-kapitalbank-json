<?php

namespace Ampeco\OmnipayKapitalbankJson\Message;

class SetSourceTokenRequest extends AbstractRequest
{
    public function getEndpoint(): string
    {
        return sprintf(
            '%s/%s/set-src-token?password=%s',
            parent::getEndpoint(),
            parent::PARAM_ORDER_ID,
            parent::PARAM_PASSWORD,
        );
    }

    public function getData(): array
    {
        return [
            ...$this->getAuthParams(),
            'orderId' => $this->getOrderId(),
            'password' => $this->getPassword(),
            'order' => [
                'initiationEnvKind' => 'Server',
            ],
            'token' => [
                'storedId' => $this->getToken(),
            ],
        ];
    }

    protected function createResponse(array $data, int $statusCode): Response
    {
        return $this->response = new SetSourceTokenResponse($this, $data, $statusCode);
    }
}
