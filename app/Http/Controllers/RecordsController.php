<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
use DateTime;
use DatePeriod;
use DateInterval;

use App\Models\User;
use App\Models\Patient;
use App\Models\Staff;
use App\Models\Event;
use App\Models\Role;
use App\Models\Analytic;
use App\Models\Medicine;
use App\Models\Protocol;

class RecordsController extends Controller
{

    public function __construct()
    {
        // Se puede llamar al middleware desde el constructor
    }
    /**
     * @tag #render_menu
     */
    public function index(string $ord=null, string $sex_fil=null, string $age_fil=null, string $n_search=null) {

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
       
        $flagsMenuEnabled = getAuthValueFromPermission();
        return view('records/index', ['patients' => $patients, 'flagsMenuEnabled' => $flagsMenuEnabled]);
    }

    public function showRecord($id) {
		$user = User::find($id);	
		$patient = Patient::getPatientByUser($user->id);
        $events = Event::eventsForUser($user->id);
        $analytics1 = Analytic::analytics_type1_by_user($user->id);
        $analytics2 = Analytic::analytics_type2_by_user($user->id);
        $medicines = Medicine::medicine_by_user($user->id);
        $protocols = Protocol::protocol_by_user($user->id);

        foreach ($events as $event){
            $event->doctorFullName = User::find($event->user_id_doctor)->name . " " . User::find($event->user_id_doctor)->lastname;
        }
        return view('records.singleRecord')->with('usuario',$user)->with('patient',$patient)
        ->with('events',$events)->with('analytics1',$analytics1)->with('analytics2',$analytics2)
        ->with('medicines',$medicines)->with('protocols',$protocols);
    }

    public function showOwnRecord() {
        $id = Auth::user()->id;

        $user = Role::select('u.*','roles.name AS role_name')->join('users AS u', 'roles.id', 'u.role_id')->where("u.deleted_at",null)->where("u.id",$id)->get();
        $user = $user[0];

        if ($user->role_id == \HV_ROLES::PATIENT){
            return ($this->showRecord($id));            
        }
        else if (($user->role_id == \HV_ROLES::DOCTOR) || ($user->role_id == \HV_ROLES::HELPER)) {
            $user = Staff::select('users.*','staff.*','roles.name AS role_name', 'branches.name AS branch_name', 'staff.id AS staff_id', 'users.id AS users_id')->join('users', 'staff.user_id', 'users.id')->join('branches', 'staff.branch_id', 'branches.id')->join('roles', 'users.role_id', 'roles.id')->where("users.deleted_at",null)->where("users.id",$id)->get();
            // dd($user->toArray());
            $user = $user[0];
        }
        // dd($user->toArray());

        return view('records.ownRecord')->with('usuario',$user);
    }

    public function settings() {
        return view('adjustments/settings');
    }

    public function updateAvatar(Request $request, $id=null) {
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
            //Showing an error
            if($request->ajax()) {
                return response()->json([
                    'status'=>1,
                    'messages'=>'There is no file'
                ]);
            }
            else{
                return back()->withErrors(['There is no file', 'No file']);
            }
        }

        $user->save();

        return redirect()->back();
    }
    

}
