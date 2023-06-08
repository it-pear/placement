<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\Images;
use App\Http\Requests\StorePostRequest;
use App\Repositories\PostsRepository;

class PostsController extends Controller
{
  // $posts = DB::table('posts')
  //     ->join('categories', 'posts.category_id', '=', 'categories.id')
  //     ->get();

  private $postsRepository;

  public function __construct(PostsRepository $postsRepository)
  {
    $this->postsRepository = $postsRepository;
  }
  

  public function getAll() {
    $posts = Posts::with(['category', 'layout', 'type', 'city', 'region', 'distance', 'images'])->get();
    return response()->json($posts, 200);
  }

  public function getDataForRecommend()
  {
    $posts = Posts::where('is_recommended', 1)
    ->orderBy('created_at', 'desc')
    ->take(4)
    ->get();

    return response()->json($posts, 200);
  }

  public function getAllFilter(Request $request) {
    $id = $request->id;
 
    if (!is_null($id)) {
      $post = Posts::find($id);
      return response()->json($post, 200);
    } else {
      $filters = $request->only(['price_from', 'price_to']);

      $products = $this->postsRepository->search($filters);

      return response()->json([
        'products' => $products->items(),
        'meta' => [
          'current_page' => $products->currentPage(),
          'last_page' => $products->lastPage(),
          'per_page' => $products->perPage(),
          'total' => $products->total()
        ]
      ]);
    }
  }

  public function getById($id) {
    $post = Posts::with('images')->find($id);
    if(is_null($post)) {
      return response()->json(['error' => true, 'message' => 'Такого поста не существует'], 404);
    } else {
      return response()->json($post, 200);
    }
  }

  public function savePost(Request $req) {
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
      $file->storeAs('uploads'. '/' . $req->name, $uniqueName, 'public');
      $uploadedFile = 'storage/uploads'. '/' . $req->name . '/' . $uniqueName;

      Images::create([
        'url' => $uploadedFile,
        'post_id' => $post->id
      ]);
    }

    return response()->json($post, 201);
  }

  public function editPost(StorePostRequest $req, $id) {
    $post = Posts::find($id);
    if(is_null($post)) {
      return response()->json(['error' => true, 'message' => 'Такого поста не существует'], 404);
    } else {
      $post->update($req->all());
      return response()->json($post, 200);
    }
  }

  public function delPost($id) {

    $post = Posts::find($id);
    if(is_null($post)) {
      return response()->json(['error' => true, 'message' => 'Такого поста не существует'], 404);
    } else {
      $post->delete();
      return response()->json(['message' => 'Пост удален'], 200);
    }
 
  }
}
