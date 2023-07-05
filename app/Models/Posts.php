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
        'is_recommended',
        'square',
        'deadline',
        'storeys',
        'finishing',
        'layout_id',
        'type_id',
        'city_id',
        'region_id',
        'sale',
        'distance_id',
        'created_at',
    ];

    public function category() {
        return $this->belongsTo(Categories::class, 'category_id');
    }
    public function layout() {
        return $this->belongsTo(Layouts::class, 'layout_id');
    }
    public function type() {
        return $this->belongsTo(Types::class, 'type_id');
    }
    public function city() {
        return $this->belongsTo(Citys::class, 'city_id');
    }
    public function region() {
        return $this->belongsTo(Regions::class, 'region_id');
    }
    public function distance() {
        return $this->belongsTo(Distances::class, 'distance_id');
    }
    public function advantages()
    {
        return $this->belongsToMany(Advantages::class, 'post_advantages', 'post_id', 'advantages_id');
    }
    public function properties()
    {
        return $this->belongsToMany(Properties::class, 'property_posts', 'posts_id', 'property_id');
    }
    
    public function images()
    {
        return $this->hasMany(Images::class, 'post_id');
    }
}
