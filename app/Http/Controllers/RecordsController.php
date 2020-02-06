<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Patient;
class RecordsController extends Controller
{
    
    public function index() {
        $user = Auth::user();
        $patients = Patient::orderBy('user_id')->get();
        return view('user/records', ['patients' => $patients,'user' => $user]);
    }
    
}
