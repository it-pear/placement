<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Layouts;
use Illuminate\Http\Request;

class LayoutController extends Controller
{
    public function getAll()
    {
        return response()->json(Layouts::get(), 200);
    }
    public function getById($id)
    {
        $layout = Layouts::find($id);
        if (is_null($layout)) {
            return response()->json(['error' => true, 'message' => 'Такого Типа квартиры не существует'], 404);
        } else {
            return response()->json($layout, 200);
        }
    }
    public function saveLayout(Request $req)
    {
        $layout = Layouts::create($req->all());
        return response()->json($layout, 201);
    }
    public function delLayout($id)
    {
        $layout = Layouts::find($id);
        if (is_null($layout)) {
            return response()->json(['error' => true, 'message' => 'Такого поста не существует'], 404);
        } else {
            $layout->delete();
            return response()->json(['message' => 'Пост удален'], 200);
        }
    }
}
