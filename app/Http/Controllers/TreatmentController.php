<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTreatmentRequest;
use App\Http\Requests\UpdateTreatmentRequest;
use App\Repositories\TreatmentRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Flash;
use Response;
use App\Models\User;
use App\Models\Treatment;
use App\Models\Patient;
use App\Models\MedicineAdministration;
use App\Models\Staff;
use App\Models\Role;
use App\Models\Branch;
use Carbon\Carbon;
use Active;
use App\Models\TypeMedicine;
use DB;

class TreatmentController extends AppBaseController
{
    /** @var  TreatmentRepository */
    private $treatmentRepository;

    public function __construct(TreatmentRepository $treatmentRepo)
    {
        $this->treatmentRepository = $treatmentRepo;
    }


    /**
     * Display a listing of Treatments on a Single Patient
     *
     * @param int $id
     *
     * @return Response
     */
    public function indexSinglePatient($id=null, Request $request)
    {
        $user = Auth::user();
        if ($id){
            $userParam = User::find($id);
            if($userParam->role_id != \HV_ROLES::PATIENT){
                return $this->backWithErrors(\Lang::get('messages.the_user_is_not_a_patient') );
            }
        }

        $singlePatient = User::select('id','name','lastname')->where('id',$id)->get();
        // ->find($id)->name . " " . User::find($id)->lastname;

        return view('treatments/index-treatments-single-patient', ['singlePatient' => $singlePatient[0],'user' => $user]);
    }


    /**
     * Display a listing of the Treatment.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $patients = Patient::join('users', 'patients.user_id', 'users.id')->get();

        return view('treatments/index', ['patients' => $patients,'user' => $user]);
    }

    /**
     * Show the form for creating a new Treatment.
     *
     * @return Response
     */
    public function create($id)
    {

        $userLogged = auth()->user();

        $selectedUser = User::select('id','dni','name','lastname','role_id')->where('id',$id)->get()->toArray();
        if (empty($selectedUser)) {
            $selectedUser = null;
        }
        else{
            $selectedUser = $selectedUser[0];
        }


        $doctors = User::select('id','dni','name','lastname','role_id')->where('role_id',2)->get();

        $typeMedicines = TypeMedicine::select('id','name')->get();

        $medicinesAdministration = MedicineAdministration::select('id','name')->get();
        // dd($selectedUser);
        // dd($treatment->toArray());
        $today = Carbon::now();
        return view('treatments.create', compact('selectedUser','doctors','typeMedicines','medicinesAdministration','today'));
    }

