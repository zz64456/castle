<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Models\Address;
use App\Repositories\AddressRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderCreatedListener
{
    protected $addressRepository;
    /**
     * Create the event listener.
     */
    public function __construct(AddressRepository $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event): void
    {
        $orderData = $event->orderData;
        $currency  = $orderData['currency'];
        
        try {
            \DB::table('currency_orders')->insert([
                'id'       => $orderData['id'],
                'currency' => $orderData['currency'],
            ]);
            
            $address = $this->addressRepository->findAddressByLocation(
                $event->orderData['address']['city'],
                $event->orderData['address']['district'],
                $event->orderData['address']['street']
            );
            
            if (empty($address)) {
                $addressId = \DB::table('addresses')->insertGetId([
                    'city'     => $orderData['address']['city'],
                    'district' => $orderData['address']['district'],
                    'street'   => $orderData['address']['street'],
                ]);
                
                if (!$addressId) {
                    throw new \Exception("Address insertion failed.");
                }
            }
            
            $insertData = $orderData;
            $insertData['address'] = $address ? $address->id : $addressId;
            $insertData['currency_order_id'] = $orderData['id'];
            unset($insertData['id']);
            
            switch ($currency) {
                case 'TWD':
                    \DB::table('orders_twd')->insert($insertData);
                    break;
                case 'USD':
                    \DB::table('orders_usd')->insert($insertData);
                    break;
                case 'JPY':
                    \DB::table('orders_jpy')->insert($insertData);
                    break;
                case 'RMB':
                    \DB::table('orders_rmb')->insert($insertData);
                    break;
                case 'MYR':
                    \DB::table('orders_myr')->insert($insertData);
                    break;
                default:
                    break;
            }
        } catch (\Exception $e) {
            Log::error('Order creation failed', [
                'error'     => $e->getMessage(),
                'orderData' => $event->orderData,
            ]);
        }
    }
}
