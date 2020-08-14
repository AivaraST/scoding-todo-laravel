<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Task;
use App\User;

class TaskAdminController extends Controller
{
    public function index(User $user)
    {
        return response()->json([
            'data' => $user->tasks,
        ]);
    }

    public function show(Task $task)
    {
        return response()->json([
            'data' => $task,
        ]);
    }

    public function store(TaskStoreRequest $request, User $user)
    {

        $validated = $request->validated();

        $task = $user->tasks()->create($validated);

        return response()->json([
            'data' => $task,
        ]);
    }

    public function update(TaskUpdateRequest $request, Task $task)
    {
        $validated = $request->validated();

        foreach ($validated as $field => $value) {
            $task->$field = $value;
        }
        $task->save();

        return response()->json([
            'message' => 'Task data updated successfully',
        ]);
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json([
            'message' => 'User task deleted successfully',
        ]);
    }
}
