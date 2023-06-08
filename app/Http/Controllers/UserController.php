<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function getAll()
    {
        $users = User::get();
        return response()->json($users, 200);
    }

    public function getById($id)
    {
        $user = User::find($id);
        if (is_null($user)) {
            return response()->json(['error' => true, 'message' => 'Такого пользователя не существует'], 404);
        } else {
            return response()->json($user, 200);
        }
    }

    public function editUser(Request $req, $id)
    {
        $justUser = auth()->user();
        $role = $justUser->role;

        $user = User::find($id);

        $data = [];
        $data['name'] = $req->name ? $req->name : $user->name;
        $data['role'] = $req->role ? $req->role : $user->role;

        if ($data['role'] >= 1) {
            $data['role'] = 1;
        } else {
            $data['role'] = 0;
        }

        if (is_null($user)) {
            return response()->json(['error' => true, 'message' => 'Такого пользователя не существует'], 404);
        } else {
            $user->update($data);
            return response()->json($user, 200);
        }
    }

    public function delUser($id)
    {

        $user = User::find($id);
        if (is_null($user)) {
            return response()->json(['error' => true, 'message' => 'Такого пользователя не существует'], 404);
        } else {
            $user->delete();
            return response()->json(['message' => 'Услуга удалена'], 200);
        }
    }
}
