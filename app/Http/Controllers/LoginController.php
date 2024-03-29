<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\PieceNew;
use App\Models\Message;
use App\Mail\EnviarMail;
use Mail;
use Reminder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Session;


use App\Mail\InvitationNewUserMail;
use App\Mail\WelcomeNewUserMail;
use App\Mail\ForgotPasswordMail;



use Illuminate\Support\Str;

class LoginController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request) {
        $remember = $request->has('remember') ? true : false;
        if(!$request->has('dni')) {
            return back()->withErrors(\Lang::get('messages.authentication_failed'));
        }
        $rules = array();
        $rules['password'] = 'required';
        if(filter_var($request->dni, FILTER_VALIDATE_EMAIL)) {
            $rules['dni'] = 'required|email:rfc,dns|max:200';
            $isEmail = true;
        }
        else {
            $rules['dni'] = 'required';
            $isEmail = false;
        }
        $validatedData = $request->validate($rules);
        // $validatedData = $request->validate([
        //     // 'dni' => 'min:4|max:10|exists:users,dni',
        //     'dni' => 'nullable|required_without:email',
        //     'email' => 'nullable|required_without:dni|email:rfc,dns|max:200',
        //     'password' => 'required',
        // ]);
        if($isEmail) {
            //Todo saco el dini del usuario
            $dni = User::whereEmail($request->dni)->value('dni');
            if(is_null($dni)) {
                return back()->withErrors(\Lang::get('messages.authentication_failed'));
            }
            $credentials = [
                'dni' => $dni,
                'password' => $request->password
            ];
        }
        else {
            $credentials = $request->only('dni', 'password');
        }
        

        if($remember){
            \Cookie::queue('credencialesDni', $request->dni, 10080);
            // La cookie se guarda 1 semana
        }
        else{
            \Cookie::queue(\Cookie::forget('credencialesDni'));
        }

        if (Auth::attempt($credentials, $remember)) {
            // Authutentication succeded...

            $user = auth()->user();

            if(Hash::needsRehash($user->password)) {
                $user->password = Hash::make($request->password);
                $user->save();
            }
            Session::put('lang', $user->language);

            return redirect()->action('LoginController@index');
        }
        return back()->withErrors(\Lang::get('messages.authentication_failed'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginForgotten(Request $request) {
        $login = $request->rem_password;
       
        if(filter_var($login, FILTER_VALIDATE_EMAIL)) 
            $user = User::whereEmail($login)->first();
        else
            $user = User::where('dni', $login)->first();

        if(is_null($user)) {
            // return back()->withErrors("Invalid login");
            return response()->json(['status' => 1, 'message' => \Lang::get('messages.the_email_or_DNI_provided_does_not_exist')]);
        }

        $maxSteps = 1000; //We do not allow this for security reasons
        $try = 0;
        do {
            $token = Str::random(32);
            // var_dump($token);
            $user->remember_token = $token;
            if($try >= $maxSteps) {
                // Caso muy excepcional, que no deberia pasar a no ser que tengamos millones de usuarios
                // return back()->withErrors("internal_error");
                return response()->json(['status' => 1, 'message' => \Lang::get('messages.internal_error')]);

            }
            $try++;
        } while (User::where('remember_token', $token)->first() instanceof User);

        $contact = User::where('email', $login)->orwhere('dni', $login)->get();
        if (count($contact) == 0){ // Si el usuario no existe
            // return redirect()->back()->with(['error' => \Lang::get('messages.the_email_or_DNI_provided_does_not_exist')]);
            return response()->json(['status' => 1, 'message' => \Lang::get('messages.the_email_or_DNI_provided_does_not_exist')]);
        }
        $currentLanguage = \Lang::locale();

        $email = $contact[0]->email;
        $name = $contact[0]->name;
        $language = $contact[0]->language;
        User::where('id',$contact[0]->id)->update(['remember_token'=>$token]);
        // Guardar en BD el token

        // \Mail::send('mail.forgot', ['token' => $token, 'name' => $contact[0]->name], function ($m) use ($contact) {
        //     $m->to($contact[0]->email);
        //     $m->subject(urldecode($contact[0]->name)." ". urldecode($contact[0]->lastname).", it has been requested to reset your password");
        // });

        $res = \Mail::to($email)->send(new ForgotPasswordMail($token, $name, $language));
        app()->setLocale($currentLanguage);

        // $res = Mail::to($contact[0]->email)->send(new InvitationNewUserMail($token, $contact[0]->name));

        // return redirect()->back()->with(['successful' => 'A reset email was sent to the email']);
        return response()->json(['status' => 0, 'message' => \Lang::get('messages.a_reset_email_was_sent_to_your_email')]);

    }

    /**
     * @param null $token
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function forgotPassword($token=null){
        $user = User::where('remember_token', $token)->get();
        if ((empty($token)) || (count($user) == 0)){
            return redirect('/')->withError(\Lang::get('messages.invalid_route'));
        }
        if ($user[0]){
            $user = $user[0];
            $language = $user->language;
            app()->setLocale($language);        
        }

        return view('mail.resetpassword', ['token' => $token]);
    }

    /**
     *
     * Whenever the pass is swifted in the option menu, an optional mail has to be sent for security reasons, like "Your password have been changed from the IP x".
     * The email can also be changed (Meanwhile, the email state would be a 'pending to be verified'). If the email is not changed, the email would be the previous one
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function changePassword(Request $request){
        // dd($request->all());

        # via Facade
        $validator = Validator::make($request->all(), [
            // 'password' => 'required|string|min:6|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'password' => 'required|string|min:6|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[\W]).{6,}$/',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $pass = Hash::make($request->password);

        User::where('remember_token', $request->token)->update(['password'=>$pass]);
        return redirect('/')->with(['successful' => \Lang::get('messages.the_password_has_been_changed')]);
    }

    const MAX_MESSAGE_LENGTH = 15;

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index() {
        $user = Auth::user();

        return view('dashboard.index', ['user' => $user]);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function logout(Request $request) {
        Auth::logout();
        return redirect('/')->withError(\Lang::get('messages.session_closed'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function isPasswordForgotten(Request $request){
        if ($request->ajax()){
            return view('login-is-password-forgotten');
        }
        else{
            $this->errorNotAjax($request, \Lang::get('messages.permission_denied'));
            // return $this->jsonResponse(1, "Permiso denegado");
        }
    }

    /**
     * @param string $lang
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setLanguage(string $lang="es") {

        $userLogged = auth()->user();
        if (isset ($lang)){
            $userLogged->language = $lang;
            $userLogged->save();
        }
        Session::put('lang', $lang);
        // switch ($lang) {
        //     case "es":
        //         Session::put('lang', 'es');
        //         break;
        //     case "en":
        //         Session::put('lang', 'en');
        //         break;
        //     case "it":
        //         Session::put('lang', 'it');
        //         break;
        //     case "pt":
        //         Session::put('lang', 'pt');
        //         break;
        //     case "fr":
        //         Session::put('lang', 'fr');
        //         break;
        //     case "ro":
        //         Session::put('lang', 'ro');
        //         break;
        //     case "de":
        //         Session::put('lang', 'de');
        //         break;
        //     case "ar":
        //         Session::put('lang', 'ar');
        //         break;
        //     case "ru":
        //         Session::put('lang', 'ru');
        //         break;
        //     case "zh_CN":
        //         Session::put('lang', 'zh_CN');
        //         break;
        //     case "ja":
        //         Session::put('lang', 'ja');
        //         break;
        //     default:
        //         Session::put('lang', 'es');
        // }

        return back();
    }
}


