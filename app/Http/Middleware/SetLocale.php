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
        // if (session()->get('lang')){
        if (session()->has('lang')){
            $language = session()->get('lang');
        }
        app()->setLocale($language);
        return $next($request);
    }
}
