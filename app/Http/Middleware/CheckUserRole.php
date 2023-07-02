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
        $user = auth()->user();
        if (!$user) {
            return response()->json(['error' => true, 'message' => 'Unauthenticated'], 401);
        }
    
        // Проверяем, является ли пользователь администратором
        if ($user->role !== 1) {
            return response()->json(['error' => true, 'message' => 'Нет прав'], 403);
        }
    
        return $next($request);
    }
}