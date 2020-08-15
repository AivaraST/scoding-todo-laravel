<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskUpdateRequest;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index($sortName = null, $sortType = 'desc')
    {
        $user = Auth::user();
        $responseData = [];

        if($sortName !== null) {
            $responseData = $user->tasks()->orderBy($sortName, $sortType)->get();
        } else {
            $responseData = $user->tasks;
        }

        return response()->json([
            'data' => $responseData,
        ]);
    }

    public function update(TaskUpdateRequest $request, Task $task)
    {
        if ($task->user_id !== Auth::user()->id) {
            return response()->json([
                'error' => 'ne čia',
            ],401);
        }

        $validated = $request->validated();

        foreach ($validated as $field => $value) {
            $task->$field = $value;
        }
        $task->save();

        return response()->json([
            'message' => 'Task data updated successfully',
        ]);
    }
}
