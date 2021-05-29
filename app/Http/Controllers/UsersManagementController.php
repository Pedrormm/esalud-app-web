<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Role;
use App\Models\Patient;
use App\Models\Staff;
use App\Models\UserInvitation;
use App\Models\Branch;
use App\Mail\InvitationNewUserMail;
use App\Mail\WelcomeNewUserMail;

use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

use App\Models\Message;
use App\Mail\EnviarMail;
use Mail;
use Reminder;
use Illuminate\Support\Str;
class UsersManagementController extends Controller
{
    public function newUser(){
        
        if ((auth()->user()->role_id == \HV_ROLES::DOCTOR) 
        || (auth()->user()->role_id == \HV_ROLES::HELPER))
            $roles = Role::whereNotIn('id', [\HV_ROLES::ADMIN])->get();
        else if (auth()->user()->role_id == \HV_ROLES::ADMIN)
            $roles = Role::all();
        else
            return redirect()->back()->withErrors([\Lang::get('messages.Permission_Denied'), \Lang::get('messages.No permissions')]);
        return view('users.newUser')->with('roles',$roles);    
    }

    /**
     * This is the main processing controller for users invitations 
     * Endpoint: user/create
     * @author Pedro
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create(Request $request){
        $validatedData = parent::checkValidation([
            'dni' => 'required|min:9|max:9',
            'email' => 'required|email:rfc,dns',
            'rol_id' => 'required|numeric|min:1',
        ]);
        
        $dni = $request->input('dni');
        $email = $request->input('email');
        $rol_id = $request->input('rol_id');

        //Check valid dni letter
        if(!checkDni($dni)) {
            return $this->backWithErrors("UsMaCoCr001: ".\Lang::get('messages.Invalid DNI format'));
        }
        if ((auth()->user()->role_id == \HV_ROLES::DOCTOR || auth()->user()->role_id == \HV_ROLES::HELPER) && $rol_id == \HV_ROLES::ADMIN)
            return redirect()->back()->withErrors([\Lang::get('messages.Permission_Denied'), \Lang::get('messages.No permissions')]);
        $existUser = User::exist_user_by_dni($dni);
        $roles = Role::all();
        if($existUser == 0){

            // $token = Str::random(32);
            $token = $this->generateUniqueToken("users_invitations", "verification_token");

            // DB::beginTransaction();
            $userInvitation = UserInvitation::whereDni($dni)->first();
            if(is_null($userInvitation)) {
                $userInvitation = new UserInvitation();
                $userInvitation->dni = $dni;
                $userInvitation->email = $email;
                $userInvitation->role_id = $rol_id;
                $userInvitation->times_sent = 0;
            }
            else{
                $userInvitation->times_sent = $userInvitation->times_sent +1;
            }

            // TODO: if (maxTimes > 3(constante)) google Verification Bot. Captcha plugin.

            if ($userInvitation->times_sent == HV_MAX_TIMES_CREATE_USER_SENT){
                // dd(1);
            }
    /*        $r = UserInvitation::updateOrCreate(
                ['dni' => $dni],
                ['email' => $email],
            );*/
  //          DB::commit();
//dd($r);
            $userInvitation->verification_token = $token;
            $userInvitation->expiration_date = date("Y-m-d", time() + 172800);
            $res = $userInvitation->save();
            //dd($res);

