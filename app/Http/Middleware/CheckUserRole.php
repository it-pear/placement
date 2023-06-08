<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Exceptions\UserNotDefinedException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class CheckUserRole
{
    /**
     * Обрабатывает входящий запрос.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
  public function handle($request, Closure $next)
  {
    try {
      $user = auth()->userOrFail();
    } catch (UserNotDefinedException $e) {
      return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
    }

    return $next($request);
  }
}