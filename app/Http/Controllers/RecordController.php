<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Patient;
class RecordController extends Controller
{
    
    public function index(string $ord=null) {
        $user = Auth::user();
        $patients = Patient::join('users', 'patient.user_id', 'users.id')->orderBy('user_id')->get();
//        dd($patients);

        return view('user/records', ['patients' => $patients,'user' => $user]);
    }
    
}
