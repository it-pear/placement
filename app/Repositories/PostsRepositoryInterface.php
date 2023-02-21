<?php

namespace App\Repositories;
use Illuminate\Pagination\LengthAwarePaginator;

interface PostsRepositoryInterface {
  public function search(array $filters = []): LengthAwarePaginator;
}