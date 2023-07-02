<?php

namespace App\Repositories;
use App\Models\Posts;
use Illuminate\Pagination\LengthAwarePaginator;

class PostsRepository  implements PostsRepositoryInterface
{

  public function search(array $filters = []): LengthAwarePaginator 
  {
    $query = Posts::query();

    // if (!empty($filters['name'])) {
    //   $query->where('name', 'like', '%' . $filters['name'] . '%');
    // }

    // if (!empty($filters['date'])) {
    //   $query->whereHas('orders', function ($query) use ($filters) {
    //     $query->whereDate('created_at', '=', $filters['date']);
    //   });
    // }

    if (!empty($filters['price_from'])) {
      $query->where('price', '>=', $filters['price_from']);
    }

    if (!empty($filters['price_to'])) {
      $query->where('price', '<=', $filters['price_to']);
    }

    // return $query->with(['orders' => function ($query) use ($filters) {
    //   if (!empty($filters['date'])) {
    //     $query->whereDate('created_at', '=', $filters['date']);
    //   }
    // }, 'orders.customer'])
    $perPage = !empty($filters['per_page']) ? $filters['per_page'] : 10;
    $page = !empty($filters['page']) ? $filters['page'] : 1;

    return $query->paginate($perPage, ['*'], 'page', $page);
      // return $query->paginate(10);
  }

}
