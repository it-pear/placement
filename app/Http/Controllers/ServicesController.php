<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Services;
use App\Http\Requests\StoreServiceRequest;

class ServicesController extends Controller
{
    
    public function checkAuth() {
        try {
            $user = auth()->userOrFail();
        } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
        }
    }

    public function getAll() {
        $services = Services::get();
        return response()->json($services, 200);
    }

    public function getDataForRecommend()
    {
      $services = Services::where('is_recommended', 1)
        ->orderBy('created_at', 'desc')
        ->take(4)
        ->get();

      return response()->json($services, 200);
    }

    public function getById($id) {
        $service = Services::find($id);
        if(is_null($service)) {
            return response()->json(['error' => true, 'message' => 'Такой услуги не существует'], 404);
        } else {
            return response()->json($service, 200);
        }
    }

    public function saveService(Request $req) {
        if ($this->checkAuth()) {
            return $this->checkAuth();
        } else {
            $file = $req->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $newPath = 'public/uploads/'. $req->name. '/' . $filename;
            $file->move('public/uploads'. '/' . $req->name, $filename);
            
            $data = $req->all();
            $data['image'] = $newPath;

            $service = Services::create($data);
                
            return response()->json($service, 201);
        }
    }
    
    public function editService(Request $req, $id) {
        if ($this->checkAuth()) {
            return $this->checkAuth();
        } else {
            $service = Services::find($id);
            if(is_null($service)) {
                return response()->json(['error' => true, 'message' => 'Такой услуги не существует'], 404);
            } else {
                $file = $req->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $newPath = 'public/uploads/'. $req->name. '/' . $filename;
                $file->move('public/uploads'. '/' . $req->name, $filename);
                
                $data = $req->all();
                $data['image'] = $newPath;

                $service->update($data);
                return response()->json($service, 200);
            }
        }
    }
    
    public function delService($id) {
        if ($this->checkAuth()) {
            return $this->checkAuth();
        } else {
            $service = Services::find($id);
            if(is_null($service)) {
                return response()->json(['error' => true, 'message' => 'Такой услуги не существует'], 404);
            } else {
                $service->delete();
                return response()->json(['message' => 'Услуга удалена'], 200);
            }
        }
    }
    
}