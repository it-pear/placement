<?php

namespace App\Repositories;
use App\Models\Posts;
use Illuminate\Pagination\LengthAwarePaginator;

class PostsRepository  implements PostsRepositoryInterface
{

  public function search(array $filters = []): LengthAwarePaginator 
  {
    $query = Posts::query();
    
    if (!empty($filters['sale'])) {
      $query->where('sale', $filters['sale']);
    }
    
    if (!empty($filters['price_from'])) {
      $query->where('price', '>=', $filters['price_from']);
    }

    if (!empty($filters['price_to'])) {
      $query->where('price', '<=', $filters['price_to']);
    }

    if (!empty($filters['layouts'])) {
      $layoutIds = $filters['layouts'];
      $query->whereIn('layout_id', $layoutIds);
    }


    if (!empty($filters['types'])) {
      $typeIds = $filters['types'];
      $query->whereIn('type_id', $typeIds);
    }

    if (!empty($filters['region'])) {
      $query->where('region_id', $filters['region']);
    }

    if (!empty($filters['distances'])) {
      $distanceIds = $filters['distances'];
      $query->whereIn('distance_id', $distanceIds);
    }

    if (!empty($filters['category'])) {
      $query->where('category_id', $filters['category']);
    }

    if (!empty($filters['advantages'])) {
      $advantageIds = $filters['advantages'];
      $query->whereHas('advantages', function ($query) use ($advantageIds) {
          $query->whereIn('advantages.id', $advantageIds);
      });
    }

    if (!empty($filters['properties'])) {
      $propertyIds = $filters['properties'];
      $query->whereHas('properties', function ($query) use ($propertyIds) {
          $query->whereIn('properties.id', $propertyIds);
      });
    }

    $perPage = !empty($filters['per_page']) ? $filters['per_page'] : 10;
    $page = !empty($filters['page']) ? $filters['page'] : 1;

    return $query->paginate($perPage, ['*'], 'page', $page);
  }

}
