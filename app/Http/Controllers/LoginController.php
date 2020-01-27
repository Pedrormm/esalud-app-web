<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;
class LoginController extends Controller
{
    public function login(Request $request) {
        $validatedData = $request->validate([
            'dni' => 'required|min:4|max:10|exists:users,dni',
            'password' => 'required|min:6',
        ]);
        $credentials = $request->only('dni', 'password');
//dd($credentials);
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('user/dashboard');
        }
        return back()->withErrors("Authentication failed");
        //dd(false);
        $dni = $request->input('dni');
        $pass = $request->input('password');    
        $user = User::where('dni', $dni)->first();
        if(is_null($user)) {
            return back()->withErrors("Authentication failed");
        }
        $passDbEnc = $user->password;
        if(Hash::check($pass, $passDbEnc)) {
            if (Hash::needsRehash($passDbEnc)) {
                $hashed = Hash::make($pass);
                $user->password = $hashed;
                $user->save();
                //update
            }
        }
        else {
            return back()->withErrors("Authentication failed");
        }
        $register = User::orderBy('id');
        // TODO: Generar variables de session llamada 'user_hv' con el objeto $user
        return view('user.dashboard',['user'=> $user,'listaUsers'=> $register]);
        // clave y valor, se refiere en la vista la clave
        // Se puede pasar valores como parametro
    }

    public function index() {
        $user = Auth::user();
        return view('user.dashboard', compact('user'));
    }
    
    public function logout() {
        Auth::logout();
        return redirect('/')->withError("Session closed");
    }
}


