<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
use DateTime;
use DatePeriod;
use DateInterval;
use DB;

use App\Models\User;
use App\Models\Patient;
use App\Models\Staff;
use App\Models\Role;
use App\Models\Treatment;
use App\Models\Appointment;


class RecordsController extends Controller
{

    public function __construct()
    {
        // Se puede llamar al middleware desde el constructor
    }
    /**
     * @tag #render_menu
     */
    public function index(Request $request) {
        $ord = $request->record_order_type;
        $sex_fil = $request->record_sex_filter;
        $age_fil = $request->record_age_filter;
        $n_search = $request->record_search_filter;

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

        $rol_user = $user->role_id;

        if($rol_user != \HV_ROLES::PATIENT){
            return $this->backWithErrors(\Lang::get('messages.permission_denied'));
        }
		$patient = Patient::getPatientByUser($user->id);
        if (isset($patient[0]))
            $patient = $patient[0];
        // $events = Event::eventsForUser($user->id);
        // $analytics1 = Analytic::analytics_type1_by_user($user->id);
        // $analytics2 = Analytic::analytics_type2_by_user($user->id);
        $treatments = Treatment::medicine_by_user($user->id);
        // $protocols = Protocol::protocol_by_user($user->id);


        $userTreatments = Treatment::query()
        ->with(array('userDoctor' => function($query) {
            $query->select('id','dni','name','lastname');
        }))
        ->with(array('userPatient' => function($query) {
            $query->select('id','dni','name','lastname');
        }))
        ->with("typeMedicine")
        ->with("medicineAdministration")
        ->where("user_id_patient",$id)->get();


        foreach($userTreatments as $row) {
            if ($row->treatment_starting_date){
                $row->startingDate = $this->mysqlDate2Spanish($row->treatment_starting_date);
            }
            else{
                $row->startingDate = null;
            }

            if ($row->treatment_end_date){
                $row->endingDate = $this->mysqlDate2Spanish($row->treatment_end_date);
            }
            else{
                if ($row->treatment_starting_date){
                    $row->endingDate = $this->mysqlDate2Spanish($row->treatment_starting_date->addDays(7));
                }
                else{
                    $row->endingDate = $this->mysqlDate2Spanish(now()->addDays(7));
                }
            }         
        }

        $userTreatments = $userTreatments->toArray();

        if (empty($userTreatments))
            $userTreatments = null;

        $appointments = Appointment::select('appointments.*')->distinct()
        ->groupBy('dt_appointment')
        ->whereDate('dt_appointment', '>', Carbon::today());

        if($rol_user == \HV_ROLES::DOCTOR){
            $appointments = $appointments->where('user_id_doctor',"=",$id);
        }else if($rol_user == \HV_ROLES::PATIENT){
            $appointments = $appointments->where('user_id_patient',"=",$id);
        }

        $appointments = $appointments->with(array('userPatient' => function($query) {
            $query->select('id','name','lastname','dni','role_id', DB::Raw("CONCAT(name, ' ', lastname) AS patientFullName"));
        }))
        ->with(['userDoctor' => function ($query) {
            $query->select('id','name','lastname','dni','role_id', DB::Raw("CONCAT(name, ' ', lastname) AS doctorFullName"));
        }, 'userDoctor.staff' => function ($query) {
            $query->select('id', 'user_id', 'branch_id');
        }, 'userDoctor.staff.branch' => function ($query) {
            $query->select('id', 'name', 'role_id');
        }])
        ->get();

        foreach($appointments as $row) {
            $row->checkedStatus = Appointment::getChecked($row->checked);
         }

        $appointments = $appointments->toArray();

        if (empty($appointments))
            $appointments = null;

        // dd($appointments);

        return view('records.singleRecord')->with('usuario',$user)->with('patient',$patient)
        ->with('treatments',$treatments)->with('userTreatments',$userTreatments)
        ->with('appointments',$appointments);
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


    

}
