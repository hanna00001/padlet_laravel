<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAllUsers():JsonResponse{
        $users = User::with([])->get();
        return response()->json($users, 200);
    }

    public function getSingleUser (string $id) : JsonResponse {
        $user = User::where('id', $id)->first();
        return $user != null ? response()->json($user, 200) : response()->json(null, 200);
    }
}
