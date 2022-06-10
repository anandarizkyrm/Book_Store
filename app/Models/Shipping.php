<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;
    protected $fillable = ['type', 'price'];
    public $table = "shipping";
    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
