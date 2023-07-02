<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Citys;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class CatalogIdController extends Controller
{

    // запрос должен быть admin
    public function getData() {
        $properties = DB::table('properties')->get();
        $citys = Citys::with('region')->get();
        $categories = DB::table('categories')->get();
        $advantages = DB::table('advantages')->get();
        $types = DB::table('types')->get();
        $distances = DB::table('distances')->get();
        $layouts = DB::table('layouts')->get();

        $array = [
            'properties' => $properties, 
            'citys' => $citys, 
            'categories' => $categories, 
            'advantages' => $advantages,
            'types' => $types,
            'distances' => $distances,
            'layouts' => $layouts,
        ];

        return response()->json($array, 200);
    }
}
