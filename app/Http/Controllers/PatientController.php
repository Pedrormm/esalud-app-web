<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Repositories\PatientRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Patient;
use App\Models\Role;
use Flash;
use Response;
use Carbon\Carbon;

class PatientController extends AppBaseController
{
    /** @var  PatientRepository */
    private $patientRepository;

    public function __construct(PatientRepository $patientRepo)
    {
        $this->patientRepository = $patientRepo;
    }

    /**
     * Display a listing of the Patient.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        // $patients = Patient::all()->toArray();
        $patients = Patient::join('users', 'patients.user_id', 'users.id')->get();

        // return view('user/patient', ['patients' => $patients,'user' => $user]);
        return view('patients/index', ['patients' => $patients,'user' => $user]);

    }

    /**
     * Show the form for creating a new Patient.
     *
     * @return Response
     */
    public function create()
    {
        return view('patients.create');
    }

    /**
     * Store a newly created Patient in storage.
     *
     * @param CreatePatientRequest $request
     *
     * @return Response
     */
    public function store(CreatePatientRequest $request)
    {
        $input = $request->all();

        $patient = $this->patientRepository->create($input);

        Flash::success('Patient saved successfully.');

        return redirect(route('patients.index'));
    }

    /**
     * Display the specified Patient.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $patient = $this->patientRepository->find($id);

        if (empty($patient)) {
            Flash::error(\Lang::get('messages.patient_not_found'));

            return redirect(route('patients.index'));
        }

        return view('patients.show')->with('patient', $patient);
    }

    /**
     * Show the form for editing the specified Patient.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
    
        $userLogged = auth()->user();
        $usuario = User::find($id);
        if (empty($usuario)) {
            // Flash::error(\Lang::get('messages.user_not_found'));
            // return redirect(route('users.index'));
            return $this->backWithErrors(\Lang::get('messages.user_not_found') );
        }
        $rol_usuario_info = "";

        if($usuario->role_id == \HV_ROLES::PATIENT){
            $rol_usuario_info = Patient::whereUserId($id)->first();
        }
        else{
            return $this->backWithErrors(\Lang::get('messages.permission_denied'));
        }
        if(!$rol_usuario_info) {
            return $this->backWithErrors("UsMaCoEd001: "+\Lang::get('messages.invalid_id'));
        }
        $roles = Role::all();
        // dd($usuario->toArray());
        // dd($rol_usuario_info->toArray());

        return view('patients.edit', compact('usuario', 'rol_usuario_info', 'roles'));//->with('usuario',$usuario)->with('rol_usuario_info',$rol_usuario_info)->with('roles',$roles)->with('branches',$branches);

    }

    /**
     * Update the specified Patient in storage.
     *
     * @param int $id
     * @param UpdatePatientRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePatientRequest $request)
    {
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
        ]);
        $token = $request->input('token');
        
        if ($request->input('role_id')==\HV_ROLES::PATIENT){
            $mapValidation = parent::checkValidation([
                'historic' => 'required',
                'height' => 'required|numeric',
                'weight' => 'required|numeric',
            ]);

            $res = Patient::whereUserId($id)->update($mapValidation);
        }

        $user_id = $request->input('user_id');
        $usuario = User::find($user_id);

        $validatedData = array_merge($mapValidation, $validatedData);

        $usuario->update($validatedData);

        return view('patients.index')->with('okMessage', \Lang::get('messages.the_patient').": ".$usuario->name." ".$usuario->lastname." ".\Lang::get('messages.has_been_succesfully_edited'));

    }

    /**
     * Remove the specified Patient from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $userToDelete = User::find($id);
        $userName = $userToDelete->name . " " . $userToDelete->lastname;


        if (empty($userToDelete)) {
            return $this->jsonResponse(1, \Lang::get('messages.user_not_found')); 
        }

        $patientOrStaffFound = User::leftJoin('patients', 'users.id', 'patients.user_id')
        ->leftJoin('staff', 'users.id', 'staff.user_id')
        ->select('users.id as user_id', 'patients.id as patient_id', 'patients.user_id as patient_user_id',
         'staff.id as staff_id', 'staff.user_id as staff_user_id')
        ->where('users.id', $id)->get()->toArray();

        // Si el paciente no tiene relacion con appointments y treatments:
        $hasRelations = User::leftJoin('patients as p', 'users.id', 'p.user_id')
        ->leftJoin('appointments as a', function($join) {
            $join->on('a.user_id_creator', '=', 'users.id')->orOn('a.user_id_patient', '=', 'users.id');
        })
        ->leftJoin('treatments as t', 'users.id', 't.user_id_patient')
        ->select('users.id as user_id', 'a.dt_appointment as dt', 'a.id as appointment_id', 
        'a.deleted_at as a_deleted', 't.id as treatement_id', 't.deleted_at as t_deleted',)
        ->where('users.id', $id)
        ->where(function($q) {
            $q->whereDate('a.dt_appointment', '>', Carbon::today())
                ->orWhereNull('a.dt_appointment');
        })
        ->get();

        // deleted=null: has value. When one is null a relation is found.
        $foundRelation = false;
        foreach($hasRelations as $rel) {
            if ((!is_null($rel->appointment_id) && is_null($rel->a_deleted)) || 
            (!is_null($rel->treatement_id) && is_null($rel->t_deleted))) {
                $foundRelation = true;
                break;
            }
        }
         
        if (!$foundRelation)
            $userToDelete->delete($id);
        else
            return $this->jsonResponse(1, \Lang::get('messages.the_user_cannot_be_deleted_since_it_already_has_treatments_or_appointments'));

        if (!$foundRelation){
            if($patientOrStaffFound[0]['patient_id']){
                Patient::find($patientOrStaffFound[0]['patient_id'])->delete();
            }
            else{
                return $this->jsonResponse(1, \Lang::get('messages.the_user_is_not_a_patient')); 
            }
        }

        return $this->jsonResponse(0, \Lang::get('messages.patient_type')." ".$userName." ".\Lang::get('messages.deleted_successfully'));
    }

    public function confirmDelete($id){
        $singleUser = User::find($id);
        return view('patients.confirm-delete',['singleUser' => $singleUser]);  
    }

     /**
     * View to render the full devices section and to return the DataTables pagination server side data based on request variables
     *
     * @author Pedro
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxViewDatatable(Request $request) {


        if(!$request->wantsJson()) {
            abort(404, \Lang::get('messages.bad_request'));
        }

        self::checkDataTablesRules();
        $searchPhrase = $request->search['value'];
        // Abort query execution if search string is too short
        if(!empty($searchPhrase)) {
            // Minimum two digits or 3 letters to allow a search
            // if(preg_match("/^.{1,2}\$/i", $searchPhrase)) {
            if(preg_match("/^.{1}\$/i", $searchPhrase)) {
                return response()->json(['data' => []]);
            }
        }
        $data = Patient::select('users.*','patients.*','roles.name AS role_name', 'patients.id AS patients_id', 'users.id AS users_id')->join('users', 'patients.user_id', 'users.id')->join('roles', 'users.role_id', 'roles.id')->where("users.deleted_at",null);
        
        $numTotal = $numRecords = $data->count();

        /**
         * Applying search filters over query result as it is was simple query
         */
        if(!empty($request->search['value'])) {

            // Search by numbers only
            if(preg_match("/\d{3,}/", $searchPhrase, $matches)) {

                $data->where(function($query) use ($searchPhrase) {
                    $query->orWhere('birthdate', 'like', '%' . $searchPhrase . '%')
                        ->orWhere('dni', 'like', '%' . $searchPhrase . '%')
                        ->orWhere('phone', 'like', '%' . $searchPhrase . '%')
                        ->orWhere('historic', 'like', '%' . $searchPhrase . '%')
                        ->orWhere('height', 'like', '%' . $searchPhrase . '%')
                        ->orWhere('weight', 'like', '%' . $searchPhrase . '%');
                });
                $numRecords = $data->count();
            }
            // Search by name, surname, role, dni or sex
            // elseif(preg_match("/\w{3,}\$/i", $searchPhrase)) {
            elseif(preg_match("/[0-9a-zA-ZÀ-ÿ\u00f1\u00d1]{3,}\$/i", $searchPhrase)) {
               
                $data->where(function($query) use ($searchPhrase) {
                    $query->orWhere('users.name', 'like', '%' . $searchPhrase . '%')
                        ->orWhere('users.lastname', 'like', '%' . $searchPhrase . '%')
                        ->orWhere('roles.name', 'like', '%' . $searchPhrase . '%')
                        ->orWhere('dni', 'like', '%' . $searchPhrase . '%')
                        ->orWhere('sex', 'like', '%' . $searchPhrase . '%');             
                });
                        
                $numRecords = $data->count();
            }

            // Search by blood type
            elseif(preg_match("/^(A|B|AB|0)[+-]$/i", $searchPhrase)) {
               
                $data->where(function($query) use ($searchPhrase) {
                    $query->orWhere('u.blood', 'like', '%' . $searchPhrase . '%');            
                });
                        
                $numRecords = $data->count();
            }
            
        }
        // dd($numRecords);

