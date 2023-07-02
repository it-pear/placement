<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Regions;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function getAll()
    {
        return response()->json(Regions::get(), 200);
    }
    public function getById($id)
    {
        $region = Regions::find($id);
        if (is_null($region)) {
            return response()->json(['error' => true, 'message' => 'Такого района не существует'], 404);
        } else {
            return response()->json($region, 200);
        }
    }
    public function saveRegion(Request $req)
    {
        $region = Regions::create($req->all());
        return response()->json($region, 201);
    }
    public function updateRegion(Request $request, $id)
    {
        $region = Regions::findOrFail($id);
        $region->update($request->all());
        return response()->json($region, 200);
    }
    public function delRegion($id)
    {
        $region = Regions::find($id);
        if (is_null($region)) {
            return response()->json(['error' => true, 'message' => 'Такого района не существует'], 404);
        } else {
            $region->delete();
            return response()->json(['message' => 'Пост удален'], 200);
        }
    }
}
