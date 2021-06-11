<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Message;
use App\Models\Treatment;
use DB;
use Carbon\Carbon;
use Lang;


class DashboardController extends Controller
{
    public function frontPageDashboard() {
        $authUser = Auth::user();

        return view('dashboard/ajaxfrontPageDashboard', []);
    }

    public function fillMsgTable(Request $request){
        if ($request->ajax()){
            $ms = Message::with("userFrom.roles")->get()->groupBy([
                'userFrom.role_id'
            ]); 
           
            $numberMsg = []; 
            $total = 0;
            
            foreach ($ms as $m) {
                $roleName = $m[0]->userFrom->roles->name;
                $c = $m->count();   
                $total += $c;
                $numberMsg[$roleName]= $c;
            }
            if($total > 0) {
                foreach($numberMsg as $rol=>$value) {
                    $numberMsg[$rol] = [
                        'cnt' => $value,
                        'perc' => round($value/$total*100,2)
                    ];
                }
            }
            
            return response()->json($numberMsg);

        }
    }

    public function fillUsersTypeRoles(Request $request){
        if ($request->ajax()){
            $users = User::select('role_id', DB::raw('count(*) as total'))
            ->with(array('roles' => function($query) {
                $query->select('id','name');
            }))
            ->groupBy('role_id')->get();
            $index_color = 0;
            $colors = \HV_DASHBOARD_USERS_COLORS::$COLORS;
            foreach($users as $u){
                $color = \HV_DASHBOARD_USERS_COLORS::$COLORS[$index_color];
                $u->color = $color;
                if($index_color==sizeof($colors)){
                    $index_color=0;
                    $u->roles->name = "Others";
                }
                else
                    $index_color++;
            }

            return response()->json($users);
        }
    }

    public function fillWeekAppointments(Request $request){
        if ($request->ajax()){
            $dates = Appointment::select('dt_appointment')->get();
            $week = \Lang::get('messages.weekMap');
            foreach ($dates as $d){
                $weekday = Carbon::parse($d["dt_appointment"])->dayOfWeek;
                $weekday = ($weekday == 0)?7:$weekday;
                $d->weekday = $weekday;
            }

            $grouped = $dates->groupBy(function ($item, $key) {
                return substr($item['weekday'], 0);
            });
            
            $groupCount = $grouped->map(function ($item, $key) {
                return collect($item)->count();
            });
            $groupCount = $groupCount->sortKeys()->toArray();
            $data = [];
            foreach($week as $index => $item) {
                $result = $groupCount[$index] ?? 0;
                $data[]= [
                    'weekName' => $item,
                    'value' => $result
                ];
            }
            

            // dd($data);

            // dd(__('messages.hello_data'));
            // dd(@lang('messages.dashboard_pending'));

            return response()->json($data);
        }
    }

    public function fillDiaryAppointments(Request $request){
        if ($request->ajax()){
            $ap = Appointment::select('id','dt_appointment','checked','updated_at')->whereDate('updated_at', Carbon::today())
            ->whereDate('dt_appointment', '<=', Carbon::today())
            ->get();
            // dd($ap->toArray());
            $data = [];
            $pendingCount = 0;
            $processedCount = 0;
            $data["pending"]=$pendingCount;
            $data["processed"]=$processedCount;
            foreach ($ap as $a){
                if (isset($a->checked)) {
                    if (($a->checked) == 0){
                        $pendingCount++;
                        $data["pending"]=$pendingCount;
                    }
                    else if  ((($a->checked) == 1) || (($a->checked) == 2)){
                        $processedCount++;
                        $data["processed"]=$processedCount;
                    }
                    else{
                        // error
                    }
                }

            }

            return response()->json($data);
        }
    }

    public function fillDelayedAppointments(Request $request){
        if ($request->ajax()){
            $ap = Appointment::select('id','dt_appointment','checked','updated_at')
            ->whereDate('updated_at', '<', Carbon::today())
            ->whereDate('dt_appointment', '<=', Carbon::today())
            ->get();
            // dd($ap->toArray());
            $data = [];
            $pendingCount = 0;
            $processedCount = 0;
            $data["pending"]=$pendingCount;
            $data["processed"]=$processedCount;
            foreach ($ap as $a){
                if (isset($a->checked)) {
                    if (($a->checked) == 0){
                        $pendingCount++;
                        $data["pending"]=$pendingCount;
                    }
                    else if  ((($a->checked) == 1) || (($a->checked) == 2)){
                        $processedCount++;
                        $data["processed"]=$processedCount;
                    }
                    else{
                        // error
                    }
                }

            }

            return response()->json($data);
        }
    }

    public function fillSinglePatientAppointments(Request $request){
        if ($request->ajax()){
            $id = auth()->user()->id;
            $ap = Appointment::select('id','dt_appointment','checked','updated_at')
            ->where('user_id_patient', $id)
            ->get();
            // dd($ap->toArray());
            $data = [];
            $pendingCount = 0;
            $acceptedCount = 0;
            $rejectedCount = 0;
            $data["pending"]=$pendingCount;
            $data["accepted"]=$acceptedCount;
            $data["rejected"]=$rejectedCount;

            foreach ($ap as $a){
                if (isset($a->checked)) {
                    if (($a->checked) == 0){
                        $pendingCount++;
                        $data["pending"]=$pendingCount;
                    }
                    else if (($a->checked) == 1){
                        $acceptedCount++;
                        $data["accepted"]=$acceptedCount;
                    }
                    else if (($a->checked) == 2){
                        $rejectedCount++;
                        $data["rejected"]=$rejectedCount;
                    }
                    else{
                        // error
                    }
                }

            }

            return response()->json($data);
        }
    }

    public function filltreatmentsInProgress(Request $request){
        if ($request->ajax()){
            $id = auth()->user()->id;

            $pastTreatments = Treatment::select('id','user_id_patient','description','treatment_starting_date','treatment_end_date')
            ->where('user_id_patient', 17)
            ->whereDate('treatment_end_date', '<=', Carbon::today())
            ->get()->count();

            $futureTreatments = Treatment::select('id','user_id_patient','description','treatment_starting_date','treatment_end_date')
            ->where('user_id_patient', 17)
            ->whereDate('treatment_end_date', '>', Carbon::today())
            ->get()->count();

            $data = [];
            $data["progress"]=$futureTreatments;
            $data["finished"]=$pastTreatments;

            return response()->json($data);
        }
    }

}
