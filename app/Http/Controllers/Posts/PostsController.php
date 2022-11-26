<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts;
use App\Http\Requests\StorePostRequest;

class PostsController extends Controller
{
    public function checkAuth() {
        try {
            $user = auth()->userOrFail();
        } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
        }
    }

    public function getAll() {
        return response()->json(Posts::get(), 200);
    }
    public function getById($id) {
        $post = Posts::find($id);
        if(is_null($post)) {
            return response()->json(['error' => true, 'message' => 'Такого поста не существует'], 404);
        } else {
            return response()->json($post, 200);
        }
    }
    public function savePost(Request $req) {
        if ($this->checkAuth()) {
            return $this->checkAuth();
        } else {
            $post = Posts::create($req->all());
            return response()->json($post, 201);
        }
    }
    public function editPost(StorePostRequest $req, $id) {
        if ($this->checkAuth()) {
            return $this->checkAuth();
        } else {
            $post = Posts::find($id);
            if(is_null($post)) {
                return response()->json(['error' => true, 'message' => 'Такого поста не существует'], 404);
            } else {
                $post->update($req->all());
                return response()->json($post, 200);
            }
        }
    }
    public function delPost($id) {
        if ($this->checkAuth()) {
            return $this->checkAuth();
        } else {
            $post = Posts::find($id);
            if(is_null($post)) {
                return response()->json(['error' => true, 'message' => 'Такого поста не существует'], 404);
            } else {
                $post->delete();
                return response()->json(['message' => 'Пост удален'], 200);
            }
        }
    }
}
