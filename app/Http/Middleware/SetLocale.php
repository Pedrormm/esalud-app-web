<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $language = 'es';

        $currentUser = auth()->user();
        if (is_null($currentUser) || empty($currentUser)){
            if (session()->has('lang')){
                $language = session()->get('lang');
            }
        }
        else{
            $language = $currentUser->language;
        }
        app()->setLocale($language);
        return $next($request);
    }
}
