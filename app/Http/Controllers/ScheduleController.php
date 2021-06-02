<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StaffSchedule;
use App\Models\User;
use App\Models\Staff;
use Illuminate\Support\Facades\Auth;


class ScheduleController extends Controller
{


    public function getStaff(Request $request)
    {
        $user = Auth::user();
        $staff = Staff::join('users', 'staff.user_id', 'users.id')->get();

        return view('schedule/all-staff', ['staff' => $staff,'user' => $user]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('schedule.index');
    }

    public function destroy($id)
    {
        $userScheduleToDelete = User::find($id);
        $userName = $userScheduleToDelete->name . " " . $userScheduleToDelete->lastname;
        

        if (empty($userScheduleToDelete)) {
            return $this->jsonResponse(1, "user_not_found"); 
        }

        $staffFound = User::leftJoin('staff', 'users.id', 'staff.user_id')
        ->select('users.id as user_id',
         'staff.id as staff_id', 'staff.user_id as staff_user_id')
        ->where('users.id', $id)->get()->toArray();
        
        $strResponse = "";
        if($staffFound[0]['staff_id']){
            $staffSchedule = StaffSchedule::with("staff")
            ->where('staff_id',$staffFound[0]['staff_id'])
            ->delete();
            $strResponse = "".$userName." ".\Lang::get('messages.schedule_has_been_deleted_successfully');
        }
        else{
            return $this->jsonResponse(1, \Lang::get('messages.the_user_is_not_staff')); 
        }

        return $this->jsonResponse(0, $strResponse);
    }


    public function showSchedule(int $id ){
            $userLogged = Auth::user();
            $userStaff = User::with("staff")->where("id",$id)->get();
            if (($userStaff[0]->staff)->isEmpty()){
                return $this->backWithErrors(\Lang::get('messages.permission_denied'));
            }
            else{
                $id = $userStaff[0]->staff[0]->id;
                $staffSchedule = StaffSchedule::with("staff")
                ->where('staff_id',$id)
                ->get();
                $userStaff = $userStaff[0];
                $staffSchedule = $staffSchedule->toArray();
                return view('schedule.show', compact('staffSchedule','userStaff'));
            }
        
    }

    public function generateSchedule(Request $request ){
        if ($request->ajax()){
            $userLogged = Auth::user();
            $userStaff = User::with("staff")->where("id",$userLogged->id)->get();
            // $userStaff = $userStaff->toArray();
            // dd($userStaff);
            if (($userStaff[0]->staff)->isEmpty()){
                return response()->json(false);
            }
            else{
                $id = $userStaff[0]->staff[0]->id;
                $staffSchedule = StaffSchedule::with("staff")
                ->where('staff_id',$id)
                ->get();

                // dd($staffSchedule->toArray());

                return response()->json($staffSchedule);
            }
        }
    }

    public function saveSchedule(Request $request, int $id =null ){
        if ($request->ajax()){
            if ($id){
                $userStaff = User::with("staff")->where("id",$id)->get();
            }
            else{
                $userLogged = Auth::user();
                $userStaff = User::with("staff")->where("id",$userLogged->id)->get();
            }
            if (($userStaff[0]->staff)->isEmpty()){
                return response()->json([]);
                return $this->jsonResponse(1, \Lang::get('messages.permission_denied'));
            }
            else{
                $id = $userStaff[0]->staff[0]->id;
                StaffSchedule::where("staff_id",$id)->delete();
                foreach($request->days as $key =>$item) {
                    foreach($item as $it) {
                        $staffSchedule = new StaffSchedule;
                        $staffSchedule->staff_id = $id;
                        $staffSchedule->starting_workday_time = $it[0];
                        $staffSchedule->ending_workday_time = $it[1];
                        $staffSchedule->weekday = $key+1;
                        $staffSchedule->save();
                    }
                }
                return $this->jsonResponse(0, \Lang::get('messages.the_schedules_have_been_updated'));
            }           
        }
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
