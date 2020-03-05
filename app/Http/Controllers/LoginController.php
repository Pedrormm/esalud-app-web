<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\PieceNew;
use App\Message;
use App\Mail\EnviarMail;
use Mail;
use Reminder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Session;


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

        if($remember){
            \Cookie::queue('credencialesDni', $request->dni, 10080);
            // La cookie se guarda 1 semana
        }
        else{
            \Cookie::queue(\Cookie::forget('credencialesDni'));
        }

        if (Auth::attempt($credentials, $remember)) {
            // Autenticacion realizada...
            $user = auth()->user();
            return redirect()->action('LoginController@index');
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

        $contact = User::where('email', $login)->orwhere('dni', $login)->get();

        if (count($contact) == 0){ // Si el usuario no existe
            return redirect()->back()->with(['error' => 'The email or dni provided does not exist']);
        }

        $email = $contact[0]->email;

        User::where('id',$contact[0]->id)->update(['remember_token'=>$token]);
        // Guardar en BD el token
        
        Mail::send('mail.forgot', ['token' => $token, 'name' => $contact[0]->name], function ($m) use ($contact) {
            $m->to($contact[0]->email);
            $m->subject(urldecode($contact[0]->name)." ". urldecode($contact[0]->lastname).", it has been requested to reset your password");
        });
        
        return redirect()->back()->with(['sucess' => 'A reset email was sent to the email']);

    }

    public function forgotPassword($token=null){
        $user = User::where('remember_token', $token)->get();
        if ((empty($token)) || (count($user) == 0)){
            return redirect('/')->withError("Invalid route");
        }
        return view('mail.resetpassword', ['token' => $token]);        
    }

    public function changePassword(Request $request){
        $validatedData = Validator::make($request->all(), [
            'password' => 'required|confirmed|min:6',
        ]); // Tiene que haber un campo 'password_confirmation' para que se pueda dar la validación confirmed
        
        if ($validatedData->fails()){
            return redirect()->back()->withError($validatedData->messages()->first());
        }

        $pass = Hash::make($request->password);

        User::where('remember_token', $request->token)->update(['password'=>$pass]);

        return redirect('/')->with(['sucess' => 'The password has been changed']);
    }

    const MAX_MESSAGE_LENGTH = 15;

    public function index() {
        $user = Auth::user();        
        $news = PieceNew::orderByDesc('date')->get();

        $userMessages = Message::where('user_id_to', $user->id)->orderByDesc('created_at')->get();
        foreach($userMessages as $i=>$userMessage) {
            $text = urldecode($userMessage->message);
            /*if(strlen($text) > self::MAX_MESSAGE_LENGTH) {
                $text = substr($text, 0, self::MAX_MESSAGE_LENGTH) . " ...";
            }*/
            $userMessage->messageCorrected = $text;
            $userMessages[$i] = $userMessage;
        }

        return view('user.dashboard', ['user' => $user,'news' => $news, 'userMessages' => $userMessages]);
    }
    
    public function logout(Request $request) {
        Auth::logout();
        return redirect('/')->withError("Session closed");
    }
}


