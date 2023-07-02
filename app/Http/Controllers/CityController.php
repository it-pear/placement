<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Citys;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function getAll() {
        return response()->json(Citys::get(), 200);
    }
    public function getById($id) {
        $city = Citys::find($id);
        if(is_null($city)) {
            return response()->json(['error' => true, 'message' => 'Такого города не существует'], 404);
        } else {
            return response()->json($city, 200);
        }
    }
    public function saveCity(Request $req) {
        $city = Citys::create($req->all());
        return response()->json($city, 201);
    }
    public function updateCity(Request $request, $id)
    {
        $city = Citys::findOrFail($id);
        $city->update($request->all());
        return response()->json($city, 200);
    }
    public function delCity($id) {
        $city = Citys::find($id);
        if(is_null($city)) {
            return response()->json(['error' => true, 'message' => 'Такого города не существует'], 404);
        } else {
            $city->delete();
            return response()->json(['message' => 'Города удален'], 200);
        }
    }

}
