<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'order_number', 'sub_total', 'total_amount', 'quantity', 'payment_method', 'payment_status', 'status', 'user_id', 'shipping_id', 'email', 'phone', 'address', 'post_code'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shipping()
    {
        return $this->belongsTo(Shipping::class);
    }

    public function cart (){
        return $this->hasMany(Cart::class);
    }

    public static function getAllOrder($id){
        return Order::with('cart_info')->find($id);
    }

    public static function countActiveOrder(){
        $data=Order::count();
        if($data){
            return $data;
        }
        return 0;
    }

    public static function totalIncome(){
        $data = Order::where('payment_status', 'paid')->sum('total_amount');
        if($data){
            return $data;
        }
        return 0;
    }

    public static function totalIncomeToday(){
        $data = Order::whereDate('created_at', date('Y-m-d'))->where('payment_status', 'paid')->sum('total_amount');
        if($data){
            return $data;
        }
        return 0;
    }
    public static function totalIncomeThisMonth(){
        $data = Order::whereMonth('created_at', date('m'))->where('payment_status', 'paid')->sum('total_amount');
        if($data){
            return $data;
        }
        return 0;
    }

    public static function totalIncomeThisYear(){
        $data = Order::whereYear('created_at', date('Y'))->where('payment_status', 'paid')->sum('total_amount');
        if($data){
            return $data;
        }
        return 0;
    }

}