        $firstRow = $data->first();
        
        if(is_null($firstRow)) {
            return response()->json(['data' => []]);
        }
        $collectionKeys = array_keys($firstRow->toArray());
        /**
         * Applying order methods
         */
        $orderList = $request->order;
        foreach($orderList as $orderSetting) {
            $indexCol = $orderSetting['column'];
            $dir = $orderSetting['dir'];

            if(isset($request->columns[$indexCol]['data'])) {
                $colName = $request->columns[$indexCol]['data'];
                if(in_array($colName, $collectionKeys))
                    $data->orderBy($colName, $dir);
                //dd("order by col " . $colName);
            }
        }
        //DB::enableQueryLog();
        if($request->length > 0)
            $data = $data->offset($request->start)->limit($request->length);
        $data = $data->get();
        //dd(DB::getQueryLog());
        if($data->isEmpty()) {
            return response()->json(['data'=>[]]);
        }

        /*
         * Apply data processing
         */
        foreach($data as $row) {
           $originalBD = $row->birthdate;
           $row->fullName = $row->lastname . ", " . $row->name;
           $row->birthdate = self::mysqlDate2Spanish($originalBD);
        }

        if(request()->wantsJson()) {
            return self::responseDataTables($data->toArray(), (int)$request->draw, $numTotal, $numRecords);
        }
    }

}
