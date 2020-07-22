<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use App\Models\Patient;
use App\Models\Staff;
use DB;
use Illuminate\Support\Facades\Hash;

use App\Models\Message;
use App\Mail\EnviarMail;
use Mail;
use Reminder;
use Illuminate\Support\Str;
class UsersManagementController extends Controller
{
    public function newUser(){
        
        $roles = Role::all();
        return view('user.newUser')->with('roles',$roles);    
    }

    public function create(Request $request){
        $validatedData = parent::checkValidation([
            'dni' => 'required|min:5|max:10',
            'email' => 'required|email:rfc,dns',
            'rol_id' => 'required|numeric|min:1',
        ]);

        $dni = $request->input('dni');
        $email = $request->input('email');
        $rol_id = $request->input('rol_id');

        $existUser = User::exist_user_by_dni($dni);
        $roles = Role::all();
        if($existUser == 0){

            $token = Str::random(32);

            DB::beginTransaction();
            $userInvitation = UserInvitation::whereDni($dni)->first();
            if(is_null($userInvitation)) {
                $userInvitation = new UserInvitation();
                $userInvitation->dni = $dni;
                $userInvitation->email = $email;
                $userInvitation->role_id = $rol_id;
            }
            $userInvitation->verification_token = $token;
           
            $res = $userInvitation->save();
            if(!$res) {
                return view('user.newUser')->with('roles',$roles)->with('danger','UsMaCoCr001: Error interno');

            } 
            $res = Mail::send('mail.createUser', ['token' => $token, 'dni' =>$dni, 'rol_id' =>$rol_id, 'email' =>$email], function ($m) use ($email) {
                $m->to($email);
                $m->subject("Prueba envío email");
            });
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

    public function createUserFromMail($token, $rol_id,$email, $dni){
        $rol = Role::find($rol_id);
        return view('user.newUserMail')->with('rol',$rol)->with('email',$email)->with('dni',$dni);    
    }

    public function createUserNew(Request $request){

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
        $user->save();

        if($rol_id == 1){
            $historic = $request->input('historic');
            $height = $request->input('height');
            $weight = $request->input('weight');

            $patient = new Patient();
            $patient->user_id = $user->id;
            $patient->historic = $historic;
            $patient->height = $height;
            $patient->weight = $weight;
            $patient->save();
        }

        echo "Usuario creado correctamente";

    }

    public function showStaff(string $search=null, string $ord=null){
        $user = Auth::user();

        if (is_null($ord)){
            $ord = 'users.id';
        }

        $staff = Staff::join('users', 'staff.user_id', 'users.id')->get()->toArray();

        if (!is_null($search) && !empty($search) && isset($search)){
            $patients = Patient::join('users', 'patients.user_id', 'users.id')->orderBy($ord)        
            ->where('name', 'LIKE', '%'.$search.'%')
            ->orWhere('lastname', 'LIKE', '%'.$search.'%')
            ->orWhere('historic', 'LIKE', '%'.$search.'%')
            ->orWhere('dni', 'LIKE', '%'.$search.'%')
            ->get()->toArray();
        }
        
        return view('user/staff', ['staff' => $staff,'user' => $user]);    
    }

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

