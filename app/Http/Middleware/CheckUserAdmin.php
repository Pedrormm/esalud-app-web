<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
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
       
        if (in_array(\HV_ROLES::PERM_ADMIN, User::getPermissions($user->id, \HV_PERMISSIONS::READ_WRITE)))
            return $next($request);
        else{
            //delivering an error
            if (Request::wantsJson()){
                return response()->json([
                    'status'=>1,
                    'messages'=>'Permission denied'
                ]);
            }
            else{
                return Redirect::back()->withErrors(['msg', 'The Message']);
            }

        }
    }
}
