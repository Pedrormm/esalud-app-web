<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Patient;
use App\Role;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
use DateTime;
use DatePeriod;
use DateInterval;

class RecordsController extends Controller
{

    public function __construct()
    {
        // Se puede llamar al middleware desde el constructor
    }

    public function index(string $ord=null, string $sex_fil=null, string $age_fil=null, string $n_search=null) {
        $user = Auth::user();

        if (is_null($ord)){
            $ord = 'user_id';
        }

      //  if ((Schema::hasColumn('users', $ord) || Schema::hasColumn('patients', $ord))) {
            // Comprobar si columna existe en la BD
            $sex = ['male', 'female'];
            if (!is_null($sex_fil) && !empty($sex_fil) && $sex_fil != "no"){
                $sex = explode(" ",$sex_fil);
            }

            $from = get_birthdate_from_yearstring("0");
            $to = get_birthdate_from_yearstring("140");
            if (!is_null($age_fil) && !empty($age_fil) && $age_fil != "no"){
                $splitedDate = explode("-","$age_fil");
                $from = get_birthdate_from_yearstring($splitedDate[0]);
                $to = get_birthdate_from_yearstring($splitedDate[1]);
            }

            $patients = Patient::join('users', 'patients.user_id', 'users.id')->orderBy($ord)
            ->whereIn('sex', $sex)
            ->whereDate('birthdate', '<=', $from)->whereDate('birthdate', '>=', $to)->get()->toArray();
            
            if (!is_null($n_search) && !empty($n_search) && isset($n_search)){
                $patients = Patient::join('users', 'patients.user_id', 'users.id')->orderBy($ord)
                ->whereIn('sex', $sex)
                ->whereDate('birthdate', '<=', $from)->whereDate('birthdate', '>=', $to)
                ->where('name', 'LIKE', '%'.$n_search.'%')
                ->orWhere('lastname', 'LIKE', '%'.$n_search.'%')
                ->orWhere('historic', 'LIKE', '%'.$n_search.'%')
                ->orWhere('dni', 'LIKE', '%'.$n_search.'%')
                ->get()->toArray();
            }
       // }
       //dd($patients[0]['name']);
        return view('user/records', ['patients' => $patients,'user' => $user]);
    }

    public function showRecord(string $id=null) {
        $user = Auth::user();        
        return view('user/singlerecord', ['id' => $id,'user' => $user]);
    }

    public function settings() {
        $user = Auth::user();        
        return view('adjustments/settings', ['user' => $user]);
    }

    public function roleManagement() {
        $user = Auth::user();
        $roles = Role::orderBy("Role.id")->get();
        return view('adjustments/roleManagement', ['user' => $user, 'roles' => $roles]);
    }

    public function updateAvatar(Request $request, $id=null) {
        $authUser = Auth::user();        

        $user = User::find($id);
        $userImage = "";

        // Obteniendo nombre de avatar antiguo para poder borrarlo
        if($user->avatar != null)
            $userImage = $user->avatar;
        // Actualizar en BD
        $user->fill($request->all());
        
        //Update Image
        $file = $request->file('avatar');    

        if($file != null)
        {
            $file_name = $file->getClientOriginalName();
            $file_ext = \File::extension($file_name);

            $time = getTimeName();
            $new_file_name = $time . '.' . $file_ext;

            //Verify if new name already exist
            while (\Storage::exists($new_file_name)) 
            {
                $time = getTimeName();
                $new_file_name = $time . '.' . $file_ext;
            }

            \Storage::disk('avatars')->put($new_file_name,  \File::get($file));

            //Delete old image if exist
            if($userImage != "")
                \Storage::delete($userImage);

            $user->avatar = $new_file_name;
        }
        else{
            //Mostrar error
            var_dump("no hay archivo");
            die();
        }

        $user->save();

        return redirect()->back();
    }
    

}
