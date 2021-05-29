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
use Carbon\Carbon;
use Active;
use DB;

class UserController extends Controller
{
      /** @var  usersRepository */
      private $usersRepository;

    


    /**
     * Display a listing of all users.
     * 
     * Endpoint: users/
     *  
     * @author Pedro    * 
     * 
     * @param string $userType The user type
     * @param string $search The searching sentence
     * @param string $order The given order
     * 
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */ 
    public function index(){
        $activeUsers = Active::users()->get();
        // dd($activeUsers->toArray());

        $user = Auth::user();
        $users = User::joinOthers();
        $pagination = $users->count()>15? "true" : "false";

        $users = $users->get()->toArray();
        return view('users/index', ['users' => $users,'user' => $user,'pagination' => $pagination]);
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
        
        if ((auth()->user()->role_id == \HV_ROLES::DOCTOR) || (auth()->user()->role_id == \HV_ROLES::HELPER))
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
        if ((auth()->user()->role_id == \HV_ROLES::DOCTOR || auth()->user()->role_id == \HV_ROLES::HELPER) && $rol_id == \HV_ROLES::ADMIN)
            return redirect()->back()->withErrors([\Lang::get('messages.Permission_Denied'), \Lang::get('messages.No permissions')]);
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
                return view('users.newUser')->with('roles',$roles)->with('danger','UsMaCoCr001: Error interno');
            }

            $userInvitation->verification_token = $token;
            $userInvitation->expiration_date = date("Y-m-d", time() + 172800);
            
            $res = $userInvitation->save();
           
            if(!$res) {
                return view('users.newUser')->with('roles',$roles)->with('danger','UsMaCoCr002: Error interno');
            } 
            $subject = config('app.name').\Lang::get('messages.has invited you to create a new account with the dni(id)'). $dni;

            $res = Mail::to($email)->send(new InvitationNewUserMail($token, $dni));
      
