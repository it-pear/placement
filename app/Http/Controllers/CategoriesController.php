<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function checkAuth() {
        try {
            $user = auth()->userOrFail();
        } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
        }
    }

    public function getAll() {
        return response()->json(Categories::get(), 200);
    }
    public function getById($id) {
        $post = Categories::find($id);
        if(is_null($post)) {
            return response()->json(['error' => true, 'message' => 'Такого поста не существует'], 404);
        } else {
            return response()->json($post, 200);
        }
    }
    public function saveCategory(Request $req) {
        if ($this->checkAuth()) {
            return $this->checkAuth();
        } else {
            $post = Categories::create($req->all());
            return response()->json($post, 201);
        }
    }
    public function delCategory($id) {
        if ($this->checkAuth()) {
            return $this->checkAuth();
        } else {
            $post = Categories::find($id);
            if(is_null($post)) {
                return response()->json(['error' => true, 'message' => 'Такого поста не существует'], 404);
            } else {
                $post->delete();
                return response()->json(['message' => 'Пост удален'], 200);
            }
        }
    }
}
