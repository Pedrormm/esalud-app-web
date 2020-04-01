<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
class CheckUserAdmin
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
        $user = Auth::user();
       
        if (in_array(HV_ROLES::PERM_ADMIN, User::getPermissions($user->id, HV_PERMISSIONS::READ_WRITE)))
            return $next($request);
        else 

    }
}
