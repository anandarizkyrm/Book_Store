<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [ 'order_number', 'sub_total', 'total_amount', 'quantity', 'transfer_evidence', 'status', 'user_id', 'ongkir', 'city' , 'email', 'phone', 'address', 'post_code', 'first_name','last_name' , 'cancel_reason'];

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

    public static function getAllOrder($start, $end){
        return Order::where('status' , '!=', "cancelled")->whereBetween('created_at', [$start, $end])->get();
    }
    public static function getAllOrderCanceled($start, $end){
        return Order::where('status', '=', 'cancelled')->whereBetween('created_at', [$start, $end])->get();
    }
    public static function getOrder($id){
        return Order::find($id);
    }

    public static function countActiveOrder(){
        $data=Order::count();
        if($data){
            return $data;
        }
        return 0;
    }

    public static function totalIncome(){
        $data = Order::where('payment_status', 'paid')->where('status','delivered')->sum('total_amount');
        if($data){
            return $data;
        }
        return 0;
    }

    public static function totalIncomeToday(){
        $data = Order::whereDate('created_at', date('Y-m-d'))->where('status','delivered')->sum('sub_total');
        if($data){
            return $data;
        }
        return 0;
    }
    public static function totalIncomeThisMonth(){
        $data = Order::whereMonth('created_at', date('m'))->where('status','delivered')->sum('sub_total');
        if($data){
            return $data;
        }
        return 0;
    }

    public static function totalIncomeThisYear(){
        $data = Order::whereYear('created_at', date('Y'))->where('status','delivered')->sum('sub_total');
        if($data){
            return $data;
        }
        return 0;
    }

}
