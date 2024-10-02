<?php

namespace Tests\Feature;

use App\Events\OrderCreated;
use App\Models\Address;
use App\Models\currencyOrder;
use App\Models\OrderUsd;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class OrderFeatureTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * 測試成功創建訂單
     */
    public function testStoreOrderSuccessfully()
    {
        // 模擬事件
        Event::fake();
        
        // 發送 POST 請求
        $response = $this->postJson('/api/orders', [
            "id" => "A0000993",
            "name" => "Hoho Hotel",
            "address" => [
                "city" => "new-taipei-city",
                "district" => "hakka-district",
                "street" => "QQ-blv"
            ],
            "price" => "6988",
            "currency" => "RMB"
        ]);
        
        // 驗證回應
        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Order received and processing',
            ]);
        
        // 驗證事件是否被觸發
        Event::assertDispatched(OrderCreated::class);
    }
    
    /**
     * 測試無效資料的訂單創建失敗
     */
    public function testStoreOrderFailsWithInvalidData()
    {
        // 發送不正確的 POST 請求
        $response = $this->postJson('/api/orders', [
            'currency' => 'USD', // 缺少 'id' 欄位
        ]);
        
        // 驗證回應是否為驗證失敗，應返回 422
        $response->assertStatus(422)
            ->assertJsonValidationErrors('id');
    }
    
    /**
     * 測試成功獲取訂單
     */
    public function testShowOrderSuccessfully()
    {
        // 創建一個測試訂單
        $order = currencyOrder::factory()->create([
            'id' => 'A0000993',
            'currency' => 'USD',
        ]);
        
        // 假設 Address 表中已有相關資料
        Address::factory()->create([
            "id" => 1,
            "city" => "new-taipei-city",
            "district" => "hakka-district",
            "street" => "QQ-blv",
        ]);
        
        OrderUsd::factory()->create([
            "id" => 1,
            "name" => "Hoho Hotel",
            "address" => 1,
            "price" => "9999",
            "currency" => "USD",
            "currency_order_id" => "A0000993",
        ]);
        
        // 發送 GET 請求
        $response = $this->getJson('/api/orders/A0000993');
        
        // 驗證回應
        $response->assertStatus(200)
            ->assertJson([
                'id' => 'A0000993',
                "name" => "Hoho Hotel",
                'address' => [
                    "city" => "new-taipei-city",
                    "district" => "hakka-district",
                    "street" => "QQ-blv"
                ],
                "price" => 9999,
                "currency" => "USD",
            ]);
    }
    
    /**
     * 測試找不到訂單的情況
     */
    public function testShowOrderReturnsNoContentWhenOrderNotFound()
    {
        // 發送 GET 請求
        $response = $this->getJson('/api/orders/INVALID_ID');
        
        // 驗證回應是否為 204 No Content
        $response->assertStatus(204);
    }
}
