<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class currencyOrder extends Model
{
    use HasFactory;
    
    // 指定模型的主鍵類型
    protected $keyType = 'string';
    
    // 指定主鍵不是自動遞增
    public $incrementing = false;
    
    public $timestamps = false;
}
