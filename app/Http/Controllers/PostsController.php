<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\Images;
use App\Http\Requests\StorePostRequest;

class PostsController extends Controller
{
    // $posts = DB::table('posts')
    //         ->join('categories', 'posts.category_id', '=', 'categories.id')
    //         ->get();
    public function checkAuth() {
        try {
            $user = auth()->userOrFail();
        } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
        }
    }

    public function getAll() {
        $posts = Posts::with(['category', 'layout', 'type', 'city', 'region', 'distance'])->get();
        return response()->json($posts, 200);
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
            $file = $req->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $newPath = 'public/uploads/'. $req->name. '/' . $filename;
            $file->move('public/uploads'. '/' . $req->name, $filename);
            
            $data = $req->all();
            $data['image'] = $newPath;

            $post = Posts::create($data);
            
            $files = $req->file('images');
            // $uploadedFiles = [];
            foreach ($files as $file) {
                $uniqueName = time() . '_' . $file->getClientOriginalName();

                $file->storeAs('uploads'. '/' . $req->name, $uniqueName , 'public');

                $uploadedFile = 'uploads'. '/' . $req->name . '/' . $uniqueName;

                Images::create([
                    'url' => $uploadedFile,
                    'post_id' => $post->id
                ]);
            }

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
