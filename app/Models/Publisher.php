<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'address'];

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public static function getProductByBrand($slug){
        // dd($slug);
        return Publisher::with('books')->where('slug',$slug)->first();
        // return Product::where('cat_id',$id)->where('child_cat_id',null)->paginate(10);
    }
}

