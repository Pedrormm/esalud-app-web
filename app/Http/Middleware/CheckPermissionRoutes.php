<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Role;
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
        $permissionRoutes = [
            'ownRecord2' => [
                'USER_MANAGEMENT_CREATE__',
                'OWN_MEDICAL_RECORD_SHOW_',
            ],
            'ownRecord' => [
                'USER_MANAGEMENT_EDIT___',
                'OWN_MEDICAL_RECORD_SHOW_',
            ],
            'users/{number}/edit' => [
                'ALL_USERS_SHOW_',
                'OWN_MEDICAL_RECORD_SHOW_',
            ],
            
        ];
        // $routeList = \Route::getRoutes();

        // dd($routeList);	

        // $permUser = Role::with('rolesPermissionsEnabled.permission')->where("id",Auth::user()->id)->get();

        $permUser = User::with('role.rolesPermissionsEnabled.permission')->where("users.id",Auth::user()->id)->get()->toArray();

        // $permUser = User::with('getEnabledPermission.permission')->where("id",Auth::user()->id)->get();

        // $data = Patient::select('users.*','patients.*','roles.name AS role_name', 'patients.id AS patients_id', 
        // 'users.id AS users_id')
        // ->join('users', 'patients.user_id', 'users.id')->join('roles', 'users.role_id', 'roles.id')->where("users.deleted_at",null);

        // $data = User::select('users.*','permissions.flag_meaning AS flag_meaning')
        // ->join('roles', 'roles.id', 'users.role_id')
        // ->join('roles_permissions', 'roles_permissions.role_id', 'users.id')
        // ->join('permissions', 'permissions.id', 'roles_permissions.permission_id')
        // ->where("users.deleted_at",null)->where("users.id",Auth::user()->id)->where("roles_permissions.activated",1)->get();

        // dd($data->toArray());
        // SELECT * FROM users u INNER JOIN roles r ON r.id=u.role_id INNER JOIN roles_permissions rp on rp.role_id=r.id INNER JOIN permissions p ON p.id=rp.permission_id

        // $permissionsReal = [];
        // $permUser->each(function ($user) use(&$permissionsReal) {
        //     $user->role->each(function($p) use(&$permissionsReal) {
        //         dd($p->rolesPermissionsEnabled->toArray());
        //         $permissionsReal[] = $permission->permission->flag_meaning;
        //     });
        // });
        // dd($permissionsReal);

        // dd($permUser->toArray());

        // dd($permUser);
        $permissionsAux = [];
        $permissionsAssociated = [];
        foreach ($permUser[0]['role']['roles_permissions_enabled'] as &$permissionsAux) {
            $permissionsAssociated[] = $permissionsAux['permission']['flag_meaning'];
        }
        // dd($permissionsAssociated);


        // dd(routeInRegex($request->path()));


        // dd($permUser->toArray());
        // dd($request->path());
        if(!isset($permissionRoutes[routeInRegex($request->path())])) {
            dd("4");
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
        else{
            dd("1");
        }
        dd("2");



        
        return $next($request);
    }
}
