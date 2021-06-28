<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use App\Repositories\StaffRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Staff;
use App\Models\Role;
use App\Models\MedicalSpeciality;
use App\Models\Country;
use App\Models\PhonePrefix;
use Carbon\Carbon;
use Flash;
use Response;

class StaffController extends AppBaseController
{
    /** @var  StaffRepository */
    private $staffRepository;

    /**
     * StaffController constructor.
     * @param StaffRepository $staffRepo
     */
    public function __construct(StaffRepository $staffRepo)
    {
        $this->staffRepository = $staffRepo;
    }

    /**
     * Displays a listing of the Staff.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $staff = Staff::join('users', 'staff.user_id', 'users.id')->get();

        return view('staff/index', ['staff' => $staff,'user' => $user]);
    }

    /**
     * Shows the form for creating a new Staff.
     *
     * @return Response
     */
    public function create()
    {
        return view('staff.create');
    }

    /**
     * Stores a newly created Staff in storage.
     *
     * @param CreateStaffRequest $request
     *
     * @return Response
     */
    public function store(CreateStaffRequest $request)
    {
        $input = $request->all();

        $staff = $this->staffRepository->create($input);

        Flash::success('Staff saved successfully.');

        return redirect(route('staff.index'));
    }

    /**
     * Displays the specified Staff.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $staff = $this->staffRepository->find($id);

        if (empty($staff)) {
            Flash::error('Staff not found');

            return redirect(route('staff.index'));
        }

        return view('staff.show')->with('staff', $staff);
    }

    /**
     * Shows the form for editing the specified Staff.
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
            // Flash::error('user not found');
            // return redirect(route('users.index'));
            return $this->backWithErrors(\Lang::get('messages.user_not_found'));
        }
        $usuario->load('countries')->load('phonePrefixes.countries');
        $rol_usuario_info = "";
        // dd($usuario->toArray());
        if(($usuario->role_id == \HV_ROLES::DOCTOR) || $usuario->role_id == \HV_ROLES::HELPER){
            $rol_usuario_info = Staff::whereUserId($id)->first();
        }
        else{
            return $this->backWithErrors(\Lang::get('messages.permission_denied'));
        }
        if(!$rol_usuario_info) {
            return $this->backWithErrors(\Lang::get('messages.invalid_id'));
        }
        $roles = Role::all();
        $medicalSpecialities = MedicalSpeciality::all();
        $countries = Country::all();
        return view('staff.edit', compact('usuario', 'rol_usuario_info', 'roles', 'medicalSpecialities','countries'));
    }

    /**
     * Updates the selected user in the Database
     * Endpoint: users/{id}
     * @author Pedro
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function update(Request $request, int $id){

        if ($request->input('user_id'))
            $user_id = $request->input('user_id');

        $validatedData = parent::checkValidation([
            'role_id' => 'required|exists:App\Models\Role,id',
            'dni' => 'required|min:9|max:9|unique:users,dni,'.$user_id,
            'email' => 'required|string|email:rfc,dns|max:200|unique:users,email,'.$user_id,
            'name' => 'required',
            'lastname' => 'required',
            'zipcode' => 'numeric',
            'phone' => 'required',
            'birthdate' => 'required|date',
            'sex' => 'required',
            'blood' => 'required',
            'country_id' => 'required|exists:App\Models\Country,id',
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
        if (($request->input('role_id')==\HV_ROLES::DOCTOR) || ($request->input('role_id')==\HV_ROLES::HELPER))  {
            $mapValidation = parent::checkValidation([
                'historic' => 'required',
                'medical_speciality_id' => 'required|exists:App\Models\MedicalSpeciality,id',
                'shift' => Rule::in(\SHIFTS::$types),
                'office' => 'required|numeric',
                'room' => 'required|numeric',
                'h_phone' => 'required|numeric',
            ]);
            $res = Staff::whereUserId($id)->update($mapValidation);
        }

        $usuario = User::find($user_id);

        $validatedData = array_merge($mapValidation, $validatedData);
        // dd($validatedData);
        // $usuario->update($validatedData);
        // dd($request->all());
        if ($request->input('dni'))
            $dni = $request->input('dni');

        //Check valid DNI letter
        if(!checkDni($dni)) {
            return $this->backWithErrors(\Lang::get('messages.invalid_DNI_format'));
        }

        if ($request->input('email'))
            $email = $request->input('email');
        if ($request->input('name'))
            $name = $request->input('name');
        if ($request->input('lastname'))
            $lastname = $request->input('lastname');
        if ($request->input('address'))
            $address = $request->input('address');

        if ($request->input('country_id'))
            $country_id = $request->input('country_id');
        if ($request->input('city'))
            $city = $request->input('city');
        if ($request->input('zipcode'))
            $zipcode = $request->input('zipcode');
        if ($request->input('phone'))
            $phone = $request->input('phone');
        if ($request->input('birthdate'))
            $birthdate = $request->input('birthdate');
        if ($request->input('sex'))
            $sex = $request->input('sex');
        if ($request->input('blood'))
            $blood = $request->input('blood');

        if ($request->input('hiddenPhoneCode'))
            $hiddenPhoneCode = $request->input('hiddenPhoneCode');
        if ($request->input('hiddenCountryCodeLong'))
            $hiddenCountryCodeLong = $request->input('hiddenCountryCodeLong');

        if (isset ($email))
            $usuario->email = $email;
        if (isset ($dni))
            $usuario->dni = $dni;
        if (isset ($name))
            $usuario->name = $name;
        if (isset ($lastname))
            $usuario->lastname = $lastname;
        if (isset ($address))
            $usuario->address = $address;

        if (isset ($country_id))
            $usuario->country_id = $country_id;
        if (isset ($city))
            $usuario->city = $city;
        if (isset ($zipcode))
            $usuario->zipcode = $zipcode;
        if (isset ($phone))
            $usuario->phone = $phone;
        if (isset ($birthdate))
            $usuario->birthdate = $birthdate;
        if (isset ($sex))
            $usuario->sex = $sex;
        if (isset ($blood))
            $usuario->blood = $blood;
        if (isset ($hiddenPhoneCode)){
            $code = substr($hiddenPhoneCode, 1);
            // dd($code);
            $phonePrefixId = PhonePrefix::where('prefix',$code)->value('id');
            $usuario->phone_prefix_id = $phonePrefixId;
            // dd($phonePrefixId);
        }

        $usuario->save();

        if (($request->input('role_id')==\HV_ROLES::DOCTOR) || ($request->input('role_id')==\HV_ROLES::HELPER))  {
            $staffId = Staff::where("user_id",$user_id)->value('id');
            $staff = Staff::find($staffId);

            if ($request->input('historic'))
                $staffHistoric = $request->input('historic');
            if ($request->input('medical_speciality_id'))
                $medical_speciality_id = $request->input('medical_speciality_id');
            if ($request->input('office'))
                $office = $request->input('office');
            if ($request->input('room'))
                $room = $request->input('room');
            if ($request->input('h_phone'))
                $h_phone = $request->input('h_phone');

            if (isset ($staffHistoric))
                $staff->historic = $staffHistoric;
            if (isset ($medical_speciality_id))
                $staff->medical_speciality_id = $medical_speciality_id;
            if (isset ($office))
                $staff->office = $office;
            if (isset ($room))
                $staff->room = $room;
            if (isset ($h_phone))
                $staff->h_phone = $h_phone;

            $staff->save();
        }

        return view('staff.index')->with('okMessage', \Lang::get('messages.the_user').$usuario->name." ".$usuario->lastname." ".\Lang::get('messages.has_been_succesfully_edited'));
    }

    /**
     * Removes the specified Staff from storage.
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

        $hasRelations = User::leftJoin('staff as s', 'users.id', 's.user_id')
        ->leftJoin('appointments as a', function($join) {
            $join->on('a.user_id_creator', '=', 'users.id')->orOn('a.user_id_doctor', '=', 'users.id');
        })
        ->leftJoin('treatments as t', 'users.id', 't.user_id_doctor')
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

        if(!$foundRelation){
            if($patientOrStaffFound[0]['staff_id']){
                Staff::find($patientOrStaffFound[0]['staff_id'])->delete();
            }
            else{
                return $this->jsonResponse(1, \Lang::get('messages.the_user_is_not_staff'));
            }
        }

        return $this->jsonResponse(0, \Lang::get('messages.user_type')." ".$userName." ".\Lang::get('messages.deleted_successfully'));
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

        $data = Staff::select('users.*','staff.*','roles.name AS role_name', 'medical_specialities.name AS medical_speciality_name', 'staff.id AS staff_id', 'users.id AS users_id')->join('users', 'staff.user_id', 'users.id')->join('medical_specialities', 'staff.medical_speciality_id', 'medical_specialities.id')->join('roles', 'users.role_id', 'roles.id')->where("users.deleted_at",null);

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
                        ->orWhere('h_phone', 'like', '%' . $searchPhrase . '%');
                });
                $numRecords = $data->count();
            }
            // Search by name, surname, role, dni, sex, medical_speciality_name, office or room
            // elseif(preg_match("/\w{3,}\$/i", $searchPhrase)) {
            elseif(preg_match("/[0-9a-zA-ZÀ-ÿ\u00f1\u00d1]{3,}\$/i", $searchPhrase)) {

                $data->where(function($query) use ($searchPhrase) {
                    $query->orWhere('users.name', 'like', '%' . $searchPhrase . '%')
                        ->orWhere('users.lastname', 'like', '%' . $searchPhrase . '%')
                        ->orWhere('roles.name', 'like', '%' . $searchPhrase . '%')
                        ->orWhere('dni', 'like', '%' . $searchPhrase . '%')
                        ->orWhere('sex', 'like', '%' . $searchPhrase . '%')
                        ->orWhere('medical_specialities.name', 'like', '%' . $searchPhrase . '%')
                        ->orWhere('shift', 'like', '%' . $searchPhrase . '%')
                        ->orWhere('office', 'like', '%' . $searchPhrase . '%')
                        ->orWhere('room', 'like', '%' . $searchPhrase . '%');
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
