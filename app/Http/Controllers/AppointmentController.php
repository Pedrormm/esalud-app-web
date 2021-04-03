<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Appointment;
use App\Models\User;
use App\Models\Patient;
use App\Models\Staff;
use Mail;
use App\Mail\CreateAppointmentMail;



class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario_login = auth()->user();
        $rol_user = $usuario_login->role_id;

        if($rol_user == 4){
            $appointments = Appointment::with('userPatient')->with('userDoctor')->get();
        }else if($rol_user == 2){
            $appointments = Appointment::where('user_id_doctor',"=",$usuario_login->id)->with('userPatient')->with('userDoctor')->get();
        }else if($rol_user == 1){
            $appointments = Appointment::where('user_id_patient',"=",$usuario_login->id)->with('userPatient')->with('userDoctor')->get();
        }


        // dd($appointments->toArray());

        return view('appointments.index')->with('appointments',$appointments->toArray());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuario_login = auth()->user();
        // $rol_user = $usuario_login->role_id();
        $patients = DB::select('SELECT * FROM users WHERE role_id = 1');
        $doctors = DB::select('SELECT * FROM users WHERE role_id = 2');
        return view('appointments.create')->with('user',$usuario_login)
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
        $user_id_patient = $request->input('user_id_patient');
        $user_id_doctor = $request->input('user_id_doctor');
        $dt_appointment = $request->input('dt_appointment');

        $userPatient = User::find($user_id_patient);
        $userPatient = $userPatient->name . " " . $userPatient->lastname;
        $userDoctor = User::find($user_id_doctor);
        $userDoctor = $userDoctor->name . " " . $userDoctor->lastname;
        $spanishDate = $this->mysqlDateTime2Spanish($dt_appointment);

        if (Appointment::where('dt_appointment', $dt_appointment)->where('user_id_patient', $user_id_patient)
        ->where('user_id_doctor', $user_id_doctor)->exists()) {
            return $this->backWithErrors("Ya existe una cita médica igual" );
        }
        $appointment = new Appointment();
        $appointment->user_id_patient = $user_id_patient;
        $appointment->user_id_doctor = $user_id_doctor;
        $appointment->dt_appointment = $dt_appointment;
        $appointment->user_id_creator = auth()->user()->id;
        $appointment->checked = 0;
        $appointment->accomplished = 2;
        $appointment->save();

        // Crear email con fichero calendar adjunto.

        $appointments = Appointment::with(["userPatient","userCreator","userDoctor"])->find($appointment->id);

        $this->sendMailNewAppointment($appointments);

        // return $this->index();
        // return back()->with('okMessage', "Una invitación de cita médica entre el paciente ".$userPatient." y el médico ".$userDoctor." con fecha de ".$spanishDate." ha sido creada correctamente");
        return $this->create()->with('okMessage', "Una invitación de cita médica entre el paciente ".$userPatient." y el médico ".$userDoctor." con fecha de ".$spanishDate." ha sido creada correctamente");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $appointment = Appointment::find($id);
        $usuario_login = auth()->user();
        $rol_user = $usuario_login->role_id();
        $patients = DB::select('SELECT * FROM users WHERE role_id = 1');
        $doctors = DB::select('SELECT * FROM users WHERE role_id = 2');
        $patient = User::find($appointment->user_id_patient);

        $fecha = date("Y-m-d", strtotime('now +24 hour'))."T";
        $hora = date("H:i");
        $fechaHora = $fecha.$hora;

        $fecha_appointment = date("Y-m-d",strtotime($appointment->dt_appointment))."T";
        $hora_appointment = date("H:i",strtotime($appointment->dt_appointment));
        $fechaHoraAppointment = $fecha_appointment.$hora_appointment;

        return view('appointments.edit')->with('user',$usuario_login)
                                        ->with('role',$rol_user)
                                        ->with('patient',$patient)
                                        ->with('doctors',$doctors)
                                        ->with('appointment',$appointment)
                                        ->with('fechaHora',$fechaHora)
                                        ->with('fechaHoraAppointment',$fechaHoraAppointment);

                                    
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
        //
        $appointment = Appointment::find($id);      

        $user_id_doctor = $request->input('user_id_doctor');
        $dt_appointment = $request->input('dt_appointment');
        $accomplished = $request->input('accomplished');
        $comments = $request->input('comments');
       
        $appointment->user_id_doctor = $user_id_doctor;
        $appointment->dt_appointment = $dt_appointment;
        $appointment->user_id_creator = auth()->user()->id;
        $appointment->checked = 0;
        $appointment->accomplished = $accomplished;
        $appointment->comments = $comments;
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
        //
    }

    public function calendar(){

        $usuario_login = auth()->user();
        $rol_user = $usuario_login->role_id;

        if($rol_user == 4){
            $appointments = Appointment::with('userPatient')->with('userDoctor')->get();
        }else if($rol_user == 2){
            $appointments = Appointment::where('user_id_doctor',"=",$usuario_login->id)->with('userPatient')->with('userDoctor')->get();
        }else if($rol_user == 1){
            $appointments = Appointment::where('user_id_patient',"=",$usuario_login->id)->with('userPatient')->with('userDoctor')->get();
        }
        
        foreach($appointments as $ap) {
            $ap["fullNameCreator"] = User::find($ap->user_id_creator)->name . " " . User::find($ap->user_id_creator)->lastname;
            $ap["fullNamePatient"] = User::find($ap->user_id_patient)->name . " " . User::find($ap->user_id_patient)->lastname;
            $ap["fullNameDoctor"] = User::find($ap->user_id_doctor)->name . " " . User::find($ap->user_id_doctor)->lastname;
        }

        return view('appointments.calendar')->with('appointments',$appointments)->with('rol_user',$rol_user);
    }

    public function showCalendar($id){
        $usuario_login = auth()->user();
        $appointment = Appointment::find($id);
        $especialidad = DB::select('SELECT branches.name FROM appointments INNER JOIN staff ON appointments.user_id_doctor = staff.user_id INNER JOIN branches ON staff.branch_id = branches.id WHERE appointments.user_id_doctor = '.$appointment->user_id_doctor.'');
        
        return view('appointments.showCalendar')->with('appointment',$appointment)->with('especialidad',$especialidad);
    }

    public function listPending()
    {
        $usuarioLogin = auth()->user();
        
        $appointments = Appointment::where('user_id_patient',"=",$usuarioLogin->id)->with('userPatient')->with('userDoctor')->get();

        return view('appointments.listPending')->with('appointments',$appointments->toArray());
    }

    public function listAccepted()
    {
        $usuarioLogin = auth()->user();

        $appointments = Appointment::where('user_id_patient',"=",$usuarioLogin->id)->with('userPatient')->with('userDoctor')->get();
        
        return view('appointments.listAccepted')->with('appointments',$appointments->toArray());
    }

    public function sendMailNewAppointment($appointment){

        $patientEmail = $appointment->userPatient->email;
        $doctortEmail = $appointment->userDoctor->email;

        // $patientEmail = "pedroramonmm@gmail.com";  
        // $doctortEmail = "pedroramonmm@gmail.com";  

        $appointment = $appointment->toArray();
        if ($appointment['user_patient']['id']){
            $res = \Mail::to($patientEmail)->send(new CreateAppointmentMail($appointment['dt_appointment'], $appointment['user_patient'], $appointment['user_doctor'], true));
        }
        if ($appointment['user_doctor']['id']){
            $res = \Mail::to($doctortEmail)->send(new CreateAppointmentMail($appointment['dt_appointment'], $appointment['user_patient'], $appointment['user_doctor'], false));
        }
    }

}
