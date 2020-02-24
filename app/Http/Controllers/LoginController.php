<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\PieceNew;
use App\Mail\EnviarMail;
use Mail;
use Reminder;

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
                /*
MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=339ee8d373df86
MAIL_PASSWORD=968ef15ce5ac31
MAIL_ENCRYPTION=tls
MAIL_FROM_NAME="${APP_NAME}"
        */

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

        $contact = User::where('email', $login)->orwhere('dni', $login)->get();

        if (count($contact) == 0){ // if the user does not exist
            return redirect()->back()->with(['error' => 'The email or dni provided does not exist']);
        }

        $email = $contact[0]->email;

        User::where('id',$contact[0]->id)->update(['remember_token'=>$token]);
        //TODO Coger el $token, guardarlo en remember_token de users y mandar el email personalizado a no se quien (porque no existe ningun mail) usando el email predefinido de laravel para este caso de remember token o mejor aun, creando uno nuevo entero

  //      $contact = Sentinel::findById($contact->id);
        $reminder = Reminder::exists($contact) ? : Reminder::create($contact);

        var_dump($contact->email);
        var_dump($reminder->code);
        die();

        Mail::send(
            'forgot',
            ['user' => $contact, 'code' => $reminder->code],
            function($message) use ($contact){
                $message->to($contact->email);
                $message->subject("$contact->name $contact->lastname, it has been requested to reset your password");
            }
        );

        //$objContact = json_encode($contact);
        /*
        Mail::send('login', ['user' => $email], function ($m) use ($user) {
         //   $m->from($email, 'Your Application');
            $m->to($email, 'Prueba')->subject('Your Reminder!!');
        });
        */
        return redirect()->back()->with(['sucess' => 'A reset email was sent to the email']);

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


