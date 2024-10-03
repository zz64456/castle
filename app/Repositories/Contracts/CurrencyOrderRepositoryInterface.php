<?php

namespace App\Repositories\Contracts;
    
interface CurrencyOrderRepositoryInterface
{
    public function getCurrencyOrderById($id);
    
    public function getTWDOrderDataById($currencyOrderId);
    
    public function getUSDOrderDataById($currencyOrderId);
    
    public function getJPYOrderDataById($currencyOrderId);
    
    public function getRMBOrderDataById($currencyOrderId);
    
    public function getMYROrderDataById($currencyOrderId);
}