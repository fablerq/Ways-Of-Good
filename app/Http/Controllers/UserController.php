<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserID(){
        return response()->json(Auth::id());
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserInfo(){
        return response()->json(Auth::user());
    }
}