    /**
     * Store a newly created Treatment in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        // dd($id);
        // dd($request->all());
        $input = $request->all();
        $validatedData = parent::checkValidation([
            'doctor_id' => 'required',
            'type_medicines_id' => 'required',
            'medicines_administration_id' => 'required',
            'userId' => 'required',
            'treatment_start_date' => 'date|after:today',
            'treatment_end_date' => 'date|after:treatment_start_date'
        ]);
        // dd($input);
        $doctor_id = $request->input('doctor_id');
        $type_medicines_id = $request->input('type_medicines_id');
        $medicines_administration_id = $request->input('medicines_administration_id');
        $userId = $request->input('userId');
        if ($request->input('description'))
            $description = $request->input('description');
        if ($request->input('treatment_start_date'))
            $treatment_start_date = $request->input('treatment_start_date');
        if ($request->input('treatment_end_date'))
            $treatment_end_date = $request->input('treatment_end_date');

        $treatment = new Treatment();
        if ($userId)
            $treatment->user_id_patient = $userId;
        if ($doctor_id)
            $treatment->user_id_doctor = $doctor_id;
        if ($type_medicines_id)
            $treatment->type_medicine_id = $type_medicines_id;
        if ($medicines_administration_id)
            $treatment->medicine_administration_id = $medicines_administration_id;
        if (isset ($description))
            $treatment->description = $description;
        if (isset ($treatment_start_date))
            $treatment->treatment_starting_date = $treatment_start_date;
        if (isset ($treatment_end_date))
            $treatment->treatment_end_date = $treatment_end_date;
        $treatment->save();
       
        $message = \Lang::get('messages.a_new_treatment_was_created');

        return $this->jsonResponse(0, $message);
    }

    /**
     * Display the specified Treatment.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $treatment = $this->TreatmentRepository->find($id);

        if (empty($treatment)) {
            Flash::error(\Lang::get('messages.treatment_not_found'));

            return redirect(route('treatments.index'));
        }

        return view('treatments.show')->with('treatment', $treatment);
    }

    /**
     * Show the form for editing the specified Treatment.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id, Request $request)
    {
        // $userId = $request->id;
        $userLogged = auth()->user();

        $treatment = Treatment::query()
        ->with(array('userDoctor' => function($query) {
            $query->select('id','dni','name','lastname');
        }))
        ->with(array('userPatient' => function($query) {
            $query->select('id','dni','name','lastname');
        }))
        ->with("typeMedicine")
        ->with("medicineAdministration")
        ->where("id",$id)->get();

        if (empty($treatment)) {
            return $this->backWithErrors(\Lang::get('messages.treatment_not_found'));
        }

        if (!$treatment->isEmpty()){
            foreach($treatment as $t){
                if (!is_null($t->treatment_end_date)){
                    $t->treatment_end_date = Carbon::parse($t->treatment_end_date)->format('Y-m-dTH:m');
                    // T19:30
                    // dd($t->treatment_end_date);
                }
            }
            $treatment = $treatment[0];
        }

        $doctors = User::select('id','dni','name','lastname','role_id')->where('role_id',2)->get();
        $typeMedicines = TypeMedicine::select('id','name')->get();

        $medicinesAdministration = MedicineAdministration::select('id','name')->get();
        // dd($doctors->toArray());
        // dd($treatment->toArray());
        $today = Carbon::now();

        $selectedUser = User::select('id','dni','name','lastname','role_id')->where('id',$id)->get()->toArray();
        if (empty($selectedUser)) {
            $selectedUser = null;
        }
        else{
            $selectedUser = $selectedUser[0];
        }
        // $returnHTML = view('treatments.edit-single-treatment-from-patient', compact('treatment','doctors','typeMedicines','medicinesAdministration','today','userId'))->render();
        // $message="";
        
        // return $this->jsonResponse(0, $message, $returnHTML);
        return view('treatments.edit-single-treatment-from-patient', compact('treatment','doctors','typeMedicines','medicinesAdministration','today'));

    }

    /**
     * Update the specified Treatment in storage.
     *
     * @param int $id
     * @param UpdateTreatmentRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $treatment = $this->treatmentsRepository->find($id);

        if (empty($treatment)) {
            Flash::error(\Lang::get('messages.treatment_not_found'));

            return redirect(route('treatments.index'));
        }

        $treatment = $this->treatmentsRepository->update($request->all(), $id);

        Flash::success('Treatment updated successfully.');

        $message = \Lang::get('messages.treatment_updated_successfully');

        return redirect(route('treatments.index'));
    }

    /**
     * Remove the specified Treatment from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        if ($request->ajax()){
            $res=Treatment::where('id',$id)->delete();

            $message = \Lang::get('messages.the_treatment_was_deleted_sucessfully');
           
            return $this->jsonResponse(0, $message);
        }
    }


    public function deleteAll($userId, Request $request){
        if ($request->ajax()){

            $singleUser = User::find($userId);
            $userName = $singleUser->name ." ".$singleUser->lastname;

            $res=Treatment::where('user_id_patient',$userId)->delete();

            $message = \Lang::get('messages.all_treatments_of_the_user')." ".$userName." ".\Lang::get('messages.were_deleted_sucessfully');
           
            return $this->jsonResponse(0, $message);
        }
    }

    public function viewDescription($id){
        $treatment = Treatment::find($id);
        $hasDescription = false;
        $description = \Lang::get('messages.the_treatment_has_no_description');
        if ($treatment){
            if (($treatment->description) && ($treatment->description != "0")){
                $description= $treatment->description;
                $hasDescription = true;
            }
        }

        return view('treatments.view-description', compact('treatment','description','hasDescription'));
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
                    ->orWhere('dni', 'like', '%' . $searchPhrase . '%');
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
                    $query->orWhere('users.blood', 'like', '%' . $searchPhrase . '%');            
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


    /**
     * View to render the full devices section and to return the DataTables pagination server side data based on request variables
     *
     * @author Pedro
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxViewDatatableSP($id, Request $request) {

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
        
        $data = Treatment::query()
        ->with(array('userDoctor' => function($query) {
            $query->select('id','dni','name','lastname');
        }))
        ->with(array('userPatient' => function($query) {
            $query->select('id','dni','name','lastname');
        }))
        ->with("typeMedicine")
        ->with("medicineAdministration")
        ->where("user_id_patient",$id);

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
            // dd($row->toArray()); 
            if ($row->treatment_starting_date){
                $row->startingDate = $this->mysqlDate2Spanish($row->treatment_starting_date);
            }
            else{
                if ($row->treatment_end_date){
                    $row->startingDate = $this->mysqlDate2Spanish($row->treatment_end_date->addDays(-7));
                }
                else{
                    $row->startingDate = $this->mysqlDate2Spanish(now());
                }
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
            if ($row->userDoctor){
                $row->doctorFullName = $row->userDoctor->name . " " . $row->userDoctor->lastname;
            }
            else{
                $row->doctorFullName = null;
            }
            $row->nameTypeMedicine = $row->typeMedicine->name;
            $row->medicineAdministration = ($row->medicineAdministration)?$row->medicineAdministration->name:\Lang::get('messages.generic_treatment');
            
        }
        // dd($data->toArray());
        if(request()->wantsJson()) {
            return self::responseDataTables($data->toArray(), (int)$request->draw, $numTotal, $numRecords);
        }
    }

}
