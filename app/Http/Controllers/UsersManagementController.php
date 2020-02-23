<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Patient;
use App\Staff;

class UsersManagementController extends Controller
{
    public function showStaff(string $search=null, string $ord=null){
        $user = Auth::user();

        if (is_null($ord)){
            $ord = 'users.id';
        }

        $patients = Staff::join('users', 'staff.user_id', 'users.id')->get();

        if (!is_null($search) && !empty($search) && isset($search)){
            $patients = Patient::join('users', 'patients.user_id', 'users.id')->orderBy($ord)        
            ->where('name', 'LIKE', '%'.$search.'%')
            ->orWhere('lastname', 'LIKE', '%'.$search.'%')
            ->orWhere('historic', 'LIKE', '%'.$search.'%')
            ->orWhere('dni', 'LIKE', '%'.$search.'%')
            ->get();
        }
        
        return view('user/staff', ['patients' => $patients,'user' => $user]);    
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
}
