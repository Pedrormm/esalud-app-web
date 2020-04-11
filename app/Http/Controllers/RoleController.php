<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Repositories\RoleRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use DB;
use Flash;
use Response;
use App\Models\Role;
use App\Models\RolePermission;
use App\Models\Permissions;



class RoleController extends AppBaseController
{
    /** @var  RoleRepository */
    private $roleRepository;

    public function __construct(RoleRepository $roleRepo)
    {
        $this->roleRepository = $roleRepo;
    }

    /**
     * Display a listing of the Role.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $roles = Role::join('users', 'roles.user_id_creator', 'users.id')
        ->select(DB::raw('roles.id as idRole, roles.name as nameRole, user_id_creator, users.id as idUser,
        users.name as nameUser, lastname, dni, role_id'))
        ->orderBy('roles.id')->get();
        //dd($roles->toArray());
        /*$roles->map(function($rol) {
            $rol->count =DB:goiaghaogag;
            return $rol;
        });*/
        return view('adjustments/roleManagement', ['roles' => $roles,'user' => $user]);
    }

    /**
     * Show the form for creating a new Role.
     *
     * @return Response
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created Role in storage.
     *
     * @param CreateRoleRequest $request
     *
     * @return Response
     */
    public function store(CreateRoleRequest $request)
    {
        $input = $request->all();

        $role = $this->roleRepository->create($input);

        Flash::success('Role saved successfully.');

        return redirect(route('roles.index'));
    }

    /**
     * Display the specified Role.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            Flash::error('Role not found');

            return redirect(route('roles.index'));
        }

        return view('roles.show')->with('role', $role);
    }

    /**
     * Show the form for editing the specified Role.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit(int $id)
    {
        $user = Auth::user();
        $roles = Role::with('rolesPermissions.permission')->find($id);
        $roles = $roles->toArray();
        $permissions = Permissions::all();
        if (empty($roles)) {
            Flash::error('Role not found');

            return redirect(route('roles.index'));
        }

        return view('adjustments.roleEdit',['roles' => $roles,'permissions' => $permissions,'user' => $user]);
    }

    /**
     * Update the specified Role in storage.
     *
     * @param int $id
     * @param UpdateRoleRequest $request
     *
     * @return Response
     */
    // Es el post que lo guarda en BD
    public function update(Request $request)
    {
        //return $this->jsonResponse(0, "El rol ".$request->name." ha sido editado correctamente");
        //var_dump($all);
        //return response()->json(['all' => $all]);

       // die();
        if($request->ajax()) {
            $requestdata = $request->all();

            $role = Role::find($request->idRole);
           
            $validator = Validator::make($request->all(), [
                'name' => [
                    'required',
                    'string',
                    'min:2',
                    'max:150',
                    Rule::unique('roles')->ignore($role->id)->where(function ($query) {
                        return $query->where('deleted_at', NULL);
                    })
                ],
            ]);

            if($validator->fails()){
                $errors = implode(',',$validator->messages()->all());
                return $this->jsonResponse(1, $errors);
            }

            $role->name = $request->name;

            $role->save();

            foreach($requestdata as $key => $value){
                if(strpos($key,'optradio')!==false){
                    $role_permission_id = str_replace('optradio','',$key);
                    $role_permission = RolePermission::find($role_permission_id);
                    $role_permission->value = $value;
                    $value_name = '';
                    switch($value){
                        case 0:
                            $value_name = 'NONE';
                        break;
                        case 1:
                            $value_name = 'READ';
                        break;
                        case 2:
                            $value_name = 'READ_AND_WRITE';
                        break;
                    }
                    $role_permission->value_name = $value_name;
                    $role_permission->save();
                }
            }

            
            
            //$role->save();
            ///return response()->json(['message' => 'Actualizado correctamente', 'url' => '/expediente']);

            return $this->jsonResponse(0, "El rol ".$request->name." ha sido editado correctamente");
        }
//        return redirect()->back();
        /*
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            Flash::error('Role not found');

            return redirect(route('roles.index'));
        }

        $role = $this->roleRepository->update($request->all(), $id);

        Flash::success('Role updated successfully.');

        return redirect(route('roles.index'));
        */
    }

    /**
     * Remove the specified Role from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            Flash::error('Role not found');

            return redirect(route('roles.index'));
        }

        $this->roleRepository->delete($id);

        Flash::success('Role deleted successfully.');

        return redirect(route('roles.index'));
    }
}
