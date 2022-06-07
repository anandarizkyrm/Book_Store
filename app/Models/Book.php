<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected    
    $fillable = ['name', 'slug', 'summary', 'description', 'image', 'status', 'price', 'category_id', 'writer_id'];

    public function category(){
        return $this->hasMany('App/Models/Category'::class);
    } 

    public function writer(){
        return $this->hasOne('App/Models/Writer'::class);
    }

}
