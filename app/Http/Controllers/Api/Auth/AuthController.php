<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\User;
use Carbon\Carbon;

class AuthController extends Controller
{
    // Login method for authentication
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        $token = auth()->attempt($credentials, ['exp' => Carbon::now()->addDays(7)->timestamp]);

        if(!$token) {
            return response()->json([
                'messages' => [
                    'password' => [
                        'Bad password, try again.'
                    ]
                ]
            ], 401);
        }

        return response()->json([
            'token' => $token
        ]);
    }

    // Register method for authentication
    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        if($validated['password'] !== $validated['password_repeat']) {
            return response()->json([
                'messages' => [
                    'password' => [
                        'Passwords does not match each other.'
                    ],
                    'password_repeat' => [
                        'Passwords does not match each other.'
                    ]
                ]
            ], 401);
        }

        unset($validated['password_repeat']);
        $validated['password'] = bcrypt($validated['password']);

        $user = User::create($validated);

        return response()->json([
            'data' => $user,
        ]);
    }

    public function user()
    {
        $user = auth()->user();

        return response()->json([
            'name' => $user->name,
            'email' => $user->email
        ]);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json([
            'message' => 'Logged out successfully.',
        ]);
    }
}
