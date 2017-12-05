<?php

namespace Omnipay\CoinPayments\Message;

use Omnipay\Common\Message\AbstractResponse;

/**
 * Coinbase Response
 */
class APIResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        // payment is never instantly completed upon purchase request
        return false;
    }

    public function getMessage()
    {
        if (isset($this->data['error']) && $this->data['error'] !== 'ok') {
            return $this->data['error'];
        } 
    }

    public function getTransactionReference()
    {
        if (isset($this->data['result']) && isset($this->data['result']['txn_id'])) {
            return $this->data['result']['txn_id'];
        }
    }
}
