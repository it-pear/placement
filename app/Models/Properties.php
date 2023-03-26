<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Properties extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
