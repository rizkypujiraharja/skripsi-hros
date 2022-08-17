<?php

namespace App\Http\Middleware;

use Closure;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $user = $request->user();
        if ($user == null) {
            abort(403);
        }

        $roles = explode("|", $role);
        if (!in_array($user->role, $roles)) {
            abort(403);
        }

        return $next($request);
    }
}
