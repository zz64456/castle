<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders_jpy', function (Blueprint $table) {
            $table->id();
            $table->string('currency_order_id');
            $table->string('name');
            $table->unsignedBigInteger('address');
            $table->integer('price');
            $table->char('currency', 3);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders_jpy');
    }
};
