<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Citys;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class CatalogIdController extends Controller
{
    public function checkAuth() {
        try {
            $user = auth()->userOrFail();
        } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
        }
    }

    // запрос должен быть admin
    public function getData() {
        $properties = DB::table('properties')->get();
        $citys = Citys::with('region')->get();
        $categories = DB::table('categories')->get();
        $advantages = DB::table('advantages')->get();
        $types = DB::table('types')->get();

        $array = [
            'properties' => $properties, 
            'citys' => $citys, 
            'categories' => $categories, 
            'advantages' => $advantages,
            'types' => $types,
        ];

        return response()->json($array, 200);
    }
}
