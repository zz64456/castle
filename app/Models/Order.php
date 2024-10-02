<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    
    protected $fillable = [
        'bnb_id',
        'room_id',
        'currency',
        'amount',
        'check_in_date',
        'check_out_date',
        'created_at',
    ];
    
    public function bnb()
    {
        return $this->belongsTo(Bnb::class);
    }
    
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
