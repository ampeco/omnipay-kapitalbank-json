<?php

namespace Ampeco\OmnipayKapitalbankJson\Message;

class CreateCardRequest extends AbstractRequest
{
    public function getData(): array
    {
        return [
            ...$this->getAuthParams(),
            'order' => [
                'typeRid' => 'Order_SMS',
                'amount' => $this->getAmount(),
                'currency' => $this->getCurrency(),
                'language' => $this->getLanguage(),
                'hppRedirectUrl' => $this->getHppRedirectUrl(),
                'hppCofCapturePurposes' => [
                    'UnspecifiedMit',
                    'Cit',
                    'Recurring'
                ],
                'aut' => [
                    'purpose' => 'AddCard'
                ],
            ],
        ];
    }

    protected function createResponse(array $data, int $statusCode): Response
    {
        return $this->response = new CreateCardResponse($this, $data, $statusCode);
    }
}
