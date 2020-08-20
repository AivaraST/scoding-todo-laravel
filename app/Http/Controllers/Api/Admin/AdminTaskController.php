<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Http\Resources\TaskResource;
use App\Task;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminTaskController extends Controller
{
    /**
     * Get all user tasks
     * @param User $user
     * @return TaskResource
     */
    public function index(User $user): JsonResource
    {
        return TaskResource::collection($user->tasks);
    }

    /**
     * Get single user task
     * @param Task $task
     * @return JsonResponse
     */
    public function show(Task $task): JsonResponse
    {
        return response()->json($task);
    }

    /**
     * Create user task
     * @param TaskStoreRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function store(TaskStoreRequest $request, User $user): JsonResponse
    {
        $validated = $request->validated();
        $task = $user->tasks()->create($validated);

        return response()->json($task);
    }

    /**
     * Update user task
     * @param TaskUpdateRequest $request
     * @param Task $task
     * @return JsonResponse
     */
    public function update(TaskUpdateRequest $request, Task $task): JsonResponse
    {
        $validated = $request->validated();
        $task->update($validated);

        return response()->json(['message' => 'Task updated successfully.']);
    }

    /**
     * Delete user task
     * @param Task $task
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json(['message' => 'Task deleted successfully.']);
    }
}