            if(!$res) {
                return view('users.newUser')->with('roles',$roles)->with('danger','UsMaCoCr001: '.\Lang::get('messages.Internal error'));
            } 
            $subject = config('app.name').\Lang::get('messages.has invited you to create a new account with the dni(id)'). $dni;
            DB::commit();
            $res = Mail::to($email)->send(new InvitationNewUserMail($token, $dni));
            // dd($res);
            /*if(!$res) {
                DB::rollBack();
            }
            else
                DB::commit();*/
            return view('users.newUser')->with('roles',$roles)->with('info',\Lang::get('messages.A mail has been sent to the one provided with instructions on how to create the new user'));
            
        }else{                        
            return view('users.newUser')->with('roles',$roles)->with('danger',\Lang::get('messages.The DNI(id) already exists. Please check your data'));
           
        }
    }

    /**
     * Process a invitation link from email
     * Endpoint: user/createUserFromMail/{token?}
     * @author Pedro
     * @param string $token The unique token in users_invitations table
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function createUserFromMail(string $token){
        // $rol = Role::find($rol_id);
        $verify = UserInvitation::whereVerificationToken($token)->first();
        // $verify = UserInvitation::where("verification_token", $token)->first();
        // $verify = UserInvitation::all();
        // dd($verify);
        if ($verify){
            $currentDate = Carbon::now();
            $expirationDate = Carbon::parse($verify->expiration_date);
   
            if ($expirationDate->gt($currentDate)){
                $rol = Role::find($verify->role_id);
                $email = $verify->email;
                $dni = $verify->dni;

                if ($verify->role_id == \HV_ROLES::DOCTOR) 
                    $branches = Branch::where('role_id', $verify->role_id)->get();
                else if ($verify->role_id == \HV_ROLES::HELPER)
                    $branches = Branch::where('role_id', $verify->role_id)->get();
                else if ($verify->role_id == \HV_ROLES::ADMIN)
                    $branches = Branch::all();
                else
                    $branches = "";

                return view('users.newUserMail')->with(['token'=>$token,'rol'=>$rol,'email'=>$email,'dni'=>$dni, 'branches'=>$branches]);
            }
            else
                return view('users.newUserMail')->with('showError',true)->withErrors(\Lang::get('messages.Token has been expired. Contact an admin to resend an email'));     
        }
        else{
            return view('users.newUserMail')->with('showError',true)->withErrors("UsMaCoCrUsFrMa001: ".\Lang::get('messages.Internal error'));        
        }
    }

    /**
     * Creates the user given in the User Table
     * Endpoint: user/  NewUser
     * @author Pedro
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function createNewUser(Request $request){

        $validatedData = parent::checkValidation([
            'token' => 'required|exists:App\Models\UserInvitation,verification_token',
            'dni' => 'required|min:9|max:9',
            'email' => 'required|email:rfc,dns',
            'rol_id' => 'required|numeric|min:1',
            'name' => 'required',
            'lastname' => 'required',
            'zipcode' => 'numeric',
            'phone' => 'required',
            'birthdate' => 'required',
            'sex' => 'required',
            'blood' => 'required',
            
        ]);
        $token = $request->input('token');
        if ($request->input('rol_id')==\HV_ROLES::PATIENT){
            $validatedData = parent::checkValidation([
                'historic' => 'required',
                'height' => 'required|numeric',
                'weight' => 'required|numeric',
            ]);
        }
        if (($request->input('rol_id')==\HV_ROLES::DOCTOR) || ($request->input('rol_id')==\HV_ROLES::HELPER))  {
            $validatedData = parent::checkValidation([
                'historic' => 'required',
                'branch' => 'required|exists:App\Models\Branch,id',
                // 'shift' => 'required|min:1|max:3|in:M,ME,MN,MEN,E,EN,N',
                'shift' => Rule::in(\SHIFTS::$types),
                'shift' => 'required|min:1|max:3',
                'office' => 'required|numeric',
                'room' => 'required|numeric',
                'h_phone' => 'required|numeric',
            ]); 
        }

        $historic = $request->input('historic');
        $branch = $request->input('branch');
        $shift = $request->input('shift');
        $office = $request->input('office');
        $room = $request->input('room');
        $h_phone = $request->input('h_phone');
        $verifyDni = User::whereDni($request->dni)->first();

        // dd($verifyDni);
        // Si ya existe dni
        if ($verifyDni){ 
            return back()->withErrors("UsMaCoCrNeUs002: ".\Lang::get('messages.Mismatch error'));        
        }

        $verify = UserInvitation::whereVerificationToken($token)->first();
        if (!$verify){
            return back()->withErrors(\Lang::get('messages.Mismatch error'));        
        }
        //dd($request->all());

        $dni = $request->input('dni');
        $email = $request->input('email');
        $rol_id = $request->input('rol_id');

        $name = $request->input('name');
        $lastname = $request->input('lastname');
        $address = $request->input('address');
        $country = $request->input('country');
        $city = $request->input('city');
        $zipcode = $request->input('zipcode');
        $phone = $request->input('phone');
        $birthdate = $request->input('birthdate');
        $sex = $request->input('sex');
        $blood = $request->input('blood');

        $password =  Hash::make($request->input('password'));

        DB::beginTransaction();
        // $verify->deleted_at = Carbon::now();
        // $verify->save();
        
        $res = $verify->delete();
        if (!$res){
            DB::rollBack();
            return back()->withErrors(\Lang::get('messages.Internal error'));        
        }


        $user = new User();
        $user->dni = $dni;
        $user->email = $email;
        $user->role_id = $rol_id;
        $user->name = $name;
        $user->lastname = $lastname;
        $user->address = $address;
        $user->country = $country;
        $user->city = $city;
        $user->zipcode = $zipcode;
        $user->phone = $phone;
        $user->birthdate = $birthdate;
        $user->sex = $sex;
        $user->blood = $blood;
        $user->password = $password;
        $res = $user->save();
        if(!$res) {
            DB::rollBack();
            return back()->withErrors(\Lang::get('messages.Internal error'));  
        }
       
        if($rol_id == \HV_ROLES::PATIENT){
            $historic = $request->input('historic');
            $height = $request->input('height');
            $weight = $request->input('weight');

            $patient = new Patient();
            $patient->user_id = $user->id;
            $patient->historic = $historic;
            $patient->height = $height;
            $patient->weight = $weight;
            $res = $patient->save();
            if(!$res) {
                DB::rollBack();
                return back()->withErrors(\Lang::get('messages.Internal error'));
            }
        }
       
        if(($rol_id == \HV_ROLES::DOCTOR) || ($rol_id == \HV_ROLES::HELPER)){
            $historic = $request->input('historic');
            $branch = $request->input('branch');
            $shift = $request->input('shift');
            $office = $request->input('office');
            $room = $request->input('room');
            $h_phone = $request->input('h_phone');

            $staff = new Staff();
            $staff->historic = $historic;
            $staff->branch_id = $branch;
            $staff->shift = $shift;
            $staff->office = $office;
            $staff->h_phone = $h_phone;
            $staff->room = $room;
            $staff->user_id = $user->id;
            $res = $staff->save();
            
            if(!$res) {
                DB::rollBack();
                return back()->withErrors(\Lang::get('messages.Internal error'));
            }
        }
        
        DB::commit();
        
        $roles = Role::all();
        $res = Mail::to($email)->send(new WelcomeNewUserMail($dni, $name, $lastname, $sex));

        if (Auth::user())
            return view('dashboard.index')->with('successful', \Lang::get('messages.An user with the DNI').$dni.\Lang::get('messages.has been properly created'));
        else
            return redirect('/')->with('successful', \Lang::get('messages.An user with the DNI').$dni.\Lang::get('messages.has been properly created. Please log in'));
    }

    /**
     * Shows the edit user view, given an userId
     * Endpoint: user/edit/{id}
     * @author Pedro
     * @param  $id The userId to be edited
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */    
    public function edit($id){
        $usuario = User::find($id);
        $rol_usuario_info = "";

        if($usuario->role_id == \HV_ROLES::ADMIN){
            return $this->backWithErrors(\Lang::get('messages.Permission_Denied'));
        }
        elseif($usuario->role_id == \HV_ROLES::PATIENT){
            // DB::table('patients')->whereUserId($id)->limit(1)->first();
            $rol_usuario_info = Patient::whereUserId($id)->first();
            // $rol_usuario_info = DB::select('SELECT * FROM patients WHERE user_id ='.$id.' LIMIT 1');
        }elseif(($usuario->role_id == \HV_ROLES::DOCTOR) || $usuario->role_id == \HV_ROLES::HELPER){
            // $rol_usuario_info = DB::select('SELECT * FROM staff WHERE user_id ='.$id.' LIMIT 1');
            $rol_usuario_info = Staff::whereUserId($id)->first();
        }
        else{
            $rol_usuario_info = User::whereUserId($id)->first();
        }
        if(!$rol_usuario_info) {
            return $this->backWithErrors("UsMaCoEd001: ".\Lang::get('messages.Invalid id'));
        }
        return view('users.edit')->with('usuario',$usuario)->with('rol_usuario_info',$rol_usuario_info[0]);
    }

    /**
     * Update the selected user in the Database
     * Endpoint: user/editUser
     * @author Pedro
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */      
    public function editUser(Request $request){

        $user_id = $request->input('user_id');
        $usuario_rol = User::find($user_id);
        $role_id = $usuario_rol->role_id;
        
        $email = $request->input('email');
        $dni = $request->input('dni');

        $name = $request->input('name');
        $lastname = $request->input('lastname');
        $address = $request->input('address');

        $country = $request->input('country');
        $city = $request->input('city');
        $zipcode = $request->input('zipcode');

        $phone = $request->input('phone');
        $birthdate = $request->input('birthdate');
        $sex = $request->input('sex');
        $blood = $request->input('blood');

        $usuario = User::find($user_id);
        $usuario->dni = $dni;
        $usuario->email = $email;
        $usuario->name = $name;
        $usuario->lastname = $lastname;
        $usuario->address = $address;
        $usuario->country = $country;
        $usuario->city = $city;
        $usuario->zipcode = $zipcode;
        $usuario->phone = $phone;
        $usuario->birthdate = $birthdate;
        $usuario->sex = $sex;
        $usuario->blood = $blood;
        $usuario->save();

        if($role_id == \HV_ROLES::PATIENT){

            $historic = $request->input('historic');
            $height = $request->input('height');
            $weight = $request->input('weight');

            $patient_actual = Patient::getPatientByUser($user_id);
            $patient = Patient::find($patient_actual->id);

            $patient->historic = $historic;
            $patient->height = $height;
            $patient->weight = $weight;
            $patient->save();

        }elseif($role_id == \HV_ROLES::DOCTOR){

            $historic = $request->input('historic');
            $branch_id = $request->input('branch');
            $shift = $request->input('shift');            
            $office = $request->input('office');
            $room = $request->input('room');
            $h_phone = $request->input('h_phone');

            $staff_usuario = Staff::getUserStaffById($user_id);
            $staff = Staff::find($staff_usuario->id);

            $staff->historic = $historic;
            $staff->branch_id = $branch_id;
            $staff->shift = $shift;
            $staff->office = $office;
            $staff->h_phone = $h_phone;
            $staff->room = $room;
            $staff->save();
        }

        return view('dashboard.index')->with('successful', \Lang::get('messages.The user:').$usuario->name." ".$usuario->lastname.\Lang::get('messages.has been succesfully edited'));
    }

    /**
     * Shows the users that are Staff
     * Endpoint: user/staff/{search?}/{ord?}
     * @author Pedro
     * @param string $search The searching sentence
     * @param string $order The given order
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */      
    public function showStaff(string $search=null, string $ord=null){
        $user = Auth::user();

        $staff = DB::select('SELECT * FROM users INNER JOIN staff ON users.id = staff.user_id WHERE role_id = 2 or role_id = 3');
        
        return view('user/staff', ['staff' => $staff,'user' => $user]);    
    }


    /**
     * Shows the users that are Patients
     * Endpoint: user/patient/{search?}/{ord?}
     * @author Pedro
     * @param string $search The searching sentence
     * @param string $order The given order
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */  
    public function showPatients(string $search=null, string $ord=null){
        $user = Auth::user();

        if (is_null($ord)){
            $ord = 'users.id';
        }

        $patients = Patient::join('users', 'patients.user_id', 'users.id')->orderBy($ord)->get();

        if (!is_null($search) && !empty($search) && isset($search)){
            $patients = Patient::join('users', 'patients.user_id', 'users.id')->orderBy($ord)        
            ->where('name', 'LIKE', '%'.$search.'%')
            ->orWhere('lastname', 'LIKE', '%'.$search.'%')
            ->orWhere('historic', 'LIKE', '%'.$search.'%')
            ->orWhere('dni', 'LIKE', '%'.$search.'%')
            ->get();
        }
        
        return view('user/patient', ['patients' => $patients,'user' => $user]);
    }

    /**
     * Shows all users
     * Endpoint: user/user/{search?}/{ord?} 
     -* Endpoint: usersManagement/show/users/{search?}/{ord?}-
     * @author Pedro
     * @param string $search The searching sentence
     * @param string $order The given order
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */ 
    public function showUsers(string $search=null, string $ord=null){
        $user = Auth::user();

        if (is_null($ord)){
            $ord = 'users.id';
        }

        // $users = DB::table('users')->join('patients', 'patients.user_id', 'users.id')
        // ->join('staff', 'staff.user_id', 'users.id')->orderBy($ord)->get(); 

        $patients = Patient::join('users', 'patients.user_id', 'users.id')
        ->join('staff', 'staff.user_id', 'users.id')->orderBy($ord)->get();


      //  $users = User::all();
      //  $users = User::orderBy($ord)->leftJoin('patients', 'patients.user_id', 'users.id')->leftJoin('staff', 'staff.user_id', 'users.id')->get();
        $users = User::with(['patients', 'staff'])->orderBy($ord)->get()->toArray();

        if (!is_null($search) && !empty($search) && isset($search)){
            $users = User::with(['patients', 'staff'])->orderBy($ord)        
            ->where('name', 'LIKE', '%'.$search.'%')
            ->orWhere('lastname', 'LIKE', '%'.$search.'%')
            ->orWhere('historic', 'LIKE', '%'.$search.'%')
            ->orWhere('dni', 'LIKE', '%'.$search.'%')
            ->get()->toArray();
        }

        //dd($users);
        
        return view('user/user', ['users' => $users,'user' => $user]);
    }

}

