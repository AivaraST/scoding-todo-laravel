<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskUpdateRequest;
use App\Http\Resources\TaskResource;
use App\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $tasks = Auth::user()->tasks;

        return TaskResource::collection($tasks);
    }

    public function update(TaskUpdateRequest $request, Task $task): JsonResponse
    {
        if (!Auth::user()->can('update', $task)) {
            return response()->json([
                'message' => 'Cannot update this task.',
            ], 403);
        }

        $task->update($request->validated());

        return response()->json([
            'message' => 'Task data updated successfully',
        ]);
    }
}
