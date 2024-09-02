<?php

namespace Ampeco\OmnipayKapitalbankJson;

use Ampeco\OmnipayKapitalbankJson\Message\AuthorizeRequest;
use Ampeco\OmnipayKapitalbankJson\Message\CaptureRequest;
use Ampeco\OmnipayKapitalbankJson\Message\CreateCardNotification;
use Ampeco\OmnipayKapitalbankJson\Message\CreateCardRequest;
use Ampeco\OmnipayKapitalbankJson\Message\CreateInitialOrderRequest;
use Ampeco\OmnipayKapitalbankJson\Message\GetCardTokenRequest;
use Ampeco\OmnipayKapitalbankJson\Message\PurchaseRequest;
use Ampeco\OmnipayKapitalbankJson\Message\SetSourceTokenRequest;
use Ampeco\OmnipayKapitalbankJson\Message\VoidRequest;
use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\RequestInterface;

/**
 * @method \Omnipay\Common\Message\RequestInterface completeAuthorize(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface completePurchase(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface refund(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface fetchTransaction(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface updateCard(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface deleteCard(array $options = array())
 */
class Gateway extends AbstractGateway
{
    public function getName(): string
    {
        return 'Kapital Bank Json';
    }

    public function createCard(array $options = array()): RequestInterface
    {
        return $this->createRequest(CreateCardRequest::class, $options);
    }

    public function acceptNotification(array $options = array()): CreateCardNotification
    {
        return new CreateCardNotification($options);
    }

    public function getCardToken(array $options = array()): RequestInterface
    {
        return $this->createRequest(GetCardTokenRequest::class, $options);
    }

    public function void(array $options = array()): RequestInterface
    {
        return $this->createRequest(VoidRequest::class, $options);
    }

    public function createInitialOrder(array $options = array()): RequestInterface
    {
        return $this->createRequest(CreateInitialOrderRequest::class, $options);
    }

    public function setSourceToken(array $options = array()): RequestInterface
    {
        return $this->createRequest(SetSourceTokenRequest::class, $options);
    }

    public function purchase(array $options = array()): RequestInterface
    {
        return $this->createRequest(PurchaseRequest::class, $options);
    }

    public function authorize(array $options = array()): RequestInterface
    {
        return $this->createRequest(AuthorizeRequest::class, $options);
    }

    public function capture(array $options = array()): RequestInterface
    {
        return $this->createRequest(CaptureRequest::class, $options);
    }

    public function getCreateCardAmount(): float
    {
        return 1;
    }

    public function getCreateCardCurrency(): string
    {
        return 'AZN';
    }

    public function getAvailableCurrencies(): array
    {
        return ['AZN'];
    }
}
