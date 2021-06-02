<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
// Middleware alias es 'isLogged'
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
        
        if($request->ajax() && is_null($user)) {
            // throw new \Exception("quiero salir ya!");
            $request->session()->flash('info', \Lang::get('messages.your_session_has_expired_due_to_inactivity_you_will_need_to_login_again'));
            return redirect('/');
            return '<div class="alert alert-dange">Void call</div>';
            
        }
        else {
            if (is_null($user)){
                $request->session()->flash('info', \Lang::get('messages.your_session_has_expired_due_to_inactivity_you_will_need_to_login_again'));
                
                return redirect('/');
            }
        }
        return $next($request);
    
    }
}
