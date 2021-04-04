<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StaffSchedule;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('schedule.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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

    public function generateSchedule(Request $request ){
        // if ($request->ajax()){
            $userLogged = Auth::user();
            $userStaff = User::with("staff")->where("id",2)->get();
            // $userStaff = $userStaff->toArray();
            // dd($userStaff);
            if (($userStaff[0]->staff)->isEmpty()){
                return response()->json([]);
            }
            else{
                $id = $userStaff[0]->staff[0]->id;
                $staffSchedule = StaffSchedule::with("staff")
                ->where('staff_id',$id)
                ->get();
                return $this->jsonResponse(0,$staffSchedule);
            }
        // }
    }
}
