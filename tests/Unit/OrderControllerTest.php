<?php

namespace Tests\Unit;

use App\Events\OrderCreated;
use App\Http\Controllers\OrderController;
use App\Http\Requests\OrderStoreRequest;
use App\Models\Address;
use App\Models\currencyOrder;
use App\Models\OrderUsd;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    /**
     * 測試 store 方法。
     */
    public function testStoreMethodDispatchesOrderCreatedEvent()
    {
        // 模擬事件
        Event::fake();
        
        // 模擬 OrderStoreRequest
        $request = \Mockery::mock(OrderStoreRequest::class);
        $request->shouldReceive('validated')
            ->once()
            ->andReturn([
                'id' => 'A000001',
                'currency' => 'USD',
            ]);
        
        // 建立 OrderController 實例
        $controller = new OrderController();
        
        // 執行 store 方法
        $response = $controller->store($request);
        
        // 驗證事件是否被觸發
        Event::assertDispatched(OrderCreated::class);
        
        // 驗證回應是否正確
        $this->assertEquals(200, $response->status());
        $this->assertEquals('Order received and processing', $response->getData()->message);
    }
    
    protected function tearDown(): void
    {
        \Mockery::close();  // 清除所有 Mockery 模擬對象
        parent::tearDown();
    }
    
}
