<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citys extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name'
    ];

    public function region() {
        return $this->hasMany(Regions::class, 'city_id');
    }
}
