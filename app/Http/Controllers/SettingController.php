<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Role;
use App\Models\Patient;
use App\Models\Staff;
use App\Models\Branch;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Mail;

class SettingController extends Controller
{
    public function index(int $id=null) {
        $roles = Role::all();
        $branches = Branch::all();
        $userLogin = auth()->user();
        if (!$id)
            $id = $userLogin->id;
        $rol_usuario_info = "";

        if($userLogin->role_id == \HV_ROLES::PATIENT){
            $rol_usuario_info = Patient::whereUserId($id)->first();
        }elseif(($userLogin->role_id == \HV_ROLES::DOCTOR) || $userLogin->role_id == \HV_ROLES::HELPER){
            $rol_usuario_info = Staff::whereUserId($id)->first();
        }
        else{
            $rol_usuario_info = User::whereId($id)->first();
        }
        if(!$rol_usuario_info) {
            return $this->backWithErrors("UsMaCoEd001: ".\Lang::get('messages.Invalid id'));
        }
        return view('settings/index', compact('userLogin', 'rol_usuario_info', 'roles', 'branches'));
    }

    public function update(Request $request) {
        //  dd($request->all());
        $validatedData = parent::checkValidation([
            'role_id' => 'required|exists:App\Models\Role,id',
            'email' => 'required|email:rfc,dns',
            'name' => 'required',
            'lastname' => 'required',
            'zipcode' => 'numeric',
            'phone' => 'required',
            'birthdate' => 'required|date',
            'sex' => 'required',
            'blood' => 'required',
            'country' => 'string',
            'city' => 'string',
            'address' => 'string',
            'avatar' => 'file'
        ]);
        $token = $request->input('token');
        $mapValidation=[];
        if ($request->input('role_id')==\HV_ROLES::PATIENT){
            $mapValidation = parent::checkValidation([
                'historic' => 'required',
                'height' => 'required|numeric',
                'weight' => 'required|numeric',
            ]);

            $res = Patient::whereUserId($id)->update($mapValidation);
        }
        if (($request->input('role_id')==\HV_ROLES::DOCTOR) || ($request->input('role_id')==\HV_ROLES::HELPER))  {
            $mapValidation = parent::checkValidation([
                'historic' => 'required',
                'branch_id' => 'required|exists:App\Models\Branch,id',
                'shift' => Rule::in(\SHIFTS::$types),
                'office' => 'required|numeric',
                'room' => 'required|numeric',
                'h_phone' => 'required|numeric',
            ]); 
            $res = Staff::whereUserId($id)->update($mapValidation);
        }

        $user_id = $request->input('user_id');
        $usuario = User::find($user_id);

        $validatedData = array_merge($mapValidation, $validatedData);

        $usuario->update($validatedData);

        if ($request->file)
            $this->updateAvatar($request,auth()->user()->id,true);
        // return view('users.index')->with('okMessage', "El usuario: ".$usuario->name." ".$usuario->lastname." ha sido editado correctamente");
    
        $message = \Lang::get('messages.Your user data').$usuario->name." ".$usuario->lastname.\Lang::get('messages.has been edited successfully');

        return $this->jsonResponse(0, $message);
    
    }

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
                return $this->jsonResponse(1, \Lang::get('messages.The file does not have an image format'));
            }
            $ext = $matches[1];
            $image64 = preg_replace($regularExpression, '', $image64);
            $imageBytes = base64_decode($image64);
            $newFileName = getRandomFile($ext);
            $bytes=strlen($imageBytes);
            $imgSizeInMb = strval((int)HV_IMAGE_MAX_SIZE/1000000);
            if ($bytes > HV_IMAGE_MAX_SIZE)
                return $this->jsonResponse(1, \Lang::get('messages.The image cannot be larger than').$imgSizeInMb."Mb");

            \Storage::disk('avatars')->put($newFileName,  $imageBytes);

            $user->avatar = $newFileName;
            $user->save();

            // file_put_contents($destFile, $imageBytes);

            // return $this->jsonResponse(0, "",$destFile);
            return $this->jsonResponse(0, \Lang::get('messages.The avatar has been updated'),$newFileName);
        }
        else{
            return back()->withErrors([\Lang::get('messages.Permission_Denied')]);
        }

    }

    public function confirmAvatarDelete($id=null){
        if (!$id){
            $id = auth()->user()->id;
        }
        $singleUser = User::find($id);
        return view('settings.avatar-confirm-delete',['singleUser' => $singleUser]);  
    }

    public function avatarDestroy(Request $request, $id=null) {
        // dd($request->all());

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
            return $this->jsonResponse(0, \Lang::get('messages.The avatar has been updated'),$sex);
        }
        else{
            return $this->jsonResponse(1, \Lang::get('messages.There was a problem while deleting the avatar'));
        }

    }

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

            // dd($newFileName);
            $destFile = public_path("images/avatars/{$newFileName}");

            file_put_contents($destFile, $imageBytes);
            $url = \Storage::url($newFileName);
            // dd($destFile);
            // return response()->json(['imgFile' => $destFile]);
            return $this->jsonResponse(0, "",$destFile);
        }
        else{
            return back()->withErrors([\Lang::get('messages.Permission_Denied')]);
        }
    
    }

}
