<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Appointment;
use App\Models\User;
use App\Models\StaffSchedule;
use App\Models\Patient;
use App\Models\Staff;
use App\Models\SpecialitiesStaff;
use Mail;
use Carbon\Carbon;
use App\Mail\CreateAppointmentMail;
use App\Rules\NotExists;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(2);
        $userLogin = auth()->user();
        $rol_user = $userLogin->role_id;

        if($rol_user == \HV_ROLES::ADMIN){
            $appointments = Appointment::with('userPatient')->with('userDoctor')->get();
        }else if($rol_user == \HV_ROLES::DOCTOR){
            $appointments = Appointment::where('user_id_doctor',"=",$userLogin->id)->with('userPatient')->with('userDoctor')->get();
        }else if($rol_user == \HV_ROLES::PATIENT){
            $appointments = Appointment::where('user_id_patient',"=",$userLogin->id)->with('userPatient')->with('userDoctor')->get();
        }

        $appointmentType ="all";

        // dd($appointments->toArray());

        return view('appointments.index')->with('appointmentType',$appointmentType)->with('appointments',$appointments->toArray());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userLogin = auth()->user();
        // $rol_user = $userLogin->role_id();
        $patients = User::select('id','name','lastname','dni','role_id')->whereRoleId(\HV_ROLES::PATIENT)->get();
        $doctors = User::select('id','name','lastname','dni','role_id')->whereRoleId(\HV_ROLES::DOCTOR)->with('staff.branch')->get()->toArray();
        // dd($doctors[0]["staff"][0]["branch"]["name"]);
        // dd($doctors);
        return view('appointments.create')->with('user',$userLogin)
                                        // ->with('role',$rol_user)
                                        ->with('patients',$patients)
                                        ->with('doctors',$doctors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // dd($request->all());
        $validatedData = parent::checkValidation([
            'user_id_patient' => 'required',
            // 'user_id_creator' => 'required',
            'doctor_id' => 'required',
            // 'dt_appointment' => ['required', new NotExists('appointments','dt_appointment')],
            'dt_appointment' => 'required|unique:App\Models\Appointment,dt_appointment',
            // 'checked' => 'required|min:0|max:0|numeric',
            // 'accomplished' => 'required|min:0|max:0|numeric',
            
        ]);
        // TODO: Generacion citas. Crear calendario para ver citas con dia y hora. -
        // Notificacion de cita en dashboard, para que aparezca nueva cita, al verlas desaparece. Hacer con pusher js
        
        $user_id_patient = $request->input('user_id_patient');
        $user_id_doctor = $request->input('doctor_id');
        $dt_appointment = $request->input('dtime');
            
        
        $userPatient = User::find($user_id_patient);
        $userPatient = $userPatient->name . " " . $userPatient->lastname;
        $userDoctor = User::find($user_id_doctor);
        $userDoctor = $userDoctor->name . " " . $userDoctor->lastname;
        $spanishDate = $this->mysqlDateTime2Spanish($dt_appointment).":00";

        if (Appointment::where('dt_appointment', $dt_appointment)->where('user_id_patient', $user_id_patient)
        ->where('user_id_doctor', $user_id_doctor)->exists()) {
            return $this->backWithErrors(\Lang::get('messages.there_is_already_the_same_appointment') );
        }
        $userAuthRole = auth()->user()->role_id;
        $appointment = new Appointment();
        $appointment->user_id_patient = $user_id_patient;
        $appointment->user_id_doctor = $user_id_doctor;
        $appointment->dt_appointment = $dt_appointment;
        $appointment->user_id_creator = auth()->user()->id;
        $appointment->checked = 0;
        $appointment->accomplished = 0;
        $appointment->save();

        // $user_role_creator = User::select()->whereId(auth()->user()->id)->with('roles');
        $appointment = Appointment
        // ::with(['userCreator:id,role_id.roles.name'])´
        ::with(['userCreator' => function ($query) {
            $query->select('id','role_id', 'dni');
        }, 'userCreator.roles' => function ($query) {
            $query->select('id', 'name');
        }])
        ->find($appointment->id);
        

        
        // dd($appointment);
        // Crear email con fichero calendar adjunto. 

        $appointments = Appointment::with(["userPatient","userCreator","userDoctor"])->find($appointment->id);

        $this->sendMailNewAppointment($appointments, $userAuthRole);
        $message = \Lang::get('messages.an_appointment_between_the_patient')." ".$userPatient." ".\Lang::get('messages.and_the_doctor')." ".$userDoctor." ".\Lang::get('messages.on_the_date')." ".$spanishDate." ".\Lang::get('messages.has_been_succesfully_created');
        // return $this->create()->with('okMessage', "Una invitación de cita médica entre el paciente ".$userPatient." y el médico ".$userDoctor." con fecha de ".$spanishDate." ha sido creada correctamente")
        // ->with('createAppointment', true);

        

        return $this->jsonResponse(0, $message, $appointment);

        //return response()->json(compact('response'),201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $appointment = Appointment::find($id);
        return view('appointments.show')->with('appointments',$appointment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $appointment = Appointment::whereId($id)->with('userPatient')->with('userCreator')->with('userDoctor')->get()->toArray();
        $userLogin = auth()->user();
        // dd($appointment);
        if ($appointment[0]){
            $dtAppointment = str_replace(" ", "T", $appointment[0]['dt_appointment']);
            $dtAppointment = mb_substr($dtAppointment, 0, -3);
            return view('appointments.edit')->with('userLogin',$userLogin)
            ->with('appointment',$appointment)->with('dtAppointment',$dtAppointment);
        }
        else{
            return $this->backWithErrors(\Lang::get('messages.not_a_valid_appointment') );   
        }
                                    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        if (auth()->user()->role_id == \HV_ROLES::PATIENT){
            $validatedData = parent::checkValidation([
                'appointmentChecked' => 'required',
            ]);
        }
        else{
            $validatedData = parent::checkValidation([
                'dateTimeOther' => 'required',
                'appointmentChecked' => 'required',
                'appointmentAccomplished' => 'required',
            ]);
        }


        $appointment = Appointment::find($id);      

        // $appointment->update($request->all());

        if ($request->input('dateTimeOther'))
            $dt_appointment = $request->input('dateTimeOther');
        if ($request->input('appointmentChecked'))
            $checked = $request->input('appointmentChecked');
        if ($request->input('appointmentAccomplished'))
            $accomplished = $request->input('appointmentAccomplished');
        if ($request->input('doctorComments'))
            $comments = $request->input('doctorComments');
        if ($request->input('patientComments'))
            $user_comment = $request->input('patientComments');
       
        if (isset ($dt_appointment))
            $appointment->dt_appointment = $dt_appointment;
        if (isset ($checked))
            $appointment->checked = $checked;
        if (isset ($accomplished))
            $appointment->accomplished = $accomplished;
        if (isset ($comments))
            $appointment->comments = $comments;
        if (isset ($user_comment))
            $appointment->user_comment = $user_comment;
        $appointment->save();

        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $appointmentToDelete = Appointment::find($id);
        $appointmentDate = $appointmentToDelete->dt_appointment;
        $spanishDate = $this->mysqlDateTime2Spanish($appointmentDate);
        if (empty($appointmentToDelete)) {
            return $this->jsonResponse(1, \Lang::get('messages.appointment_not_found')); 
        }

        $appointmentToDelete->delete($id);
        
        return $this->jsonResponse(0, \Lang::get('messages.the_appointment_which_date_is_on')." ".$spanishDate." ".\Lang::get('messages.has_been_deleted_succesfully'));
    }

    public function realDoctorSchedule(Request $request)
    {
        
        if ($request->ajax()){
            
            $dateMonday = Carbon::parse($request->date)->startOfWeek();
           
            $dateSunday = Carbon::parse($request->date)->startOfWeek()->addWeek(1);

            // $weekdayRealAppointment = Carbon::parse($request->date)->dayOfWeek;

            $staffId = Staff::where('user_id',$request->doctorId)->get();
            $id = null;
            if ($staffId[0]){
                $id = $staffId[0]->id;
            }
            else{
                return response()->json(false);
            }

            $staffSchedule = StaffSchedule::
            where('staff_id',$id)
            ->orderBy('weekday')
            ->orderBy('starting_workday_time')
            ->get()->toArray();

            // dd($staffSchedule);
            $hoursWeek = [];
            foreach ($staffSchedule as $key=>$value){
                $hoursWeek[$value['weekday']][] = [$value['starting_workday_time'],$value['ending_workday_time']];
            }

            // dd($hoursWeek);


// DB::enableQueryLog();

            $realAppointments = Appointment::whereIn('checked',[\HV_APPOINTMENT_CHECKS::PENDING,\HV_APPOINTMENT_CHECKS::ACCEPTED])
            ->where("user_id_doctor",$request->doctorId)
            ->whereBetween('dt_appointment', [$dateMonday, $dateSunday])
            ->orderBy('dt_appointment')
            ->distinct()
            ->groupBy('dt_appointment')
            ->get();

            // dd($realAppointments->toArray());   

            $minutesPerDate = 30;
            $rpArray = [];
            foreach ($realAppointments as $key=>$value){
                // dump(($value["dt_appointment"]));
                $weekday = Carbon::parse($value["dt_appointment"])->dayOfWeek;
                $weekday = ($weekday == 0)?7:$weekday;
                
                $timeStringIni = Carbon::parse($value["dt_appointment"])->toTimeString();
                
                if ($minutesPerDate == 30){  
                    list($hours,$minutes) = explode(":", $timeStringIni);
                    if(!in_array((int)$minutes, [0, $minutesPerDate])) {
                        $iMinutes = (int)$minutes;
                        $iHours = (int)$hours;
                    
                        $corrections = [15, 29, 45, 59];
                        
                        if($iMinutes < $corrections[1] && $iMinutes < $corrections[0])
                            $iMinutes = 0;
                        elseif(($iMinutes <$corrections[1] && $iMinutes > $corrections[0])||
                            ($iMinutes > $corrections[1] && $iMinutes < $corrections[2]))
                            $iMinutes = $minutesPerDate;
                        else {
                            $iHours++;
                            $iMinutes = 0;
                        }
                        
                        $timeStringIni = str_pad($iHours, 2, "0", STR_PAD_LEFT) .":" . str_pad($iMinutes, 2, "0", STR_PAD_LEFT).":00";
                    }
                }

                // dd($timeStringIni);
                $timeStringEnd = Carbon::parse($timeStringIni)->addMinutes($minutesPerDate)->toTimeString();
                // dd($timeStringEnd);
                $rpArray[$weekday][] = [$timeStringIni, $timeStringEnd];
                // dd($rpArray);
                // $hoursWeek[$value['weekday']][] = [$value['starting_workday_time'],$value['ending_workday_time']];
            }

            if ((empty($staffSchedule))){
                return response()->json(false);
            }
            else{
                return response()->json([$hoursWeek,$rpArray]);
            }
        }
    }

    public function calendar(){

        $userLogin = auth()->user();
        $rol_user = $userLogin->role_id;

        if($rol_user == \HV_ROLES::ADMIN){
            $appointments = Appointment::with('userPatient')->with('userDoctor');
        }else if($rol_user == \HV_ROLES::DOCTOR){
            $appointments = Appointment::where('user_id_doctor',"=",$userLogin->id)->with('userPatient')->with('userDoctor');
        }else if($rol_user == \HV_ROLES::PATIENT){
            $appointments = Appointment::where('user_id_patient',"=",$userLogin->id)->with('userPatient')->with('userDoctor');
        }

        $appointments = $appointments->distinct()
        ->groupBy('dt_appointment')
        ->get();
        
        foreach($appointments as $ap) {
            $ap["fullNameCreator"] = User::find($ap->user_id_creator)->name . " " . User::find($ap->user_id_creator)->lastname;
            $ap["fullNamePatient"] = User::find($ap->user_id_patient)->name . " " . User::find($ap->user_id_patient)->lastname;
            $ap["fullNameDoctor"] = User::find($ap->user_id_doctor)->name . " " . User::find($ap->user_id_doctor)->lastname;
        }

        return view('appointments.calendar')->with('appointments',$appointments)->with('rol_user',$rol_user);
    }

    public function showCalendar($id){
        // dd($id);
        $userLogin = auth()->user();
        $rol_user = $userLogin->role_id;

        $appointment = Appointment::find($id);
        $especialidad = DB::select('SELECT branches.name FROM appointments INNER JOIN staff ON appointments.user_id_doctor = staff.user_id INNER JOIN branches ON staff.branch_id = branches.id WHERE appointments.user_id_doctor = '.$appointment->user_id_doctor.'');
        

        $data = Appointment::select('appointments.*')->distinct()->where('id',"=",$id)
        ->groupBy('dt_appointment')
        ->with(array('userPatient' => function($query) {
            $query->select('id','name','lastname','dni','role_id', DB::Raw("CONCAT(name, ' ', lastname) AS patientFullName"));
        }))
        ->with(['userDoctor' => function ($query) {
            $query->select('id','name','lastname','dni','role_id', DB::Raw("CONCAT(name, ' ', lastname) AS doctorFullName"));
        }, 'userDoctor.staff' => function ($query) {
            $query->select('id', 'user_id', 'branch_id');
        }, 'userDoctor.staff.branch' => function ($query) {
            $query->select('id', 'name', 'role_id');
        }])
        ->get()->toArray();

        if ($data[0])
            $data = $data[0];
        // dd($data);

        return view('appointments.showCalendar')->with('appointment',$appointment)->with('especialidad',$especialidad);
    }

    public function listPending()
    {
        $usuarioLogin = auth()->user();
        
        $appointments = Appointment::where('user_id_patient',"=",$usuarioLogin->id)->with('userPatient')->with('userDoctor')->get();
        $appointmentType ="pending";
        // return view('appointments.listPending')->with('appointments',$appointments->toArray());
        return view('appointments.index')->with('appointmentType',$appointmentType)->with('appointments',$appointments->toArray());

    }

    public function listAccepted()
    {
        $usuarioLogin = auth()->user();

        $appointments = Appointment::where('user_id_patient',"=",$usuarioLogin->id)->with('userPatient')->with('userDoctor')->get();
        $appointmentType ="accepted";

        return view('appointments.index')->with('appointmentType',$appointmentType)->with('appointments',$appointments->toArray());
    }

    public function listRejected()
    {
        $usuarioLogin = auth()->user();

        $appointments = Appointment::where('user_id_patient',"=",$usuarioLogin->id)->with('userPatient')->with('userDoctor')->get();
        $appointmentType ="rejected";

        return view('appointments.index')->with('appointmentType',$appointmentType)->with('appointments',$appointments->toArray());
    }

    public function listOld()
    {
        $usuarioLogin = auth()->user();

        $appointments = Appointment::where('user_id_patient',"=",$usuarioLogin->id)->with('userPatient')->with('userDoctor')->get();
        $appointmentType ="old";

        return view('appointments.index')->with('appointmentType',$appointmentType)->with('appointments',$appointments->toArray());
    }


    public function showAppointmentIcon(){
        $userLogin = auth()->user();
        $rol_user = $userLogin->role_id;        

        $data = Appointment::select('appointments.*')->distinct();
        if($rol_user == \HV_ROLES::DOCTOR){
            $data = $data->where('user_id_doctor',"=",$userLogin->id);
        }else if($rol_user == \HV_ROLES::PATIENT){
            $data = $data->where('user_id_patient',"=",$userLogin->id);
        }

        $data = $data->where('checked', 0)->orderByDesc('created_at')
        ->whereDate('dt_appointment', '>', Carbon::today())
        ->get()->toArray();

        $nAppointments = count($data);

        if(($rol_user != \HV_ROLES::DOCTOR) && ($rol_user != \HV_ROLES::PATIENT) && ($rol_user != \HV_ROLES::ADMIN)){
            $nAppointments = 0;
        }

        return view('appointments.icon', compact('nAppointments'));
    }

    public function showAppointmentsSummary(){
        $authUser = Auth::user();
        $rol_user = $authUser->role_id;        

        $data = Appointment::select('appointments.*')->distinct();
        if($rol_user == \HV_ROLES::DOCTOR){
            $data = $data->where('user_id_doctor',"=",$authUser->id);
        }else if($rol_user == \HV_ROLES::PATIENT){
            $data = $data->where('user_id_patient',"=",$authUser->id);
        }

        $data = $data->where('checked', 0)->orderByDesc('created_at')
        ->whereDate('dt_appointment', '>', Carbon::today())
        ->distinct()
        ->groupBy('dt_appointment')
        ->with(array('userPatient' => function($query) {
            $query->select('id','name','lastname','dni','role_id', DB::Raw("CONCAT(name, ' ', lastname) AS patientFullName"));
        }))
        ->with(array('userDoctor' => function($query) {
            $query->select('id','name','lastname','dni','role_id', DB::Raw("CONCAT(name, ' ', lastname) AS doctorFullName"));
        }))
        ->get()->toArray();

        // dd($data);
        return view('appointments.summary', compact('data'));
    }

    public function sendMailNewAppointment($appointment, $userAuthRole=null){

        $patientEmail = $appointment->userPatient->email;
        $doctortEmail = $appointment->userDoctor->email;
        $appointmentUserCreatorId = $appointment->user_id_creator;
        $appointmentUserCreator = User::find($appointmentUserCreatorId);
        $appointmentUserCreatorRole = $appointmentUserCreator->role_id;

        // $patientEmail = "pedroramonmm@gmail.com";  
        // $doctortEmail = "pedroramonmm@gmail.com";  

        $appointment = $appointment->toArray();

        if ($appointment['user_patient']['id']){
            $res = \Mail::to($patientEmail)->send(new CreateAppointmentMail($appointment['id'], $appointment['dt_appointment'],
             $appointment['user_patient'], $appointment['user_doctor'], $userAuthRole, (int)$appointmentUserCreatorRole, true));
        }
        if ($appointment['user_doctor']['id']){
            $res = \Mail::to($doctortEmail)->send(new CreateAppointmentMail($appointment['id'], $appointment['dt_appointment'],
             $appointment['user_patient'], $appointment['user_doctor'], $userAuthRole, (int)$appointmentUserCreatorRole, false));
        }
    }

    public function confirmChecked($id, $checked=null){
        $appointment = Appointment::find($id);
        $checkedText = ($checked == 1)? \Lang::get('messages.accept_stat') : (($checked == 2) ? (\Lang::get('messages.reject_stat')) : (""));
        if (!$checkedText){
            return $this->backWithErrors(\Lang::get('messages.permission_denied'));
        }
        return view('appointments.confirm-checked', compact('appointment','checked','checkedText'));
    }

    public function confirmAccomplished($id, $accomplished=null){
        $appointment = Appointment::find($id);
        $accomplishedText = ($accomplished == 1)? \Lang::get('messages.appointment_completed'): (($accomplished == 2) ? (\Lang::get('messages.appointment_not_completed')) : (""));
        if (!$accomplishedText){
            return $this->backWithErrors(\Lang::get('messages.permission_denied'));
        }
        return view('appointments.confirm-accomplished', compact('appointment','accomplished','accomplishedText'));
    }

    public function confirmDelete($id){
        $appointment = Appointment::find($id);
        return view('appointments.confirm-delete', compact('appointment'));
    }

    public function setChecked($id, $checked=null, $mailable = false, Request $request) {

        if (($checked != 1) &&($checked != 2)){
            if ($mailable){
                return view('appointments.index');
            }
            return $this->jsonResponse(1, \Lang::get('messages.there_was_an_error_on_the_checked_requirements'));

            return $this->backWithErrors(\Lang::get('messages.permission_denied') );
        }

        $appointment = Appointment::find($id);

        $roleCreator = User::select('role_id')->whereId($appointment->user_id_creator)->value('role_id');
        $loggedRole = auth()->user()->role_id;
        // if (($checked == 1) && ($loggedRole == \HV_ROLES::PATIENT)){
        //     return $this->jsonResponse(1, \Lang::get('messages.a_patient_cannot_accept_an_appointment'));
        // }

        // if (($roleCreator == \HV_ROLES::PATIENT) && ($loggedRole == \HV_ROLES::PATIENT)){
        //     return $this->jsonResponse(1, \Lang::get('messages.you_cannot_accept_nor_reject_the_appointment'));
        // }
        // if (($roleCreator == \HV_ROLES::DOCTOR) && ($loggedRole == \HV_ROLES::DOCTOR)){
        //     return $this->jsonResponse(1, \Lang::get('messages.a_doctor_created_the_appointment'));
        // }
        if ($request->apComments){
            if ($loggedRole == \HV_ROLES::PATIENT){
                $appointment->update(['checked' =>$checked, 'user_comment' =>$request->apComments]);
            }
            else{
                $appointment->update(['checked' =>$checked, 'comments' =>$request->apComments]);
            }
        }
        else{
            $appointment->update(['checked' =>$checked]);
        }

        $messageAcRj = ($checked == 1)? \Lang::get('messages.accepted_stat') : (($checked == 2) ? (\Lang::get('messages.rejected_stat')) : (""));
        
        if ($mailable){
            return view('appointments.index');
        }

        return $this->jsonResponse(0,  \Lang::get('messages.the_appointment_with_the_date').$appointment->dt_appointment." ".\Lang::get('messages.has_been')." ".$messageAcRj." ".\Lang::get('messages.succesfully_stat'));
    }

    public function setAccomplished($id, $accomplished=null) {
        if (($accomplished != 1) &&($accomplished != 2)){
            return $this->jsonResponse(1, \Lang::get('messages.there_was_an_error_on_the_checked_requirements'));

            return $this->backWithErrors(\Lang::get('messages.permission_denied') );
        }

        $appointment = Appointment::find($id);
        $appointment->update(['accomplished' =>$accomplished]);
        $messageAcRj = ($accomplished == 1)? \Lang::get('messages.accepted_stat') : (($accomplished == 2) ? (\Lang::get('messages.rejected_stat')) : (""));
            

        return $this->jsonResponse(0,  \Lang::get('messages.the_appointment_with_the_date').$appointment->dt_appointment." ".\Lang::get('messages.has_been')." ".$messageAcRj." ".\Lang::get('messages.succesfully_stat'));
    }

    public function ajaxViewDatatable(Request $request, string $appointmentType=null) {

        if(!$request->wantsJson()) {
            abort(404, \Lang::get('messages.bad_request'));
        }

        self::checkDataTablesRules();
        $searchPhrase = $request->search['value'];
        // Abort query execution if search string is too short
        if(!empty($searchPhrase)) {
            // Minimum two digits or 3 letters to allow a search
            if(preg_match("/^.{1,2}\$/i", $searchPhrase)) {
            // if(preg_match("/^.{1}\$/i", $searchPhrase)) {
                return response()->json(['data' => []]);
            }
        }
        $userLogin = auth()->user();
        $rol_user = $userLogin->role_id;

        $data = Appointment::select('appointments.*')->distinct();
        if (($appointmentType == "all") || ($appointmentType == "pending") || ($appointmentType == "accepted") || ($appointmentType == "rejected")) {
            $data = $data->whereDate('dt_appointment', '>', Carbon::today());
        }else if ($appointmentType == "old"){
            $data = $data->whereDate('dt_appointment', '<', Carbon::today());
        }
        
        if($rol_user == \HV_ROLES::DOCTOR){
            $data = $data->where('user_id_doctor',"=",$userLogin->id);
        }else if($rol_user == \HV_ROLES::PATIENT){
            $data = $data->where('user_id_patient',"=",$userLogin->id);
        }

        if ((!$appointmentType) || ($appointmentType == "all") || ($appointmentType == "old")) {
            // Mostrar todas
        } elseif ($appointmentType == "pending") {
            $data = $data->where('checked',"=",0);
        } elseif ($appointmentType == "accepted") {
            $data = $data->where('checked',"=",1);
        } elseif ($appointmentType == "rejected") {
            $data = $data->where('checked',"=",2);
        } else {
            // Error
        }

        $data = $data->groupBy('dt_appointment')
        ->with(array('userPatient' => function($query) {
            $query->select('id','name','lastname','dni','role_id', DB::Raw("CONCAT(name, ' ', lastname) AS patientFullName"));
        }))
        ->with(array('userDoctor' => function($query) {
            $query->select('id','name','lastname','dni','role_id', DB::Raw("CONCAT(name, ' ', lastname) AS doctorFullName"));
        }));


        // $data = Patient::select('users.*','patients.*','roles.name AS role_name', 'patients.id AS patients_id', 'users.id AS users_id')->join('users', 'patients.user_id', 'users.id')->join('roles', 'users.role_id', 'roles.id')->where("users.deleted_at",null);
        
        // $numTotal = $numRecords = $data->get()->count();

        /**
         * Applying search filters over query result as it is was simple query
         */
        // if(!empty($request->search['value'])) {

        //     // Search by numbers only
        //     if(preg_match("/\d{3,}/", $searchPhrase, $matches)) {

        //         $data->where(function($query) use ($searchPhrase) {
        //             $query->orWhere('dt_appointment', 'like', '%' . $searchPhrase . '%')
        //                 ->orWhere('patientFullName', 'like', '%' . $searchPhrase . '%')
        //                 ->orWhere('doctorFullName', 'like', '%' . $searchPhrase . '%');
        //                 // ->orWhere('checkedStatus', 'like', '%' . $searchPhrase . '%');
        //         });
        //         $numRecords = $data->count();
        //     }
            
        // }
        // $firstRow = $data->first();
        
        // if(is_null($firstRow)) {
        //     return response()->json(['data' => []]);
        // }
        // $collectionKeys = array_keys($firstRow->toArray());
        /**
         * Applying order methods
         */
        // $orderList = $request->order;
        // foreach($orderList as $orderSetting) {
        //     $indexCol = $orderSetting['column'];
        //     $dir = $orderSetting['dir'];

        //     if(isset($request->columns[$indexCol]['data'])) {
        //         $colName = $request->columns[$indexCol]['data'];
        //         if(in_array($colName, $collectionKeys))
        //             $data->orderBy($colName, $dir);
        //         //dd("order by col " . $colName);
        //     }
        // }
        //DB::enableQueryLog();

        // if($request->length > 0)
            // $data = $data->offset($request->start)->limit($request->length);
        $data = $data->get();
        //dd(DB::getQueryLog());
        if($data->isEmpty()) {
            return response()->json(['data'=>[]]);
        }

        /*
         * Apply data processing
         */
        foreach($data as $row) {
           $row->patientFullName = $row->userPatient->name . " " . $row->userPatient->lastname;
           $row->doctorFullName = $row->userDoctor->name . " " . $row->userDoctor->lastname;
           $row->checkedStatus = Appointment::getChecked($row->checked);
           $row->accomplishedStatus = Appointment::getAccomplished($row->accomplished);
        }

        /*
         * Apply search string to collection results
         */
         if(!empty($request->search['value'])) {
             $searchPhrase = $request->search['value'];
             $data = $data->filter(function($appointment, $key) use ($searchPhrase) {
                $ap = $appointment->toArray();
                 foreach($ap as $keys=>$value) {
                     if (is_string($value) || is_numeric($value)){
                        if (strpos(strtolower($value), strtolower($searchPhrase)) !== false) {
                            return $value;
                        }
                     }
                 }
             });
             $data->all();
         }
         $numRecords = $data->count();

        /*
         * Apply order settings
         */
         $orderIndexes = array();
         foreach($request->order as $order) {
             $orderIndexes[] = [
                 (int)$order['column'],
                 $order['dir']
             ];
         }
         foreach($orderIndexes as $order) {
             $columnName = $request->columns[$order[0]]['data'];
             if($order[1] == 'asc')
                 $sorted = $data->sortBy($columnName);
             else
                 $sorted = $data->sortByDesc($columnName);
             $data = $sorted->values();
         }

        $numTotal = $data->count();
        $page = $request->start / $request->length + 1;
        $data = $data->forPage($page, $request->length);

        $dataResult = array_values($data->toArray());
        if(request()->wantsJson()) {
            return self::responseDataTables($dataResult, (int)$request->draw, $numTotal, $numRecords);
        }
    }

}
