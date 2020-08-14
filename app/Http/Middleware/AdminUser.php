<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$user = Auth::user()) {
            return response()->json([
                'error' => 'Only for administrators.',
            ], 401);
        }

        if(!$user->isAdministrator()) {
            return response()->json([
                'error' => 'Only for administrators.',
            ], 401);
        }

        return $next($request);
    }
}
