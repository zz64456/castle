<?php

namespace Database\Factories;

use App\Models\Bnb;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $bnb = Bnb::inRandomOrder()->first() ?? Bnb::factory()->create(); // 從資料庫中隨機選擇一個 Bnb
        $room = Room::inRandomOrder()->first() ?? Room::factory()->create(); // 從資料庫中隨機選擇一個 Room
        
        if (!$bnb || !$room) {
            throw new \Exception('需要先有 Bnb 和 Room 資料');
        }
        
        $checkInDate  = $this->faker->dateTimeBetween('-2 year');
        $checkOutDate = $this->faker->dateTimeBetween(
            $checkInDate,
            $checkInDate->format('Y-m-d').' +10 days'
        );
        
        $createdAt = $this->faker->dateTimeBetween($checkInDate->format('Y-m-d H:i:s') . '-1 month', $checkInDate);
        
        return [
            'bnb_id' => $bnb->id, // 動態創建並關聯 Bnb
            'room_id' => $room->id, // 動態創建並關聯 Room
            'currency' => $this->faker->currencyCode, // 使用 Faker 生成隨機貨幣
            'amount' => $this->faker->numberBetween(999, 99999), // 隨機金額
            'check_in_date' => $checkInDate,
            'check_out_date' => $checkOutDate,
            'created_at' => $createdAt,
        ];
    }
    
    // 定義 currency 為 TWD 的狀態
    public function withCurrencyTWD()
    {
        return $this->state([
            'currency' => 'TWD',
        ]);
    }
}
