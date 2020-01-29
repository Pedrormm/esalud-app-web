<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserLogged
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
        if (is_null($user)){
            $request->session()->flash('info', 'Tu sesion ha caducado por inactividad');
            
            return redirect('/');
        }

        return $next($request);
    
    }
}
