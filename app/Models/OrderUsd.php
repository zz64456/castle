<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderUsd extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    
    protected $table = 'orders_usd';
}