            if(!$res) {
                DB::rollBack();
            }
            else
                DB::commit();
            return view('users.newUser')->with('roles',$roles)->with('info',\Lang::get('messages.A mail has been sent to the one provided with instructions on how to create the new user'));
            
        }else{                        
            return view('users.newUser')->with('roles',$roles)->with('danger',\Lang::get('messages.The DNI(id) already exists. Please check your data'));
           
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
            return view('users.newUserMail')->with('showError',true)->withErrors(\Lang::get('messages.Internal error'));        
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
       * Endpoint: users/{id}/edit
       * 
       * @author Pedro
       * 
       * @param int $id The userId to be edited
       *
       * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
       */
      public function edit(int $id)
      {
          
        $userLogged = auth()->user();
        $usuario = User::find($id);
        if (empty($usuario)) {
            // Flash::error('user not found');
            // return redirect(route('users.index'));
            return $this->backWithErrors(\Lang::get('messages.User not found'));
        }
        $rol_usuario_info = "";

        // if ($userLogged->id != $usuario->id && $userLogged->role_id != \HV_ROLES::ADMIN) {
        //     return $this->backWithErrors("UsCoEd002: Unauthorized call");
        // }

        if($usuario->role_id == \HV_ROLES::ADMIN){
            return $this->backWithErrors(\Lang::get('messages.Permission_Denied'));
        }
        elseif($usuario->role_id == \HV_ROLES::PATIENT){
            $rol_usuario_info = Patient::whereUserId($id)->first();
        }elseif(($usuario->role_id == \HV_ROLES::DOCTOR) || $usuario->role_id == \HV_ROLES::HELPER){
            $rol_usuario_info = Staff::whereUserId($id)->first();
        }
        else{
            $rol_usuario_info = User::whereUserId($id)->first();
        }
        if(!$rol_usuario_info) {
            return $this->backWithErrors("UsMaCoEd001: ".\Lang::get('messages.Invalid id'));
        }
        $roles = Role::all();
        $branches = Branch::all();
        return view('users.edit', compact('usuario', 'rol_usuario_info', 'roles', 'branches'));//->with('usuario',$usuario)->with('rol_usuario_info',$rol_usuario_info)->with('roles',$roles)->with('branches',$branches);
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
            'birthdate' => 'required|date',
            'sex' => 'required',
            'blood' => 'required',
            'country' => 'string',
            'city' => 'string',
            'address' => 'string',
        ]);
        $token = $request->input('token');
        
        if ($request->input('role_id')==\HV_ROLES::PATIENT){
            $mapValidation = parent::checkValidation([
                'historic' => 'required',
                'height' => 'required|numeric',
                'weight' => 'required|numeric',
            ]);

            $res = Patient::whereUserId($id)->update($mapValidation);
        }
        if (($request->input('role_id')==\HV_ROLES::DOCTOR) || ($request->input('role_id')==\HV_ROLES::HELPER))  {
            $mapValidation = parent::checkValidation([
                'historic' => 'required',
                'branch_id' => 'required|exists:App\Models\Branch,id',
                'shift' => Rule::in(\SHIFTS::$types),
                'office' => 'required|numeric',
                'room' => 'required|numeric',
                'h_phone' => 'required|numeric',
            ]); 
            $res = Staff::whereUserId($id)->update($mapValidation);
        }

        $user_id = $request->input('user_id');
        $usuario = User::find($user_id);

        $validatedData = array_merge($mapValidation, $validatedData);

        $usuario->update($validatedData);

        return view('users.index')->with('okMessage', \Lang::get('messages.The user:').$usuario->name." ".$usuario->lastname.\Lang::get('messages.has been succesfully edited'));
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
        $userToDelete = User::find($id);
        $userName = $userToDelete->name . " " . $userToDelete->lastname;


        if (empty($userToDelete)) {
            return $this->jsonResponse(1, \Lang::get('messages.User not found')); 
        }

        $patientOrStaffFound = User::leftJoin('patients', 'users.id', 'patients.user_id')
        ->leftJoin('staff', 'users.id', 'staff.user_id')
        ->select('users.id as user_id', 'patients.id as patient_id', 'patients.user_id as patient_user_id',
         'staff.id as staff_id', 'staff.user_id as staff_user_id')
        ->where('users.id', $id)->get()->toArray();

        $userToDelete->delete($id);
        
        if($patientOrStaffFound[0]['staff_id']){
            Staff::find($patientOrStaffFound[0]['staff_id'])->delete();
        }
        else if($patientOrStaffFound[0]['patient_id']){
            Patient::find($patientOrStaffFound[0]['patient_id'])->delete();
        }

        return $this->jsonResponse(0, \Lang::get('messages.user')." ".$userName.\Lang::get('messages.deleted successfully'));
      }

    public function confirmDelete($id){
        $singleUser = User::find($id);
        return view('users.confirm-delete',['singleUser' => $singleUser]);  
    }


     /**
     * View to render the full devices section and to return the DataTables pagination server side data based on request variables
     *
     * @author Pedro
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxViewDatatable(Request $request) {


        if(!$request->wantsJson()) {
            abort(404, 'Bad request');
        }

        self::checkDataTablesRules();
        $searchPhrase = $request->search['value'];
        // Abort query execution if search string is too short
        if(!empty($searchPhrase)) {
            // Minimum two digits or 3 letters to allow a search
            // if(preg_match("/^.{1,2}\$/i", $searchPhrase)) {
            if(preg_match("/^.{1}\$/i", $searchPhrase)) {
                return response()->json(['data' => []]);
            }
        }
        $data = Role::select('u.*','roles.name AS role_name')->join('users AS u', 'roles.id', 'u.role_id')->where("u.deleted_at",null);
        // Role::all()->with('users');
        $numTotal = $numRecords = $data->count();

        /**
         * Applying search filters over query result as it is was simple query
         */
        if(!empty($request->search['value'])) {

            // Search by numbers only
            if(preg_match("/\d{3,}/", $searchPhrase, $matches)) {

                $data->where(function($query) use ($searchPhrase) {
                    $query->orWhere('birthdate', 'like', '%' . $searchPhrase . '%')
                        ->orWhere('dni', 'like', '%' . $searchPhrase . '%')
                        ->orWhere('phone', 'like', '%' . $searchPhrase . '%');
                });
                $numRecords = $data->count();
            }
            // Search by name, surname, role, dni or sex
            // elseif(preg_match("/\w{3,}\$/i", $searchPhrase)) {
            elseif(preg_match("/[0-9a-zA-ZÀ-ÿ\u00f1\u00d1]{3,}\$/i", $searchPhrase)) {
               
                $data->where(function($query) use ($searchPhrase) {
                    $query->orWhere('u.name', 'like', '%' . $searchPhrase . '%')
                        ->orWhere('u.lastname', 'like', '%' . $searchPhrase . '%')
                        ->orWhere('roles.name', 'like', '%' . $searchPhrase . '%')
                        ->orWhere('dni', 'like', '%' . $searchPhrase . '%')
                        ->orWhere('sex', 'like', '%' . $searchPhrase . '%');             
                });
                        
                $numRecords = $data->count();
            }

            // Search by blood type
            elseif(preg_match("/^(A|B|AB|0)[+-]$/i", $searchPhrase)) {
               
                $data->where(function($query) use ($searchPhrase) {
                    $query->orWhere('u.blood', 'like', '%' . $searchPhrase . '%');            
                });
                        
                $numRecords = $data->count();
            }
            
        }
        // dd($numRecords);

        $dataAux = clone $data;
        $firstRow = $dataAux->first();
        
        if(is_null($firstRow)) {
            return response()->json(['data' => []]);
        }
        $collectionKeys = array_keys($firstRow->toArray());
        /**
         * Applying order methods
         */
        $orderList = $request->order;
        foreach($orderList as $orderSetting) {
            $indexCol = $orderSetting['column'];
            $dir = $orderSetting['dir'];

            if(isset($request->columns[$indexCol]['data'])) {
                $colName = $request->columns[$indexCol]['data'];
                if(in_array($colName, $collectionKeys))
                    $data->orderBy($colName, $dir);
                //dd("order by col " . $colName);
            }
        }
        //DB::enableQueryLog();
        if($request->length > 0)
            $data = $data->offset($request->start)->limit($request->length);
        $data = $data->get();
        //dd(DB::getQueryLog());
        if($data->isEmpty()) {
            return response()->json(['data'=>[]]);
        }

        /*
         * Apply data processing
         */
        foreach($data as $row) {
           $originalBD = $row->birthdate;
           $row->fullName = $row->lastname . ", " . $row->name;
           $row->birthdate = self::mysqlDate2Spanish($originalBD);

        //    $row->buttonDelete = true;
        //     $row->buttonUpdate = false;
        
        }

        // Apply search string to collection results

       /* if(!empty($request->search['value'])) {
            //TODO: Implement search function over collection
            $searchPhrase = $request->search['value'];
            $data = $data->filter(function($device, $key) use ($searchPhrase) {
                foreach($device as $keys=>$value) {
                    if (strpos($searchPhrase, $value) !== false) {
                        return $value;
                    }
                }
            });
            $numRecords = $data->count();
            $data->all();
        }
        // Apply order settings
        $orderIndexes = array();
        foreach($request->order as $order) {
            $orderIndexes[] = [
                (int)$order['column'],
                $order['dir']
            ];
        }
//dd($collectionKeys);
        //$data = collect($data->toArray());
        //dd($data);
        //dd($orderIndexes);
        //dd($orderIndexes);
//dump($data);
        foreach($orderIndexes as $order) {
            $columnName = $request->columns[$order[0]]['data'];
            if($order[1] == 'asc')
                $sorted = $data->sortBy($columnName);
            else
                $sorted = $data->sortByDesc($columnName);
            //dd($collectionKeys[$order[0]]);
            //$sorted->values()->all();
            //dd($sorted);
            $data = $sorted->values();
            //dd($data);
            //$data = $sorted;
        }*/
//dd($data->toArray());
        if(request()->wantsJson()) {
            return self::responseDataTables($data->toArray(), (int)$request->draw, $numTotal, $numRecords);

        }
    }

}
