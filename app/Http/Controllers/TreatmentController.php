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
    public function create()
    {
        return view('treatments.create');
    }

    /**
     * Store a newly created Treatment in storage.
     *
     * @param CreateTreatmentRequest $request
     *
     * @return Response
     */
    public function store(CreateTreatmentRequest $request)
    {
        $input = $request->all();

        $treatment = $this->treatmentRepository->create($input);

        Flash::success('Treatment saved successfully.');

        return redirect(route('treatments.index'));
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
        dd(2);
        $treatment = $this->TreatmentRepository->find($id);

        if (empty($treatment)) {
            Flash::error('Treatment not found');

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
    public function edit($id)
    {
    
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
            return $this->backWithErrors("Treatment not found" );
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
    public function update($id, UpdateTreatmentRequest $request)
    {
        $treatment = $this->treatmentsRepository->find($id);

        if (empty($treatment)) {
            Flash::error('Treatment not found');

            return redirect(route('treatments.index'));
        }

        $treatment = $this->treatmentsRepository->update($request->all(), $id);

        Flash::success('Treatment updated successfully.');

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
    public function destroy($id)
    {
        $treatment = $this->treatmentRepository->find($id);

        if (empty($treatment)) {
            Flash::error('Treatment not found');

            return redirect(route('treatments.index'));
        }

        $this->treatmentRepository->delete($id);

        Flash::success('Treatment deleted successfully.');

        return redirect(route('treatments.index'));
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
            abort(404, 'Bad request');
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


    /**
     * View to render the full devices section and to return the DataTables pagination server side data based on request variables
     *
     * @author Pedro
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxViewDatatableSP($id, Request $request) {

        if(!$request->wantsJson()) {
            abort(404, 'Bad request');
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
            
            $row->doctorFullName = $row->userDoctor->name . " " . $row->userDoctor->lastname;
            $row->nameTypeMedicine = $row->typeMedicine->name;
            $row->medicineAdministration = ($row->medicine_administration)?$row->medicine_administration:"Genérico";
            
        }

        if(request()->wantsJson()) {
            return self::responseDataTables($data->toArray(), (int)$request->draw, $numTotal, $numRecords);
        }
    }

}
