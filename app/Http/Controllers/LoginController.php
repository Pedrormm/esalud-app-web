<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\PieceNew;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function login(Request $request) {
        $remember = $request->has('remember') ? true : false;    

        $validatedData = $request->validate([
            'dni' => 'required|min:4|max:10|exists:users,dni',
            'password' => 'required|min:6',
        ]);
        $credentials = $request->only('dni', 'password');

      //  if (Auth::attempt($credentials, $request->has('rememberme'))) {
        if (Auth::attempt($credentials, $remember)) {
            // Authentication passed...
            $user = auth()->user();
            return redirect()->action('LoginController@index');
            //return view('user.dashboard', ['user' => $user]);
        }
        return back()->withErrors("Authentication failed");
    }

    public function loginForgotten(Request $request) {
        

        $validatedData = $request->validate([
            'rem_password' => 'required|min:4|max:10|exists:users,dni',
        ]);
       
        $login = $request->rem_password;
        $user = User::where('dni', $login)->first();
        if(is_null($user)) {
            return response()->back()->withErrors("Invalid login");
        }
        
        $maxSteps = 1000; //Por seguridad, no vamos a permitir esto
        $try = 0;
        do {
            $token = Str::random(32);
            $user->remember_token = $token;
            if($try >= $maxSteps) {
                // Caso muy excepcional, que no deberia pasar a no ser que tengamos millones de usuarios
                return response()->back()->withErrors("Internal error");
            }
            $try++;
        } while (User::where('remember_token', $token)->first() instanceof User);
        //TODO Coger el $token, guardarlo en remember_token de users y mandar el email personalizado a no se quien (porque no existe ningun mail) usando el email predefinido de laravel para este caso de remember token o mejos aun, creando uno nuevo entero

        dd($token);
    }

    public function index() {
        $user = Auth::user();        
        $news = PieceNew::orderByDesc('date')->get();
        return view('user.dashboard', ['user' => $user,'news' => $news]);
    }
    
    public function logout(Request $request) {
        Auth::logout();
        return redirect('/')->withError("Session closed");
    }
}


