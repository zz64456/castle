<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    
    protected $fillable = ['name', 'bnb_id'];
    
    public function bnb()
    {
        return $this->belongsTo(Bnb::class);
    }
    
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
