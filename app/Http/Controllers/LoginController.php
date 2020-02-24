<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\PieceNew;
use App\Mail\EnviarMail;
use Mail;

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
            var_dump($token);
            $user->remember_token = $token;
            if($try >= $maxSteps) {
                // Caso muy excepcional, que no deberia pasar a no ser que tengamos millones de usuarios
                return response()->back()->withErrors("Internal error");
            }
            $try++;
        } while (User::where('remember_token', $token)->first() instanceof User);

        $contact = User::where('contact', 'LIKE', '%'.$login.'%')->orwhere('dni', $login)->get();

        /*foreach($contact as $i=>$ct) {
           var_dump($contact[$i]->id);
        }*/

        User::where('id',$contact[0]->id)->update(['remember_token'=>$token]);
        //TODO Coger el $token, guardarlo en remember_token de users y mandar el email personalizado a no se quien (porque no existe ningun mail) usando el email predefinido de laravel para este caso de remember token o mejor aun, creando uno nuevo entero

        $passDbEnc = $user->password;
        if(password_verify ($token, $passDbEnc)) {
            dd(false);
            if (Hash::needsRehash($passDbEnc)) {
                dd(true);
                $hashed = Hash::make($token);
                $user->password = $hashed;
                $user->save();
            }
        }

        //$objContact = json_encode($contact);
        $objContact = 'pedroramonmmspam1@gmail.com';
        
        Mail::send('login', ['user' => $objContact], function ($m) use ($user) {
            $m->from('pedroramonmmspam1@gmail.com', 'Your Application');

            $m->to('pedroramonmmspam1@gmail.com', 'Prueba')->subject('Your Reminder!');
        });

        /*
mipagina.com/recovery/password/recuperar.php?cve=239483492384924829928934823948

$_REQUEST["cve"]


////
Ha solicitado la recuperación de su contraseña

Activiades pendientes:
          1.-hacer un update del usuario por campo password(where debe ser unicamente por password)
             -Crear un formulario con dos cajas de texto(input type text) a) Escribe contraseña nueva b) Confirma contraseña nueva , 3 input (hidden) tendra la clave recibida por REQUEST, button submit
             -el controlador tendrà que hacer el update sobre el where password sea igual a la contraseña encriptada por el campo oculto
             - una vez hecho el cambio, redireccionar al login para que se logue con su nueva contraseña

Registro de paciente: formulario con el registro (crear modelo y controlador)


        */
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


