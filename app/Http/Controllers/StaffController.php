<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use App\Repositories\StaffRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Staff;
use App\Models\Role;
use App\Models\Branch;
use Carbon\Carbon;
use Flash;
use Response;

class StaffController extends AppBaseController
{
    /** @var  StaffRepository */
    private $staffRepository;

    public function __construct(StaffRepository $staffRepo)
    {
        $this->staffRepository = $staffRepo;
    }

    /**
     * Display a listing of the Staff.
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
     * Show the form for creating a new Staff.
     *
     * @return Response
     */
    public function create()
    {
        return view('staff.create');
    }

    /**
     * Store a newly created Staff in storage.
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
     * Display the specified Staff.
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
     * Show the form for editing the specified Staff.
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
            return $this->backWithErrors(\Lang::get('messages.User not found'));
        }
        $rol_usuario_info = "";
        // dd($usuario->toArray());
        if(($usuario->role_id == \HV_ROLES::DOCTOR) || $usuario->role_id == \HV_ROLES::HELPER){
            $rol_usuario_info = Staff::whereUserId($id)->first();
        }
        else{
            return $this->backWithErrors(\Lang::get('messages.Permission_Denied'));
        }
        if(!$rol_usuario_info) {
            return $this->backWithErrors(\Lang::get('messages.Invalid id'));
        }
        $roles = Role::all();
        $branches = Branch::all();
        return view('staff.edit', compact('usuario', 'rol_usuario_info', 'roles', 'branches'));//->with('usuario',$usuario)->with('rol_usuario_info',$rol_usuario_info)->with('roles',$roles)->with('branches',$branches);
    }

    /**
     * Update the specified Staff in storage.
     *
     * @param int $id
     * @param UpdateStaffRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStaffRequest $request)
    {
        $staff = $this->staffRepository->find($id);

        if (empty($staff)) {
            Flash::error('Staff not found');

            return redirect(route('staff.index'));
        }

        $staff = $this->staffRepository->update($request->all(), $id);

        Flash::success('Staff updated successfully.');

        return redirect(route('staff.index'));
    }

    /**
     * Remove the specified Staff from storage.
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
            return $this->jsonResponse(1, \Lang::get('messages.User not found')); 
        }

        $patientOrStaffFound = User::leftJoin('patients', 'users.id', 'patients.user_id')
        ->leftJoin('staff', 'users.id', 'staff.user_id')
        ->select('users.id as user_id', 'patients.id as patient_id', 'patients.user_id as patient_user_id',
         'staff.id as staff_id', 'staff.user_id as staff_user_id')
        ->where('users.id', $id)->get()->toArray();

        $userToDelete->delete($id);
        
        if($patientOrStaffFound[0]['staff_id']){
            Staff::find($patientOrStaffFound[0]['staff_id'])->delete();
        }
        else{
            return $this->jsonResponse(1, \Lang::get('messages.The user is not staff')); 
        }

        return $this->jsonResponse(0, \Lang::get('messages.user')." ".$userName." ".\Lang::get('messages.deleted successfully'));
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

        $data = Staff::select('users.*','staff.*','roles.name AS role_name', 'branches.name AS branch_name', 'staff.id AS staff_id', 'users.id AS users_id')->join('users', 'staff.user_id', 'users.id')->join('branches', 'staff.branch_id', 'branches.id')->join('roles', 'users.role_id', 'roles.id')->where("users.deleted_at",null);

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
            // Search by name, surname, role, dni, sex, branch_name, shift, office or room
            // elseif(preg_match("/\w{3,}\$/i", $searchPhrase)) {
            elseif(preg_match("/[0-9a-zA-ZÀ-ÿ\u00f1\u00d1]{3,}\$/i", $searchPhrase)) {
               
                $data->where(function($query) use ($searchPhrase) {
                    $query->orWhere('users.name', 'like', '%' . $searchPhrase . '%')
                        ->orWhere('users.lastname', 'like', '%' . $searchPhrase . '%')
                        ->orWhere('roles.name', 'like', '%' . $searchPhrase . '%')
                        ->orWhere('dni', 'like', '%' . $searchPhrase . '%')
                        ->orWhere('sex', 'like', '%' . $searchPhrase . '%')      
                        ->orWhere('branches.name', 'like', '%' . $searchPhrase . '%')
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
