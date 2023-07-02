<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function getAll() {
        return response()->json(Categories::get(), 200);
    }
    public function getById($id) {
        $category = Categories::find($id);
        if(is_null($category)) {
            return response()->json(['error' => true, 'message' => 'Такого поста не существует'], 404);
        } else {
            return response()->json($category, 200);
        }
    }
    public function saveCategory(Request $req) {
        $category = Categories::create($req->all());
        return response()->json($category, 201);
    }
    public function updateCategory(Request $request, $id)
    {
        $category = Categories::findOrFail($id);
        $category->update($request->all());
        return response()->json($category, 200);
    }
    public function delCategory($id) {
        $category = Categories::find($id);
        if(is_null($category)) {
            return response()->json(['error' => true, 'message' => 'Такого поста не существует'], 404);
        } else {
            $category->delete();
            return response()->json(['message' => 'Пост удален'], 200);
        }
    }
}
