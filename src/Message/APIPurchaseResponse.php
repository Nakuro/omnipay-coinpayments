<?php

namespace Omnipay\CoinPayments\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\Common\Message\RequestInterface;

class APIPurchaseResponse extends APIResponse implements RedirectResponseInterface
{
    /* protected $redirectUrl;

    public function __construct(RequestInterface $request, $data, $redirectUrl)
    {
        parent::__construct($request, $data);
        $this->redirectUrl = $redirectUrl;
    } */

    

    public function isRedirect()
    {
        return isset($this->data['result']) && 'ok' === $this->data['error'];
    }

    public function getRedirectUrl()
    {
        if (isset($this->data['result']) && isset($this->data['result']['status_url'])) {
            return $this->data['result']['status_url'];
        }
    }

    public function getRedirectMethod()
    {
        return 'POST';
    }

    public function getRedirectData()
    {
        return $this->data;
    }
}
