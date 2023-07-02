<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Properties;
use Illuminate\Http\Request;

class PropertiesController extends Controller
{
    public function getAll() {
        return response()->json(Properties::get(), 200);
    }
    public function getById($id) {
        $property = Properties::find($id);
        if(is_null($property)) {
            return response()->json(['error' => true, 'message' => 'Такого Типа не существует'], 404);
        } else {
            return response()->json($property, 200);
        }
    }
    public function saveProperty(Request $req) {
        $property = Properties::create($req->all());
        return response()->json($req->all(), 201);
    }
    public function updateProperty(Request $request, $id)
    {
        $property = Properties::findOrFail($id);
        $property->update($request->all());
        return response()->json($property, 200);
    }
    public function delProperty($id) {
        $property = Properties::find($id);
        if(is_null($property)) {
            return response()->json(['error' => true, 'message' => 'Такого типа не существует'], 404);
        } else {
            $property->delete();
            return response()->json(['message' => 'Пост удален'], 200);
        }
    }
}
