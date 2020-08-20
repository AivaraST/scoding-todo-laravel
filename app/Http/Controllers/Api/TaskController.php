<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskUpdateRequest;
use App\Http\Resources\TaskResource;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return TaskResource::collection(Auth::user()->tasks);
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
