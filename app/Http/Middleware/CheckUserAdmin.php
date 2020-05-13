<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Models\User;
// use App\Http\Requests\Request;
use Illuminate\Http\Request;

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
       
        // if ($user->role_id == \HV_ROLES::PERM_ADMIN)
        if (in_array(\HV_ROLES::PERM_ADMIN, User::getPermissions($user->id, \HV_PERMISSIONS::READ_WRITE)))
            return $next($request);
        else{
            // delivering an error
            // if (request::wantsJson()){
            if($request->ajax()) {
                return response()->json([
                    'status'=>1,
                    'messages'=>'Permission denied'
                ]);
            }
            else{
                return redirect()->back()->withErrors(['Permission denied', 'No permissions']);
            }
        }
    }
}