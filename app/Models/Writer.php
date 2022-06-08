<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Writer extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email'];
    public $table = "writer";

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
