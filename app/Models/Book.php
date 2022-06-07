<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected    
    $fillable = ['name', 'slug', 'summary', 'description', 'image', 'status', 'stock', 'price', 'category_id', 'writer_id', 'publisher_id'];

    public function category(){
        return $this->belongsTo(Category::class);
    } 

    public function writer(){
        return $this->belongsTo('App/Models/Writer'::class);
    }

    public function publisher(){
        return $this->belongsTo('App/Models/Publisher'::class);
    }

    public static function getAllBook(){
        return Book::with('category')->orderBy('id', 'desc')->paginate(10);
     
    }

    public function getReview(){
        return $this->hasMany('App\Models\Review','book_id','id')->with('user_info')->where('status','active')->orderBy('id','DESC');
    }
    
    public function rel_books(){
        return $this->hasMany('App\Models\Product','category_id','category_id')->where('status','active')->orderBy('id','DESC')->limit(8);
    }

    public static function getBookBySlug($slug){
        return Product::with(['category_id','rel_books','getReview'])->where('slug',$slug)->first();
    }
    public static function countActiveBook(){
        $data=Product::where('status','active')->count();
        
        if($data){
            return $data;
        }
        return 0;
    }

    

}
