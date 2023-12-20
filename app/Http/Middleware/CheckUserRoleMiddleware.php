<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use App\Models\User;
use Auth;
use Closure;


class CheckUserRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (auth()->check()) {
            $user = auth()->user();

            $role_has_permissions = Permission::where('role_id', $user->role_id)->pluck('routes')->toArray();

            $role_has_permissions = array_unique($role_has_permissions);

            $users = User::join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', $user->id)->select('roles.role_name as roleName')->first();

            session(['user_role' => $users->roleName, 'user_permissions' => json_encode($role_has_permissions)]);

        }
        return $next($request);
    }
}