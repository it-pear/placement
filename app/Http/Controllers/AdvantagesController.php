<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Advantages;
use Illuminate\Http\Request;

class AdvantagesController extends Controller
{
    public function checkAuth() {
        try {
            $user = auth()->userOrFail();
        } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
        }
    }

    public function getAll() {
        return response()->json(Advantages::get(), 200);
    }
    public function getById($id) {
        $advantage = Advantages::find($id);
        if(is_null($advantage)) {
            return response()->json(['error' => true, 'message' => 'Такого Типа квартиры не существует'], 404);
        } else {
            return response()->json($advantage, 200);
        }
    }
    public function saveAdvantage(Request $req) {
        if ($this->checkAuth()) {
            return $this->checkAuth();
        } else {
            $advantage = Advantages::create($req->all());
            return response()->json($advantage, 201);
        }
    }
    public function delAdvantage($id) {
        if ($this->checkAuth()) {
            return $this->checkAuth();
        } else {
            $advantage = Advantages::find($id);
            if(is_null($advantage)) {
                return response()->json(['error' => true, 'message' => 'Такого поста не существует'], 404);
            } else {
                $advantage->delete();
                return response()->json(['message' => 'Пост удален'], 200);
            }
        }
    }
}
