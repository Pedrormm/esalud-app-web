<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Route;
use App\Models\User;
use Session;
use Auth;


function routeInRegex($requestPath) {
    // $rutasTemplates = [
    //     'algo/{number}/pascual',
    //     'algo/sinId',
    //     'users/{number}/edita',
    //     'ownRecord'
    // ];

    return preg_replace("/\d+/", "{number}", $requestPath);

    // $rutaCorregida = preg_replace("/\d+/", "{number}", $requestPath);
    
    // return in_array($rutaCorregida, $rutasTemplates); 
}

class CheckPermissionRoutes
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
        $permissionRoutesBD = Route::with('permission')->get()->toArray();

        $permissionsRoutesAux = [];
        $permissionRoutes = [];
        foreach ($permissionRoutesBD as &$permissionsRoutesAux) {
            $permissionRoutes[$permissionsRoutesAux['name']][] = $permissionsRoutesAux["permission"]['flag_meaning'];
        }
        // dd($permissionRoutes);

        $permUser = User::with('role.rolesPermissionsEnabled.permission')->where("users.id",Auth::user()->id)->get()->toArray();

        $permissionsAux = [];
        $permissionsAssociated = [];
        foreach ($permUser[0]['role']['roles_permissions_enabled'] as &$permissionsAux) {
            $permissionsAssociated[] = $permissionsAux['permission']['flag_meaning'];
        }
        // dd($permissionsAssociated);

        if(!isset($permissionRoutes[routeInRegex($request->path())])) {
            // dd("4");
            return $next($request);
        }
        // dd($permissionsAssociated);
        if(!array_intersect($permissionRoutes[routeInRegex($request->path())], $permissionsAssociated)) {
            // dd("3");
            if($request->wantsJson()) {
                return response()->json([]);
            }

            Session::put('info', 'Permission denied');
            // $request->session()->reflash();
            // $request->session()->keep(['info']);
            // $request->session()->save();
            //  dd(session()->all());
            return redirect('/');
        }
        // dd("2");
   
        return $next($request);
    }
}
