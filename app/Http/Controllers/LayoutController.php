<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Layouts;
use Illuminate\Http\Request;

class LayoutController extends Controller
{
    public function checkAuth() {
        try {
            $user = auth()->userOrFail();
        } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
        }
    }

    public function getAll() {
        return response()->json(Layouts::get(), 200);
    }
    public function getById($id) {
        $layout = Layouts::find($id);
        if(is_null($layout)) {
            return response()->json(['error' => true, 'message' => 'Такого Типа квартиры не существует'], 404);
        } else {
            return response()->json($layout, 200);
        }
    }
    public function saveLayout(Request $req) {
        if ($this->checkAuth()) {
            return $this->checkAuth();
        } else {
            $layout = Layouts::create($req->all());
            return response()->json($layout, 201);
        }
    }
    public function delLayout($id) {
        if ($this->checkAuth()) {
            return $this->checkAuth();
        } else {
            $layout = Layouts::find($id);
            if(is_null($layout)) {
                return response()->json(['error' => true, 'message' => 'Такого поста не существует'], 404);
            } else {
                $layout->delete();
                return response()->json(['message' => 'Пост удален'], 200);
            }
        }
    }
}
