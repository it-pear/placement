<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Types;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function getAll()
    {
        return response()->json(Types::get(), 200);
    }
    public function getById($id)
    {
        $type = Types::find($id);
        if (is_null($type)) {
            return response()->json(['error' => true, 'message' => 'Такого Типа квартиры не существует'], 404);
        } else {
            return response()->json($type, 200);
        }
    }
    public function saveType(Request $req)
    {
        $type = Types::create($req->all());
        return response()->json($req->all(), 201);
    }
    public function delType($id)
    {
        $type = Types::find($id);
        if (is_null($type)) {
            return response()->json(['error' => true, 'message' => 'Такого поста не существует'], 404);
        } else {
            $type->delete();
            return response()->json(['message' => 'Пост удален'], 200);
        }
    }
}
