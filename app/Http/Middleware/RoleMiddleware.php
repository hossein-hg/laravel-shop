<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @param $role
     * @param null $permission
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,$role,$permission = null)
    {
        if (!$request->user()->hasRoles($role) && $permission == null)
        {

            abort(403);
        }
        else if (!$permission == null && !$request->user()->can($permission)){

            abort(403);
        }
        return $next($request);
    }
}
