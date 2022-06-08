<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
class Category extends Model
{

    protected $fillable=['name','slug'];
    public $table = "category";
    
    public function books(){
        return $this->hasMany(Book::class);
    }   

    public static function getProductByCategory($slug){
        return Category::with('books')->where('slug',$slug)->first();
    }

    public static function countActiveCategory(){
        $data=Category::get()->count();
        if($data){
            return $data;
        }
        return 0;
    }
}
