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
use App\Models\Patient;
use App\Models\Staff;
use App\Models\Role;
use App\Models\RolePermission;
use App\Models\Permission;



class RoleController extends AppBaseController
{
    /** @var  RoleRepository */
    private $roleRepository;

    public function __construct(RoleRepository $roleRepo)
    {
        $this->roleRepository = $roleRepo;
    }

    /**
     * Displays a listing of the current Roles.
     * @author Pedro
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
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

        return view('roles/index', ['roles' => $roles]);
    }


    /**
     * Shows the form for creating a new Role.
     * Endpoint: roles/create
     * @author Pedro
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */ 
    public function create(){
        $permissions = Permission::get()->toArray();
        return view('roles.create',['permissions' => $permissions]);
    }

    /**
     * Stores a newly created Role in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
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

        $requestData = $request->all();
        $role = new Role;
        $role->name = $request->name;
        $role->user_id_creator = $user->id;
        $role->save();

        $numberPermission = Permission::get()->count();
        // $maxRoleId = RolePermission::max('role_id');
        $maxRoleId = Role::max('id')-1;
        $data = array();

        for ($i = 1; $i <= $numberPermission; $i++) {
            $data[] =[
                'role_id' => $maxRoleId+1,
                'permission_id' => $i,
                'activated' => 0,
            ];               
        }
        foreach($requestData as $key => $value){
            if(strpos($key,'check-')!==false){
                $role_permission_id = str_replace('check-','',$key);
                $data[$role_permission_id - 1]["activated"]= 1;
            }
        }
        RolePermission::insert($data); 
        return $this->jsonResponse(0, \Lang::get('messages.the_role')." ".$request->name." ".\Lang::get('messages.has_been_created'));
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
            Flash::error(\Lang::get('messages.role_not_found'));

            return redirect(route('roles.index'));
        }

        return view('roles.show')->with('role', $role);
    }

    /**
     * Shows the form for editing the specified Role.
     * @author Pedro
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit(int $id)
    {
        $roles = Role::with('rolesPermissions.permission')->find($id);
        $roles = $roles->toArray();
        $permissions = Permission::all();
        if (empty($roles)) {
            Flash::error(\Lang::get('messages.role_not_found'));

            return redirect(route('roles.index'));
        }

        return view('roles.edit',['roles' => $roles,'permissions' => $permissions]);

    }

    /**
     * Updates the specified Role and Permission in storage if they have permissions.
     * @author Pedro
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function update(Request $request)
    {
        if($request->ajax()) {
            if ($request->idRole != \HV_ROLES::ADMIN){
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

                RolePermission::where('role_id', $request->idRole)
                ->update(['activated' => 0]);

                foreach($requestdata as $key => $value){
                    if(strpos($key,'check-')!==false){
                        $role_permission_id = str_replace('check-','',$key);
                        $role_permission = RolePermission::find($role_permission_id);
                        $actiValue= 0;
                        if (strtolower($value) == "on"){
                            $actiValue = 1;
                        }
                        else{
                            $actiValue = 0;
                        }
                        $role_permission->activated = $actiValue;
                        // $role_permission->value = $value;
                        // $role_permission->value_name = getValueName($value);
                        $role_permission->save();
                    }
                }
                return $this->jsonResponse(0, \Lang::get('messages.the_role')." ".$request->name." ".\Lang::get('messages.has_been_succesfully_edited'));
            }
            else{
                return $this->jsonResponse(1, \Lang::get('messages.permission_denied')); 
            }
        }
        else{
            return $this->jsonResponse(1, \Lang::get('messages.permission_denied'));
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
        $roleToDelete = Role::find($id);
        $roleName = $roleToDelete->name;
        if($roleToDelete->delible == 1 ) {
            return $this->jsonResponse(1, \Lang::get('messages.the_role')." ".$roleName." ".\Lang::get('messages.cannot_be_deleted')); 
        }

        if (empty($roleToDelete)) {
            return $this->jsonResponse(1, \Lang::get('messages.role_not_found')); 
        }

        $idRoleNameGuest = Role::select('id')->where('name', HV_ROLE_ASSIGNED_WHEN_DELETED)->first()->id;
        User::where('role_id', $id)->update(['role_id' => $idRoleNameGuest]);

        $roleToDelete->delete($id);

        RolePermission::where('role_id', $id)->delete();
        
        return $this->jsonResponse(0, \Lang::get('messages.role_stat')." ".$roleName." ".\Lang::get('messages.deleted_successfully'));
    

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

        return view('roles.usersRoleEdit',['id' => $id,'allUsers' => $allUsers, 'usersNotInRole' => $grouped,
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

        return view('roles.usersNotInRoleEdit',['allUsers' => $allUsers, 'usersNotInRole' => $grouped,
        'roles' => $roles]);
    }


    public function updateNotInRole(Request $request)
    {
        $requestData = $request->all();
        $retrievedData = [];

        foreach($requestData as $key => $value){
            $user_to_change = User::find($key);
            // $user_to_change = User::with('role9s')->where('users.id',$key)->get();

            // $user_to_change = Role::select('u.*','roles.name AS role_name')->join('users AS u', 'roles.id', 'u.role_id')->where("u.deleted_at",null)->where('u.id',$key)->get();

            if ($user_to_change->role_id == \HV_ROLES::PATIENT){
                $patientFound = Patient::where('user_id',$key)->delete();
                // $patient = Patient::where('user_id',$key)->restore();
            }
            else if (($user_to_change->role_id == \HV_ROLES::DOCTOR)||($user_to_change->role_id == \HV_ROLES::HELPER)){
                $staffFound = Staff::where('user_id',$key)->delete();
            }

            // dd($user_to_change->toArray());
            $user_to_change->role_id = $value;
            if ($user_to_change->role_id == \HV_ROLES::PATIENT){
                $patientFound = Patient::where('user_id',$key)->restore();
                if ($patientFound != 1){
                    $patient = new Patient();
                    $patient->user_id = $key;
                    $patient->historic = "";
                    $patient->height = "";
                    $patient->weight = "";
                    $res = $patient->save();
                    if(!$res) {
                        return $this->jsonResponse(1, \Lang::get('messages.internal_error'));
                    }
                }
            }
            else if (($user_to_change->role_id == \HV_ROLES::DOCTOR)||($user_to_change->role_id == \HV_ROLES::HELPER)){
                $staffFound = Staff::where('user_id',$key)->restore();
                if ($staffFound != 1){
                    $staff = new Staff();
                    $staff->user_id = $key;
                    $staff->historic = "";
                    ($user_to_change->role_id == \HV_ROLES::DOCTOR) ? $staff->branch_id = 45 : $staff->branch_id = 46;
                    $staff->shift = "";
                    $staff->office = "";
                    $staff->h_phone = "";
                    $staff->room = "";
                    $res = $staff->save();
                    if(!$res) {
                        return $this->jsonResponse(1, \Lang::get('messages.internal_error'));
                    }
                }
            }

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

    public function confirmDelete($id){
        $role = Role::find($id);
        return view('roles.confirm-delete',['role' => $role]);
    }

    public function ajaxUserRolesDatatable($id){
        $uRoles = Role::with('user1s')->where('id',$id)->get()->toArray();
        $uRoles=$uRoles[0]["user1s"];

        return response()->json(['data' => $uRoles]);
    }

    public function ajaxViewMainRolesDatatable(){
        $mRoles = Role::join('users', 'roles.user_id_creator', 'users.id')
        ->select(DB::raw('roles.id as idRole, roles.name as nameRole, roles.delible, user_id_creator,
         users.id as idUser, users.name as nameUser, lastname, dni, role_id'))
        ->orderBy('roles.id')->get();

        foreach($mRoles as $rol){
            $count = DB::table("users")->where('role_id', $rol->idRole)->get()->count();
            $rol->count = $count;
        }

        return response()->json(['data' => $mRoles]);

    }


    public function isDelible(Request $request){
        if ($request->ajax()){
            $role = Role::find($request->id);
            // dd($role->toArray());
            if ($role){
                if ($role->delible == 1){
                    $response = [
                        'delible' => true
                    ];          
                    return response()->json($response);                }
                else{
                    $response = [
                        'delible' => false
                    ];          
                    return response()->json($response);  
                }
            }
            return $delible;
        }
        else{
            jsonResponse("1",\Lang::get('messages.permission_denied'));
        }
    }


    public function delete2(Request $request){
        if ($request->ajax()){
            // dd($request->all());
            $message = Message::find($request->id);
            if ($message){
                if (($message->user_id_from == Auth::user()->id) || ($message->user_id_to == Auth::user()->id)){
                    // dd($message);             
                    if ($message->delete()){
                        $response = [
                            'status' => 0
                        ];          
                        return response()->json($response);
                    }
                }
                else{
                    jsonResponse("1",\Lang::get('messages.the_message_cannot_be_deleted'));
                }
            }
        }
        else{
            // Error
            jsonResponse("1",\Lang::get('messages.the_message_cannot_be_deleted'));
        }
    }


}
