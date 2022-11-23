<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts;


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
        if ($this->checkAuth()) {
            return $this->checkAuth();
        } else {
            return response()->json(Posts::find($id), 200);
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
}
