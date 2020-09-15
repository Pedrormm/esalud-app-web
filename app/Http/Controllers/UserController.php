<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Patient;
use App\Models\Staff;
use App\Models\Role;
use App\Models\Branch;



class UserController extends Controller
{
      /** @var  usersRepository */
      private $usersRepository;

    


    /**
     * Display a listing of all users.
     * 
     * Endpoint: users/{userType?}/{search?}/{ord?}
     *  
     * @author Pedro    * 
     * 
     * @param string $userType The user type
     * @param string $search The searching sentence
     * @param string $order The given order
     * 
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */ 
    public function index(string $userType=null, string $search=null, string $ord=null){
        $user = Auth::user();
        if (is_null($ord)){
            $ord = 'users.id';
        }
        if(is_null($userType))
            $users = User::joinOthers();
        elseif($userType == \HV_USER_TYPES::PATIENT) {
            $users = Patient::userParent();
        }
        elseif($userType == \HV_USER_TYPES::STAFF) {
            $users = Staff::userParent();
        }
        
        if (!is_null($search) && !empty($search) && isset($search)){
            $users = $users->findByString($search, $ord);
        }
        $users = $users->get()->toArray();
        return view('user/user', ['users' => $users,'user' => $user]);
    }


   /**
     * Show the form for creating a new users.
     * 
     * Endpoint: user/staff/{search?}/{ord?}
     * 
     * @author Pedro
     * 
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */   
    public function createInvitation(){
        
        if ((auth()->user()->role_id == \HV_ROLES::PERM_DOCTOR) || (auth()->user()->role_id == \HV_ROLES::PERM_HELPER))
            $roles = Role::whereNotIn('id', [\HV_ROLES::PERM_ADMIN])->get();
        else if (auth()->user()->role_id == \HV_ROLES::PERM_ADMIN)
            $roles = Role::all();
        else
            return redirect()->back()->withErrors(['Permission denied', 'No permissions']);
        return view('user.newUser')->with('roles',$roles);    
    }

  
    /**
     * This is the main processing controller for users invitations 
     * Endpoint: user/create
     * @author Pedro
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */

    public function storeInvitation(Request $request){
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
            return $this->backWithErrors("UsMaCoCr001: Invalid dni format");
        }
        if ((auth()->user()->role_id == \HV_ROLES::PERM_DOCTOR || auth()->user()->role_id == \HV_ROLES::PERM_HELPER) && $rol_id == \HV_ROLES::PERM_ADMIN)
            return redirect()->back()->withErrors(['Permission denied', 'No permissions']);
        $existUser = User::exist_user_by_dni($dni);
        $roles = Role::all();
        if($existUser == 0){

            // $token = Str::random(32);
            $token = $this->generateUniqueToken("users_invitations", "verification_token");

            DB::beginTransaction();
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
                dd(1);
            }

            $userInvitation->verification_token = $token;
            $userInvitation->expiration_date = date("Y-m-d", time() + 172800);
            
            $res = $userInvitation->save();
           
            if(!$res) {
                return view('user.newUser')->with('roles',$roles)->with('danger','UsMaCoCr001: Error interno');
            } 
            $subject = "Se le ha invitado a crear una nueva cuenta en mi Hospital Virtual con el dni ". $dni;

            $res = Mail::to($email)->send(new InvitationNewUserMail($token, $dni));
      
