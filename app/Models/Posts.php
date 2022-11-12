<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    public $timestamps = false;  
    protected $fillable = [
        'id',
        'category_id',
        'name',
        'description',
        'image',
        'price',
        'is_recommended'
    ];
}
