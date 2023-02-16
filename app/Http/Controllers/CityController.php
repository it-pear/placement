<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Citys;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function checkAuth() {
        try {
            $user = auth()->userOrFail();
        } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
        }
    }

    public function getAll() {
        return response()->json(Citys::get(), 200);
    }
    public function getById($id) {
        $city = Citys::find($id);
        if(is_null($city)) {
            return response()->json(['error' => true, 'message' => 'Такого Типа квартиры не существует'], 404);
        } else {
            return response()->json($city, 200);
        }
    }
    public function saveCity(Request $req) {
        if ($this->checkAuth()) {
            return $this->checkAuth();
        } else {
            $city = Citys::create($req->all());
            return response()->json($city, 201);
        }
    }
    public function delCity($id) {
        if ($this->checkAuth()) {
            return $this->checkAuth();
        } else {
            $city = Citys::find($id);
            if(is_null($city)) {
                return response()->json(['error' => true, 'message' => 'Такого поста не существует'], 404);
            } else {
                $city->delete();
                return response()->json(['message' => 'Пост удален'], 200);
            }
        }
    }

}