            if(!$res) {
                DB::rollBack();
            }
            else
                DB::commit();
            return view('user.newUser')->with('roles',$roles)->with('info','Se ha enviado un correo con las instrucciones para crear el usuario');
            
        }else{                        
            return view('user.newUser')->with('roles',$roles)->with('danger','Ya existe ese DNI. Por favor compruebe los datos');
           
        }
    }

      
  
    public function create(string $token){
        // $rol = Role::find($rol_id);
        $verify = UserInvitation::whereVerificationToken($token)->first();
        if ($verify){
            $currentDate = Carbon::now();
            $expirationDate = Carbon::parse($verify->expiration_date);
   
            if ($expirationDate->gt($currentDate)){
                $rol = Role::find($verify->role_id);
                $email = $verify->email;
                $dni = $verify->dni;

                if ($verify->role_id == \HV_ROLES::PERM_DOCTOR) 
                    $branches = Branch::where('role_id', $verify->role_id)->get();
                else if ($verify->role_id == \HV_ROLES::PERM_HELPER)
                    $branches = Branch::where('role_id', $verify->role_id)->get();
                else if ($verify->role_id == \HV_ROLES::PERM_ADMIN)
                    $branches = Branch::all();
                else
                    $branches = "";

                return view('user.newUserMail')->with(['token'=>$token,'rol'=>$rol,'email'=>$email,'dni'=>$dni, 'branches'=>$branches]);
            }
            else
                return view('user.newUserMail')->with('showError',true)->withErrors("Token has been expired. Contact an admin to resend an email.");     
        }
        else{
            return view('user.newUserMail')->with('showError',true)->withErrors("Internal error");        
        }
    }

    /**
     * Creates the user given in the User Table
     * Endpoint: user/createNewUser
     * @author Pedro
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function store(Request $request){

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
        if ($request->input('rol_id')==\HV_ROLES::PERM_PATIENT){
            $validatedData = parent::checkValidation([
                'historic' => 'required',
                'height' => 'required|numeric',
                'weight' => 'required|numeric',
            ]);
        }
        if (($request->input('rol_id')==\HV_ROLES::PERM_DOCTOR) || ($request->input('rol_id')==\HV_ROLES::PERM_HELPER))  {
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
        
        $verify = UserInvitation::whereVerificationToken($token)->first();
        if (!$verify){
            return back()->withErrors("Mismatch error");        
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
            return back()->withErrors("Internal error");        
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
            return back()->withErrors("Internal error");  
        }
       
        if($rol_id == \HV_ROLES::PERM_PATIENT){
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
                return back()->withErrors("Internal error");
            }
        }
       
        if(($rol_id == \HV_ROLES::PERM_DOCTOR) || ($rol_id == \HV_ROLES::PERM_HELPER)){
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
                return back()->withErrors("Internal error");
            }
        }
        
        DB::commit();
        
        $roles = Role::all();
        $res = Mail::to($email)->send(new WelcomeNewUserMail($dni, $name, $lastname, $sex));

        if (Auth::user())
            return view('user.dashboard')->with('successful', "An user the dni ".$dni." has been properly created");
        else
            return redirect('/')->with('successful', "An user the dni ".$dni." has been properly created. Please log in.");
    }



      /**
       * Display the specified users.
       *
       * @param int $id
       *
       * @return Response
       */
      public function show($id)
      {
          $users = $this->usersRepository->find($id);
  
          if (empty($users)) {
              Flash::error('users not found');
  
              return redirect(route('users.index'));
          }
  
          return view('users.show')->with('users', $users);
      }
  
      /**
       * Show the form for editing the specified user.
       *
       * Endpoint: users/edit/{id}
       * 
       * @author Pedro
       * 
       * @param int $id The userId to be edited
       *
       * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
       */
      public function edit(int $id)
      {
          
        //TODO: Put all models in root app/, not in app/Models!!!!
        $userLogged = auth()->user();
        $usuario = User::find($id);
        if (empty($usuario)) {
            // Flash::error('user not found');
            // return redirect(route('users.index'));
            return $this->backWithErrors("User not found" );
        }
        $rol_usuario_info = "";

        if ($userLogged->id != $usuario->id && $userLogged->role_id != \HV_ROLES::PERM_ADMIN) {
            return $this->backWithErrors("UsCoEd002: Unauthorized call");
        }

        if($usuario->role_id == \HV_ROLES::PERM_ADMIN){
            return $this->backWithErrors("Not enough permissions");
        }
        elseif($usuario->role_id == \HV_ROLES::PERM_PATIENT){
            $rol_usuario_info = Patient::whereUserId($id)->first();
        }elseif(($usuario->role_id == \HV_ROLES::PERM_DOCTOR) || $usuario->role_id == \HV_ROLES::PERM_HELPER){
            $rol_usuario_info = Staff::whereUserId($id)->first();
        }
        else{
            $rol_usuario_info = User::whereUserId($id)->first();
        }
        if(!$rol_usuario_info) {
            return $this->backWithErrors("UsMaCoEd001: Invalid id");
        }
        $roles = Role::all();
        $branches = Branch::all();
        return view('user.edit', compact('usuario', 'rol_usuario_info', 'roles', 'branches'));//->with('usuario',$usuario)->with('rol_usuario_info',$rol_usuario_info)->with('roles',$roles)->with('branches',$branches);
      }
  
      /**
       * Update the specified users in storage.
       *
       * @param int $id
       * @param UpdateusersRequest $request
       *
       * @return Response
       */
      public function update_($id, UpdateusersRequest $request)
      {
          $users = $this->usersRepository->find($id);
  
          if (empty($users)) {
              Flash::error('users not found');
  
              return redirect(route('users.index'));
          }
  
          $users = $this->usersRepository->update($request->all(), $id);
  
          Flash::success('users updated successfully.');
  
          return redirect(route('users.index'));
      }


          /**
     * Update the selected user in the Database
     * Endpoint: users/{id}
     * @author Pedro
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */      
    public function update(Request $request, int $id){
        
        $validatedData = parent::checkValidation([
            'role_id' => 'required|exists:App\Models\Role,id',
            'email' => 'required|email:rfc,dns',
            'name' => 'required',
            'lastname' => 'required',
            'zipcode' => 'numeric',
            'phone' => 'required',
            'birthdate' => 'required',
            'sex' => 'required',
            'blood' => 'required',
        ]);
        $token = $request->input('token');
        
        if ($request->input('role_id')==\HV_ROLES::PERM_PATIENT){
            $validatedData = parent::checkValidation([
                'historic' => 'required',
                'height' => 'required|numeric',
                'weight' => 'required|numeric',
            ]);
            $res = Patient::whereUserId($id)->update($validatedData);
        }
        if (($request->input('role_id')==\HV_ROLES::PERM_DOCTOR) || ($request->input('role_id')==\HV_ROLES::PERM_HELPER))  {
            $validatedData = parent::checkValidation([
                'historic' => 'required',
                'branch_id' => 'required|exists:App\Models\Branch,id',
                'shift' => Rule::in(\SHIFTS::$types),
                'office' => 'required|numeric',
                'room' => 'required|numeric',
                'h_phone' => 'required|numeric',
            ]); 
            $res = Staff::whereUserId($id)->update($validatedData);
        }

        $user_id = $request->input('user_id');
        $usuario = User::find($user_id);
        
        $usuario->update($validatedData);

        return view('user.dashboard')->with('successful', "El usuario: ".$usuario->name." ".$usuario->lastname." ha sido editado correctamente");
    }


  
      /**
       * Remove the specified users from storage.
       *
       * @param int $id
       *
       * @throws \Exception
       *
       * @return Response
       */
      public function destroy($id)
      {
          $users = $this->usersRepository->find($id);
  
          if (empty($users)) {
              Flash::error('users not found');
  
              return redirect(route('users.index'));
          }
  
          $this->usersRepository->delete($id);
  
          Flash::success('users deleted successfully.');
  
          return redirect(route('users.index'));
      }
}
