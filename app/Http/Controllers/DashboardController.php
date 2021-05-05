<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Message;


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
            foreach($numberMsg as $rol=>$value) {
                $numberMsg[$rol] = [
                    'cnt' => $value,
                    'perc' => round($value/$total*100,2)
                ];
            }

            // $msRecieved = Message::with("userFrom.roles")->get()->groupBy([
            //     'userFrom.role_id'
            // ]); 
           
            // $numberMsgRecieved  = []; 
            // $total = 0;
            
            // foreach ($msRecieved as $m) {
            //     $roleName = $m[0]->userFrom->roles->name;
            //     $c = $m->count();   
            //     $total += $c;
            //     $numberMsg[$roleName]= $c;
            // }

            // $total = array_sum(array_values($numberMsg));
            return response()->json($numberMsg);
            dd($numberMsg);


            dd($ms->toArray());
            dd($ms->groupBy('userFrom->role_id')->toArray());
        }
    }
}
