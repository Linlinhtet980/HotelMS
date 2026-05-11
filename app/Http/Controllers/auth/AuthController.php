<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        return view('auth.auth', ['mode' => 'login']);
    }

    public function register(Request $request){
        return view('auth.auth', ['mode' => 'register']);
    }
}
