<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Distances;
use Illuminate\Http\Request;

class DistanceController extends Controller
{
    public function getAll() {
        return response()->json(Distances::get(), 200);
    }
    public function getById($id) {
        $distance = Distances::find($id);
        if(is_null($distance)) {
            return response()->json(['error' => true, 'message' => 'Такой дистанции не существует'], 404);
        } else {
            return response()->json($distance, 200);
        }
    }
    public function saveDistance(Request $req) {
        $distance = Distances::create($req->all());
        return response()->json($distance, 201);
    }
    public function updateDistance(Request $request, $id)
    {
        $distance = Distances::findOrFail($id);
        $distance->update($request->all());
        return response()->json($distance, 200);
    }
    public function delDistance($id) {
        $distance = Distances::find($id);
        if(is_null($distance)) {
            return response()->json(['error' => true, 'message' => 'Такой дистанции не существует'], 404);
        } else {
            $distance->delete();
            return response()->json(['message' => 'Дистанция удалена'], 200);
        }
    }
}
