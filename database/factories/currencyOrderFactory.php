<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\currencyOrder>
 */
class currencyOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 使用 Faker 生成隨機訂單 ID
            'id' => $this->faker->regexify('A[0-9]{7}'),
            
            // 隨機貨幣代碼 (ISO 4217) 
            'currency' => $this->faker->randomElement(['USD', 'TWD', 'JPY', 'RMB', 'MYR']),
        ];
    }
}
