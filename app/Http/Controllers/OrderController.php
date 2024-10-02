<?php

namespace App\Http\Controllers;

use App\Events\OrderCreated;
use App\Http\Requests\OrderStoreRequest;
use App\Repositories\AddressRepository;
use App\Repositories\CurrencyOrderRepository;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    
    /**
     * Store a newly created resource in storage.
     * @param OrderStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(OrderStoreRequest $request): \Illuminate\Http\JsonResponse
    {
        $validatedData = $request->validated();
        
        // 觸發事件
        OrderCreated::dispatch($validatedData);
        
        // 如果通過驗證，執行後續邏輯
        return response()->json([
            'message' => 'Order received and processing',
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $currencyOrder = CurrencyOrderRepository::getCurrencyOrderById($id);
        
        if (empty($currencyOrder)) {
            return response()->json([
                'message' => 'Currency Order not found.',
            ], 204);
        }
        
        switch ($currencyOrder['currency']) {
            case 'TWD':
                $orderData = CurrencyOrderRepository::getTWDOrderDataById($currencyOrder['id']);
                break;
            case 'USD':
                $orderData = CurrencyOrderRepository::getUSDOrderDataById($currencyOrder['id']);
                break;
            case 'JPY':
                $orderData = CurrencyOrderRepository::getJPYOrderDataById($currencyOrder['id']);
                break;
            case 'RMB':
                $orderData = CurrencyOrderRepository::getRMBOrderDataById($currencyOrder['id']);
                break;
            case 'MYR':
                $orderData = CurrencyOrderRepository::getMYROrderDataById($currencyOrder['id']);
                break;
            default:
                break;
        }
        
        if (empty($orderData)) {
            return response()->json([
                'message' => 'Data not found.',
            ], 204);
        }
        
        $address = AddressRepository::getAddressById($orderData->address);
        
        $addressArray = [
            'city' => $address->city,
            'district' => $address->district,
            'street' => $address->street,
        ];
        
        $orderData->id      = $orderData->currency_order_id;
        $orderData->address = $addressArray;
        
        unset($orderData->currency_order_id);
        
        return response()->json($orderData, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
