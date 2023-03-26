<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;
    public $timestamps = false;  
    protected $fillable = [
        'id',
        'name',
        'prev_description',
        'description',
        'image',
        'price',
        'is_recommended'
    ];
}
