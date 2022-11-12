<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts;

class PostsController extends Controller
{
    public function getAll() {
        return response()->json(Posts::get(), 200);
    }
    public function getById($id) {
        return response()->json(Posts::find($id), 200);
    }
    public function savePost(Request $req) {
        $post = Posts::create($req->all());
        return response()->json($post, 201);
    }
}
