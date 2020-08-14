<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskStoreRequest;
use App\Task;
use App\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(User $user)
    {
        return response()->json([
            'data' => $user->tasks,
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json([
            'message' => 'User task deleted successfully',
        ]);
    }
}
