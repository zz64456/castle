<?php
namespace App\Repositories;

use App\Models\currencyOrder;

class CurrencyOrderRepository
{
    public function getCurrencyOrderById($id)
    {
        return currencyOrder::find($id);
    }
    
    public function getTWDOrderDataById($currencyOrderId)
    {
        return \DB::table('orders_twd')->where('currency_order_id', '=', $currencyOrderId)->first();
    }
    
    public function getUSDOrderDataById($currencyOrderId)
    {
        return \DB::table('orders_usd')->where('currency_order_id', '=', $currencyOrderId)->first();
    }
    
    public function getJPYOrderDataById($currencyOrderId)
    {
        return \DB::table('orders_jpy')->where('currency_order_id', '=', $currencyOrderId)->first();
    }
    
    public function getRMBOrderDataById($currencyOrderId)
    {
        return \DB::table('orders_rmb')->where('currency_order_id', '=', $currencyOrderId)->first();
    }
    
    public function getMYROrderDataById($currencyOrderId)
    {
        return \DB::table('orders_myr')->where('currency_order_id', '=', $currencyOrderId)->first();
    }
}
