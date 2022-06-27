<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cart;
use App\Models\Review;

class Book extends Model
{
    use HasFactory;
    protected    
    $fillable = ['name', 'slug', 'summary', 'description', 'image', 'discount', 'status', 'stock', 'price', 'category_id', 'writer_id', 'publisher_id'];

    public function category(){
        return $this->belongsTo(Category::class);
    } 

    public function writer(){
        return $this->belongsTo(Writer::class);
    }

    public function publisher(){
        return $this->belongsTo(Publisher::class);
    }

    public static function getAllBook(){
        return Book::with('category')->orderBy('id', 'desc')->paginate(10);
    }

    public function getReview(){
        return $this->hasMany(Review::class,'book_id','id')->with('userInfo')->where('status','active')->orderBy('id','DESC');
    }

    
    public static function getAllBooksReport($start, $end){
        return Book::whereBetween('created_at', [$start, $end])->get();
    }
    public static function getAllSoldReport($start, $end){
        return Cart::whereBetween('created_at', [$start, $end])->get();
    }
    public static function getAllDiscount($start, $end){
        return Book::where('discount', '>', 0)->whereBetween('created_at', [$start, $end])->get();
    }
   
    
    public function rel_books(){
        return $this->hasMany('App\Models\Book','category_id','category_id')->where('status','active')->orderBy('id','DESC')->limit(8);
    }

    public static function getBookBySlug($slug){
        return Book::with(['category','getReview'])->where('slug',$slug)->first();
    }
    public static function countActiveBook(){
        $data=Book::where('status','active')->count();
        
        if($data){
            return $data;
        }
        return 0;
    }

    public static function countStockBook(){
        $book = Book::get();
        $count = 0;
        foreach($book as $b){
            $count += $b->stock;
        }
        return $count;
    }

    

}
