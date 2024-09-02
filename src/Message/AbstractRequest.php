<?php

namespace Ampeco\OmnipayKapitalbankJson\Message;

use Ampeco\OmnipayKapitalbankJson\CommonParameters;
use Ampeco\OmnipayKapitalbankJson\Gateway;
use Omnipay\Common\Message\AbstractRequest as OmniPayAbstractRequest;

abstract class AbstractRequest extends OmniPayAbstractRequest
{
    use CommonParameters;

    public const ORDER_TYPE_REC = 'Order_REC';
    public const ORDER_TYPE_DMSN3D = 'DMSN3D';
    public const VOID_PHASE_AUTH = 'Auth';
    public const VOID_PHASE_PURCHASE = 'Single';
    protected const API_URL_TEST = 'https://txpgtst.kapitalbank.az/api';
    protected const API_URL_PROD = 'https://e-commerce.kapitalbank.az/api';
    protected const PARAM_ORDER_ID = '{orderId}';
    protected const PARAM_PASSWORD = '{password}';

    protected ?Gateway $gateway;

    abstract protected function createResponse(array $data, int $statusCode): Response;

    public function setGateway(Gateway $gateway): self
    {
        $this->gateway = $gateway;
        return $this;
    }

    public function getBaseUrl(): string
    {
        return $this->getTestMode() ? self::API_URL_TEST : self::API_URL_PROD;
    }

    public function getRequestMethod(): string
    {
        return 'POST';
    }

    public function getEndpoint(): string
    {
        return '/order';
    }

    public function sendData($data): Response
    {
        $username = $data['merchantUsername'];
        $password = $data['merchantPassword'];

        $endpointAdditionalParams = $this->addEndpointAdditionalParams($data);

        $payload = $this->unsetUnnecessaryParams($data);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,  $this->getBaseUrl() . $endpointAdditionalParams);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if ($this->getRequestMethod() !== 'GET') {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        }

        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $output = curl_exec($ch);

        curl_close($ch);

        return $this->createResponse(
            json_decode($output, true, flags: JSON_THROW_ON_ERROR),
            $statusCode
        );
    }

    protected function getAuthParams(): array
    {
        return [
            'merchantUsername' => $this->getMerchantUsername(),
            'merchantPassword' => $this->getMerchantPassword(),
        ];
    }

    private function addEndpointAdditionalParams(array $data): string
    {
        $endpoint = $this->getEndpoint();
        if (isset($data['orderId'])) {
            $endpoint = str_replace(self::PARAM_ORDER_ID, $data['orderId'], $endpoint);
        }

        if (isset($data['password'])) {
            $endpoint = str_replace(self::PARAM_PASSWORD, $data['password'], $endpoint);
        }

        return $endpoint;
    }

    private function unsetUnnecessaryParams(array $data): array
    {
        unset(
            $data['merchantUsername'],
            $data['merchantPassword'],
            $data['orderId'],
            $data['password'],
            $data['orderType'],
            $data['phase'],
        );

        return $data;
    }
}
