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
use App\Models\User;
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

        $roles = Role::join('users', 'roles.user_id_creator', 'users.id')
        ->select(DB::raw('roles.id as idRole, roles.name as nameRole, user_id_creator, users.id as idUser,
        users.name as nameUser, lastname, dni, role_id'))
        ->orderBy('roles.id')->get();

        foreach($roles as $rol){
            $count = DB::table("users")->where('role_id', $rol->idRole)->get()->count();
            $rol->count = $count;
        }

        return view('adjustments/roleManagement', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new Role.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'min:2',
                'max:50',
                Rule::unique('roles')->where(function ($query) {
                    return $query->where('deleted_at', NULL);
                })
            ],
        ]);

        if($validator->fails()){
            $errors = implode(',',$validator->messages()->all());
            return $this->jsonResponse(1, $errors);
        }

        $role = new Role;
        $role->name = $request->name;
        $role->user_id_creator = $user->id;
        $role->save();

        $numberPermissions = Permissions::get()->count();
        $maxRoleId = RolePermission::max('role_id');

        $data = array();
        for ($i = 1; $i <= $numberPermissions; $i++) {
            $radio="optradio".$i;
            $data[] =[
                        'role_id' => $maxRoleId+1,
                        'permission_id' => $i,
                        'value' => $request->$radio,
                        'value_name' => getValueName($request->$radio),
                    ];                 
        }
        RolePermission::insert($data);

        return $this->jsonResponse(0, "El rol ".$request->name." ha sido creado");
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
        $roles = Role::with('rolesPermissions.permission')->find($id);
        $roles = $roles->toArray();
        $permissions = Permissions::all();
        if (empty($roles)) {
            Flash::error('Role not found');

            return redirect(route('roles.index'));
        }

        return view('adjustments.roleEdit',['roles' => $roles,'permissions' => $permissions]);
    }

    /**
     * Update the specified Role in storage.
     *
     * @param int $id
     * @param UpdateRoleRequest $request
     *
     * @return Response
     */
    public function update(Request $request)
    {
        if($request->ajax()) {
            if ($request->idRole != \HV_ROLES::PERM_ADMIN){
                $requestdata = $request->all();
                $role = Role::find($request->idRole);
               
                $validator = Validator::make($request->all(), [
                    'name' => [
                        'required',
                        'string',
                        'min:2',
                        'max:50',
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
                        $role_permission->value_name = getValueName($value);
                        $role_permission->save();
                    }
                }
                return $this->jsonResponse(0, "El rol ".$request->name." ha sido editado correctamente");
            }
            else{
                return $this->jsonResponse(1, "Permiso denegado"); 
            }
        }
        else{
            return $this->jsonResponse(1, "Permiso denegado");
        }

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

    public function usersRolesView($id, string $searchPhrase=null){
        $usersRole = Role::with('user1s')->where('id',$id)->get();
        $usersRole = $usersRole->toArray();

        $usersNotInRole = Role::select('roles.name as role_name', 'users.id', 'users.name', 
        'users.lastname', 'users.dni', 'users.birthdate','users.sex','users.email','users.blood','users.role_id' )
        ->join('users', 'users.role_id', 'roles.id')->where('users.role_id', '<>', $id)
        ->get();

        $grouped = $usersNotInRole->groupBy('role_name');

        $roles = Role::orderBy('id')->get();

        $allUsers = User::with('role')->orderBy('users.id')->get();
        $allUsers = $allUsers->groupBy('id')->toArray();

        return view('adjustments.usersRoleEdit',['id' => $id,'allUsers' => $allUsers, 'usersNotInRole' => $grouped,
         'usersRole' => $usersRole, 'roles' => $roles]);
    }

    public function editNotInRole($id){

        $usersNotInRole = Role::select('roles.name as role_name', 'users.id', 'users.name', 
        'users.lastname', 'users.dni', 'users.birthdate','users.sex','users.email','users.blood','users.role_id' )
        ->join('users', 'users.role_id', 'roles.id')->where('users.role_id', '<>', $id)
        ->get();

        $grouped = $usersNotInRole->groupBy('role_name');

        $roles = Role::orderBy('id')->get();

        $allUsers = User::with('role')->orderBy('users.id')->get();
        $allUsers = $allUsers->groupBy('id')->toArray();

        return view('adjustments.usersNotInRoleEdit',['allUsers' => $allUsers, 'usersNotInRole' => $grouped,
        'roles' => $roles]);
    }


    public function updateNotInRole(Request $request)
    {
        $requestData = $request->all();
        $retrievedData = [];

        foreach($requestData as $key => $value){
            $user_to_change = User::find($key);
            $user_to_change->role_id = $value;
            $user_to_change->save();
            array_push($retrievedData, $user_to_change->toArray());
        }

        $response = "Se han modificado los roles de los siguientes usuarios: ";
        foreach ($retrievedData as $key => $value) {
            $role_name = Role::find($value["role_id"]);
            $value['role_name']=$role_name->toArray();
            $eachResponse = "<br> Al usuario ".$value["name"]." ".$value["lastname"]." con id ".$value["id"]
            ." se le ha asignado el rol ".$value["role_name"]["name"];
            $response .= $eachResponse;
        }

        return $this->jsonResponse(0, $response);
    }

    public function newRole(){
        $permissions = Permissions::get()->toArray();

        return view('adjustments.newRole',['permissions' => $permissions]);
    }

    public function confirmDeleteRole(){
        $roles = Role::find($id);

        return view('adjustments.confirmDeleteRole',['roles' => $roles]);
    }
    

    public function ajaxUserRolesDatatable($id){
        $uRoles = Role::with('user1s')->where('id',$id)->get()->toArray();
        $uRoles=$uRoles[0]["user1s"];

        return response()->json(['data' => $uRoles]);
    }

    public function ajaxViewMainRolesDatatable(){
        $mRoles = Role::join('users', 'roles.user_id_creator', 'users.id')
        ->select(DB::raw('roles.id as idRole, roles.name as nameRole, user_id_creator, users.id as idUser,
        users.name as nameUser, lastname, dni, role_id'))
        ->orderBy('roles.id')->get();

        foreach($mRoles as $rol){
            $count = DB::table("users")->where('role_id', $rol->idRole)->get()->count();
            $rol->count = $count;
        }

        return response()->json(['data' => $mRoles]);

    }
}
