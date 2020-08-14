<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        $token = auth()->attempt($credentials);

        if(!$token) {
            return response()->json([
                'error' => 'Bad email/password, try again.'
            ], 401);
        }

        return response()->json([
            'token' => $token
        ]);
    }
}
