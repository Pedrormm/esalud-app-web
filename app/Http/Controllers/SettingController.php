<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Role;
use App\Models\Patient;
use App\Models\Staff;
use App\Models\MedicalSpeciality;
use App\Models\Country;
use App\Models\PhonePrefix;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Mail;

class SettingController extends Controller
{
    /**
     * @param int|null $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index(int $id=null) {
        $roles = Role::all();
        $medicalSpecialities = MedicalSpeciality::all();
        $userLogin = auth()->user();
        $userLogin->load('countries')->load('phonePrefixes.countries');
        // dd($userLogin->toArray()); 

        if (!$id)
            $id = $userLogin->id;
        $rol_usuario_info = "";
        $countries = Country::all();

        if($userLogin->role_id == \HV_ROLES::PATIENT){
            $rol_usuario_info = Patient::whereUserId($id)->first();
        }elseif(($userLogin->role_id == \HV_ROLES::DOCTOR) || $userLogin->role_id == \HV_ROLES::HELPER){
            $rol_usuario_info = Staff::whereUserId($id)->first();
        }
        else{
            $rol_usuario_info = User::whereId($id)->first();
        }
        if(!$rol_usuario_info) {
            return $this->backWithErrors("UsMaCoEd001: ".\Lang::get('messages.invalid_id'));
        }
        
        return view('settings/index', compact('userLogin', 'rol_usuario_info', 'roles', 'medicalSpecialities','countries'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request) {
        //  dd($request->all());
        if ($request->input('user_id'))
            $user_id = $request->input('user_id');

        # via Facade
        if ($request->input('role_id')==\HV_ROLES::PATIENT){
            $validator = Validator::make($request->all(), [
                'role_id' => 'required|exists:App\Models\Role,id',
                'dni' => 'required|min:9|max:9|unique:users,dni,'.$user_id,
                'email' => 'required|string|email:rfc,dns|max:200|unique:users,email,'.$user_id,
                'name' => 'required',
                'lastname' => 'required',
                'zipcode' => 'numeric',
                'phone' => 'required',
                'birthdate' => 'required|date',
                'sex' => 'required',
                'blood' => 'required',
                'country_id' => 'required|exists:App\Models\Country,id',
                'city' => 'string',
                'address' => 'string',
                'avatar' => 'file',
                'news_number' => 'integer|min:1|max:9',
                'has_spelling_checker' => 'integer',
                'historic' => 'required',
                'height' => 'required|numeric',
                'weight' => 'required|numeric',
            ]);
        }
        else if (($request->input('role_id')==\HV_ROLES::DOCTOR) || ($request->input('role_id')==\HV_ROLES::HELPER))  {
            $validator = Validator::make($request->all(), [
                'role_id' => 'required|exists:App\Models\Role,id',
                'dni' => 'required|min:9|max:9|unique:users,dni,'.$user_id,
                'email' => 'required|string|email:rfc,dns|max:200|unique:users,email,'.$user_id,
                'name' => 'required',
                'lastname' => 'required',
                'zipcode' => 'numeric',
                'phone' => 'required',
                'birthdate' => 'required|date',
                'sex' => 'required',
                'blood' => 'required',
                'country_id' => 'required|exists:App\Models\Country,id',
                'city' => 'string',
                'address' => 'string',
                'avatar' => 'file',
                'news_number' => 'integer|min:1|max:9',
                'has_spelling_checker' => 'integer',
                'historic' => 'required',
                'medical_speciality_id' => 'required|exists:App\Models\MedicalSpeciality,id',
                // 'shift' => Rule::in(\SHIFTS::$types),
                'office' => 'required|numeric',
                'room' => 'required|numeric',
                'h_phone' => 'required|numeric',
            ]);
        }
        else{
            $validator = Validator::make($request->all(), [
                'role_id' => 'required|exists:App\Models\Role,id',
                'dni' => 'required|min:9|max:9|unique:users,dni,'.$user_id,
                'email' => 'required|string|email:rfc,dns|max:200|unique:users,email,'.$user_id,
                'name' => 'required',
                'lastname' => 'required',
                'zipcode' => 'numeric',
                'phone' => 'required',
                'birthdate' => 'required|date',
                'sex' => 'required',
                'blood' => 'required',
                'country_id' => 'required|exists:App\Models\Country,id',
                'city' => 'string',
                'address' => 'string',
                'avatar' => 'file',
                'news_number' => 'integer|min:1|max:9',
                'has_spelling_checker' => 'integer',
            ]);
        }
        
        if ($validator->fails()) {
            $errors = implode("\n",$validator->errors()->all());
            return $this->jsonResponse(1, $errors);
        }


        $usuario = User::find($user_id);

        // dd(request()->all());

        if ($request->input('dni'))
            $dni = $request->input('dni');

        //Check valid DNI letter
        if(!checkDni($dni)) {
            return $this->backWithErrors(\Lang::get('messages.invalid_DNI_format'));
        }

        if ($request->input('email'))
            $email = $request->input('email');
        if ($request->input('name'))
            $name = $request->input('name');
        if ($request->input('lastname'))
            $lastname = $request->input('lastname');
        if ($request->input('address'))
            $address = $request->input('address');

        if ($request->input('country_id'))
            $country_id = $request->input('country_id');
        if ($request->input('city'))
            $city = $request->input('city');
        if ($request->input('zipcode'))
            $zipcode = $request->input('zipcode');
        if ($request->input('phone'))
            $phone = $request->input('phone');
        if ($request->input('birthdate'))
            $birthdate = $request->input('birthdate');
        if ($request->input('sex'))
            $sex = $request->input('sex');
        if ($request->input('blood'))
            $blood = $request->input('blood');

        if ($request->input('hiddenPhoneCode'))
            $hiddenPhoneCode = $request->input('hiddenPhoneCode');
        if ($request->input('hiddenCountryCodeLong'))
            $hiddenCountryCodeLong = $request->input('hiddenCountryCodeLong');

        if (isset ($email))
            $usuario->email = $email;
        if (isset ($dni))
            $usuario->dni = $dni;
        if (isset ($name))
            $usuario->name = $name;
        if (isset ($lastname))
            $usuario->lastname = $lastname;
        if (isset ($address))
            $usuario->address = $address;

        if (isset ($country_id))
            $usuario->country_id = $country_id;
        if (isset ($city))
            $usuario->city = $city;
        if (isset ($zipcode))
            $usuario->zipcode = $zipcode;
        if (isset ($phone))
            $usuario->phone = $phone;
        if (isset ($birthdate))
            $usuario->birthdate = $birthdate;
        if (isset ($sex))
            $usuario->sex = $sex;
        if (isset ($blood))
            $usuario->blood = $blood;
        if (isset ($hiddenPhoneCode)){
            $code = substr($hiddenPhoneCode, 1);
            // dd($code);
            $phonePrefixId = PhonePrefix::where('prefix',$code)->value('id');
            $usuario->phone_prefix_id = $phonePrefixId;
            // dd($phonePrefixId);
        }

        $usuario->save();



        if ($request->input('role_id')==\HV_ROLES::PATIENT){
            $patientId = Patient::where("user_id",$user_id)->value('id');
            $patient = Patient::find($patientId);

            if ($request->input('historic'))
                $patientHistoric = $request->input('historic');
            if ($request->input('height'))
                $height = $request->input('height');
            if ($request->input('weight'))
                $weight = $request->input('weight');

            if (isset ($patientHistoric))
                $patient->historic = $patientHistoric;
            if (isset ($height))
                $patient->height = $height;
            if (isset ($weight))
                $patient->weight = $weight;

            $patient->save();
        }

        if (($request->input('role_id')==\HV_ROLES::DOCTOR) || ($request->input('role_id')==\HV_ROLES::HELPER))  {
            $staffId = Patient::where("user_id",$user_id)->value('id');
            $staff = Staff::find($staffId);

            if ($request->input('historic'))
                $staffHistoric = $request->input('historic');
            if ($request->input('medical_speciality_id'))
                $medical_speciality_id = $request->input('medical_speciality_id');
            if ($request->input('office'))
                $office = $request->input('office');
            if ($request->input('room'))
                $room = $request->input('room');
            if ($request->input('h_phone'))
                $h_phone = $request->input('h_phone');

            if (isset ($staffHistoric))
                $staff->historic = $staffHistoric;
            if (isset ($medical_speciality_id))
                $staff->medical_speciality_id = $medical_speciality_id;
            if (isset ($office))
                $staff->office = $office;
            if (isset ($room))
                $staff->room = $room;
            if (isset ($h_phone))
                $staff->h_phone = $h_phone;

            $staff->save();
        }



        if (($request->news_number) || ($request->has_spelling_checker)){
            $specialFieldsUser = User::find($user_id);
            if ($request->news_number)
                $specialFieldsUser->news_number = $request->news_number;
            if ($request->has_spelling_checker)
                $specialFieldsUser->has_spelling_checker = $request->has_spelling_checker;
            $specialFieldsUser->save();
        }

        if ($request->file)
            $this->updateAvatar($request,auth()->user()->id,true);
        // return view('users.index')->with('okMessage', "El usuario: ".$usuario->name." ".$usuario->lastname." ha sido editado correctamente");

        $message = \Lang::get('messages.your_user_data')." (".$usuario->name." ".$usuario->lastname.") ".\Lang::get('messages.has_been_edited_successfully');

        return $this->jsonResponse(0, $message);

    }

    /**
     * @param Request $request
     * @param null $id
     * @param false $local
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function updateAvatar(Request $request, $id=null, $local=false) {
        // dd($request->all());

        if ($request->ajax()){
            if (!$id){
                $id = auth()->user()->id;
            }
            $user = User::find($id);

            if ($user->avatar){
                \Storage::disk('avatars')->delete($user->avatar);
            }
            $image64 = $request->data;
            $regularExpression = "/^data\:image\\/([\w]{3,4});base64,/"; //data:image/png;base64,
            if(!preg_match($regularExpression, $image64, $matches)) {
                return $this->jsonResponse(1, \Lang::get('messages.the_file_does_not_have_an_image_format'));
            }
            $ext = $matches[1];
            $image64 = preg_replace($regularExpression, '', $image64);
            $imageBytes = base64_decode($image64);
            $newFileName = getRandomFile($ext);
            $bytes=strlen($imageBytes);
            $imgSizeInMb = strval((int)HV_IMAGE_MAX_SIZE/1000000);
            if ($bytes > HV_IMAGE_MAX_SIZE)
                return $this->jsonResponse(1, \Lang::get('messages.the_image_cannot_be_larger_than')." ".$imgSizeInMb."Mb");

            \Storage::disk('avatars')->put($newFileName,  $imageBytes);

            $user->avatar = $newFileName;
            $user->save();

            // file_put_contents($destFile, $imageBytes);

            // return $this->jsonResponse(0, "",$destFile);
            return $this->jsonResponse(0, \Lang::get('messages.the_avatar_has_been_updated'),$newFileName);
        }
        else{
            return back()->withErrors([\Lang::get('messages.permission_denied')]);
        }

    }

    /**
     * @param null $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function confirmAvatarDelete($id=null){
        if (!$id){
            $id = auth()->user()->id;
        }
        $singleUser = User::find($id);
        return view('settings.avatar-confirm-delete',['singleUser' => $singleUser]);
    }

    /**
     * @param Request $request
     * @param null $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function avatarDestroy(Request $request, $id=null) {
        if (!$id){
            $id = auth()->user()->id;
        }
        $userLogged = User::find($id);
        $sex = $userLogged->sex;

        if ($userLogged->avatar){
            \Storage::disk('avatars')->delete($userLogged->avatar);
        }

        if($userLogged) {
            $userLogged->avatar = '';
            $userLogged->save();
            return $this->jsonResponse(0, \Lang::get('messages.the_avatar_has_been_updated'),$sex);
        }
        else{
            return $this->jsonResponse(1, \Lang::get('messages.there_was_a_problem_while_deleting_the_avatar'));
        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function convertAvatar(Request $request){

        if ($request->ajax()){
            $image64 = $request->bytes64;
            $regularExpression = "/^data\:image\\/([\w]{3,4});base64,/"; //data:image/png;base64,
            if(!preg_match($regularExpression, $image64, $matches)) {
                return $this->jsonResponse(1, "Invalid image format");
            }
            $ext = $matches[1];
            $image64 = preg_replace($regularExpression, '', $image64);
            $imageBytes = base64_decode($image64);
            $newFileName = getRandomFile($ext);

            $destFile = public_path("images/avatars/{$newFileName}");

            file_put_contents($destFile, $imageBytes);
            $url = \Storage::url($newFileName);
            // dd($destFile);
            // return response()->json(['imgFile' => $destFile]);
            return $this->jsonResponse(0, "",$destFile);
        }
        else{
                return back()->withErrors([\Lang::get('messages.permission_denied')]);
        }

    }

}
