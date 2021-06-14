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
    /**
     * @param int|null $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
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
            return $this->backWithErrors("UsMaCoEd001: ".\Lang::get('messages.invalid_id'));
        }
        return view('settings/index', compact('userLogin', 'rol_usuario_info', 'roles', 'branches'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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
            'avatar' => 'file',
            'news_number' => 'integer|min:1|max:9',
            'has_spelling_checker' => 'integer',
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
        // dd(request()->all());
        $usuario->update($validatedData);

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
