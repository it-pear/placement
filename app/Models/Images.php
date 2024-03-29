<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'url',
        'post_id',
    ];
    public function post()
    {
        return $this->belongsTo(Posts::class, 'post_id');
    }
}
