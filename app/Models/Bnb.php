<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bnb extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    
    protected $fillable = ['name'];
    
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
    
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
