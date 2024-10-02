<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderUsd>
 */
class OrderUsdFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'currency_order_id' => $this->faker->regexify('A[0-9]{7}'),
            
            'name' => $this->faker->company,
            
            'address' => \App\Models\Address::factory(),
            
            'price' => $this->faker->randomFloat(2, 10, 1000),
            
            'currency' => 'USD',
        ];
    }
}
