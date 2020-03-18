<?php

namespace App\Http\Middleware;
use Illuminate\Contracts\Auth\Guard;
use Closure;
use Session;

class CheckUserRole
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        switch ($this->auth->user()->role_id) {
            case '1':
              //Paciente
            break;         

            case '2':
              //Doctor
            break;

            case '3':
                //Auxiliar (Helper)
            break;

            case '4':
                //Admin
            break;

            default:
                $this->auth->logout();

                if ($request->ajax())
                    return response('Unauthorized.', 401);
                else
                    return redirect()->to('login');
            break;
        }

        return $next($request);
    }
}
