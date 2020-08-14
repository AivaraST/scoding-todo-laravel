<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\User;

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

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        if($validated['password'] !== $validated['password_repeat']) {
            return response()->json([
                'error' => 'Passwords does not match each other.'
            ], 401);
        }

        unset($validated['password_repeat']);
        $validated['password'] = bcrypt($validated['password']);

        $user = User::create($validated);

        return response()->json([
            'data' => $user,
        ]);
    }
}
