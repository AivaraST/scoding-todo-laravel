<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\User;

class UserAdminController extends Controller
{
    // Find all users.
    public function index()
    {
        return UserResource::collection(User::all());
    }

    // Find one user.
    public function show(User $user)
    {
        return new UserResource($user);
    }

    // Create new user.
    public function store(UserStoreRequest $request)
    {
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        return response()->json([
            'data' => $user
        ]);
    }

    // Update current user.
    public function update(UserUpdateRequest $request, User $user)
    {
        $validated = $request->validated();

        foreach ($validated as $field => $value) {
            if($field === 'password') {
                $value = bcrypt($value);
            }
            $user->$field = $value;
        }
        $user->save();

        return response()->json([
            'message' => 'User data updated successfully',
        ]);
    }

    // Delete user.
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'message' => 'User data deleted successfully',
        ]);
    }
}
