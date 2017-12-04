<?php

namespace Omnipay\CoinPayments\Message;

use Omnipay\Common\Exception\InvalidResponseException;

class CompletePurchaseRequest extends AbstractRequest
{
    public function getShopSecret()
    {
        return $this->getParameter('shop_secret');
    }

    public function setShopSecret($value)
    {
        return $this->setParameter('shop_secret', $value);
    }

    public function getMCurr()
    {
        return $this->getParameter('m_curr');
    }

    public function setMCurr($value)
    {
        return $this->setParameter('m_curr', $value);
    }

    public function getMStatus()
    {
        return $this->getParameter('m_status');
    }

    public function setMStatus($value)
    {
        return $this->setParameter('m_status', $value);
    }

    public function getMOperationId()
    {
        return $this->getParameter('m_operation_id');
    }

    public function setMOperationId($value)
    {
        return $this->setParameter('m_operation_id', $value);
    }
    
    public function getMOperationPs()
    {
        return $this->getParameter('m_operation_ps');
    }

    public function setMOperationPs($value)
    {
        return $this->setParameter('m_operation_ps', $value);
    }
    
    public function getMOperationDate()
    {
        return $this->getParameter('m_operation_date');
    }

    public function setMOperationDate($value)
    {
        return $this->setParameter('m_operation_date', $value);
    }
    
    public function getMOperationPayDate()
    {
        return $this->getParameter('m_operation_pay_date');
    }

    public function setMOperationPayDate($value)
    {
        return $this->setParameter('m_operation_pay_date', $value);
    }
    
    public function getMShop()
    {
        return $this->getParameter('m_shop');
    }

    public function setMShop($value)
    {
        return $this->setParameter('m_shop', $value);
    }
    
    public function getMOrderId()
    {
        return $this->getParameter('m_orderid');
    }
    
    public function setMOrderId($value)
    {
        return $this->setParameter('m_orderid', $value);
    }
    
    public function getMAmount()
    {
        return $this->getParameter('m_amount');
    }
    
    public function setMAmount($value)
    {
        return $this->setParameter('m_amount', $value);
    }
    
    public function getMDesc()
    {
        return $this->getParameter('m_desc');
    }

    public function setMDesc($value)
    {
        return $this->setParameter('m_desc', $value);
    }
    
    public function getMSign()
    {
        return $this->getParameter('m_sign');
    }

    public function setMSign($value)
    {
        return $this->setParameter('m_sign', $value);
    }
    
    
    public function getData()
    {
        if ($this->getMCurr() != $this->getCurrency()) {
            throw new InvalidResponseException("Invalid m_curr:".$this->getMCurr());
        }

        if ($this->getMStatus() != 'success') {
            throw new InvalidResponseException("Invalid m_status:".$this->getMStatus());
        }

        $arHash = [
            $this->getMOperationId(),
            $this->getMOperationPs(),
            $this->getMOperationDate(),
            $this->getMOperationPayDate(),
            $this->getMShop(),
            $this->getMOrderId(),
            $this->getMAmount(),
            $this->getMCurr(),
            $this->getMDesc(),
            $this->getMStatus(),
            $this->getShopSecret()
        ];
        
        $sign_hash = strtoupper(hash('sha256', implode(':', $arHash)));
        
        if ($this->getMSign() != $sign_hash) {
            throw new InvalidResponseException("Invalid m_sign");
        }
        
        return $this->getParameters();
    }

    public function sendData($data)
    {
        return $this->response = new CompletePurchaseResponse($this, $data);
    }
}
