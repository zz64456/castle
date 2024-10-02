<?php

namespace Database\Seeders;

use App\Models\Bnb;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BnbSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bnb::factory()->count(50)->create();
    }
}
