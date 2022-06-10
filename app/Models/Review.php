<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'rating','user_id', 'book_id', 'status'];
    public $table = "review";
    
    public function userInfo (){
        return $this->hasOne(User::class,'id','user_id');
    }

    public static function getAllReview(){
        return Review::with('userInfo')->paginate(10);
    }

    public static function getAllUserReview(){
        return Review::with('userInfo')->where('user_id', auth()->user()->id)->paginate(10);
    }

    public function book (){
        return $this->hasOne(Book::class);
    }

  
}
