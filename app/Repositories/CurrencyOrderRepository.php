<?php
namespace App\Repositories;

use App\Models\currencyOrder;

class CurrencyOrderRepository
{
    public static function getCurrencyOrderById($id)
    {
        return currencyOrder::find($id);
    }
    
    public static function getTWDOrderDataById($currencyOrderId)
    {
        return \DB::table('orders_twd')->where('currency_order_id', '=', $currencyOrderId)->first();
    }
    
    public static function getUSDOrderDataById($currencyOrderId)
    {
        return \DB::table('orders_usd')->where('currency_order_id', '=', $currencyOrderId)->first();
    }
    
    public static function getJPYOrderDataById($currencyOrderId)
    {
        return \DB::table('orders_jpy')->where('currency_order_id', '=', $currencyOrderId)->first();
    }
    
    public static function getRMBOrderDataById($currencyOrderId)
    {
        return \DB::table('orders_rmb')->where('currency_order_id', '=', $currencyOrderId)->first();
    }
    
    public static function getMYROrderDataById($currencyOrderId)
    {
        return \DB::table('orders_myr')->where('currency_order_id', '=', $currencyOrderId)->first();
    }
}
