<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Patient;
use App\Models\Staff;
use DB;

class UsersManagementController extends Controller
{
    public function newUser(){
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
        
        return view('user/newUser', ['staff' => $staff,'user' => $user]);    
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

