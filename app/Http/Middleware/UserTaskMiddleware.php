<?php

namespace App\Http\Middleware;

use App\Task;
use Closure;

class UserTaskMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param Task $task
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = auth()->user();
        $task = $request->route()->parameter('task');

        if($user->id !== $task->user_id) {
            return response()->json(['error' => 'This is not your task']);
        }

        return $next($request);
    }
}
