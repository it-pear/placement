<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Properties;
use Illuminate\Http\Request;

class PropertiesController extends Controller
{
    public function checkAuth() {
        try {
            $user = auth()->userOrFail();
        } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
        }
    }

    public function getAll() {
        return response()->json(Properties::get(), 200);
    }
    public function getById($id) {
        $property = Properties::find($id);
        if(is_null($property)) {
            return response()->json(['error' => true, 'message' => 'Такого Типа квартиры не существует'], 404);
        } else {
            return response()->json($property, 200);
        }
    }
    public function saveProperty(Request $req) {
        if ($this->checkAuth()) {
            return $this->checkAuth();
        } else {
            $property = Properties::create($req->all());
            return response()->json($req->all(), 201);
        }
    }
    public function delProperty($id) {
        if ($this->checkAuth()) {
            return $this->checkAuth();
        } else {
            $property = Properties::find($id);
            if(is_null($property)) {
                return response()->json(['error' => true, 'message' => 'Такого поста не существует'], 404);
            } else {
                $property->delete();
                return response()->json(['message' => 'Пост удален'], 200);
            }
        }
    }
}
