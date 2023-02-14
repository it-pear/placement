<?php

namespace App\Http\Controllers;
use App\Models\Distance;
use Illuminate\Http\Request;

class DistanceController extends Controller
{
    public function checkAuth() {
        try {
            $user = auth()->userOrFail();
        } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
        }
    }
}
