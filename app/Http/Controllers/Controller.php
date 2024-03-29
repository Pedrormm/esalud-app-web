<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Controller constructor.
     */
    public function __construct() {

        view()->composer('*',function($view) {
            $view->with('perms', fillPermissionClass());
        });
    }

    /**Returns the permissions associated to the current user
     * 
     * @return mixed
     */
    public function getPerms() {
        return $this->perms;
    }

    /** Returns a custom json response
     * 
     * @param string $status
     * @param string $message
     * @param null $obj
     * @return \Illuminate\Http\JsonResponse
     */
    protected function jsonResponse(string $status, string $message, $obj = null) {
        $res = ['status' => $status, 'message' => $message];
        if ($obj){
            $res = ['status' => $status, 'message' => $message, 'obj' => $obj];
        }
        return response()->json($res);
    }

    /** Returns an error message when the request is not ajax
     * 
     * @param Request $request
     * @param string $message
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected function errorNotAjax(Request $request, string $message) {
        if($request->wantsJson()) {
            // dd($request);
            // return response()->json([]);
            return $this->jsonResponse(1, $message);
        }
        Session::put('info', $message);
        return redirect('/');
    }

    /** Returns all the errors redirecting back
     * 
     * @param $errors
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function backWithErrors($errors) {
        if(is_string($errors))
            $errors = [$errors];
        return redirect()->back()->withErrors($errors);
    }

    /** Checks the proper validation rules
     * 
     * @param array $rules
     * @return array
     */
    protected function checkValidation(array $rules){
        return request()->validate($rules);
    }

    /** Generates an unique token
     * 
     * @param string $tableName
     * @param string $field
     * @param int $length
     * @return \Illuminate\Http\RedirectResponse|string
     */
    protected function generateUniqueToken(string $tableName, string $field, int $length=32){
        $maxSteps = HV_MAX_ITERATION_TOKEN; // We do not allow this for security reasons
        $try = 0;
        do {
            $token = Str::random($length);

            if($try >= $maxSteps) {
                // Exceptional case. Shouldn't happen unless we have millions of users
                return back()->withErrors("internal_error");
            }
            $try++;
        } while (!is_null(DB::table($tableName)->where($field, $token)->first()));
        return $token;
    }

     /**
     * Checks request data validation for data tables server side request
     * @link https://datatables.net/manual/server-side
     */
    protected function checkDataTablesRules() {
        $rules = [
            'draw' => 'required|numeric|min:1',
            'start' => 'required|numeric|min:0',
            'length' => 'required|numeric|min:-1', //-1 means all records, > 1 the pagination records
            'search.value' => 'present|nullable|string',
            'search.regex' => 'present|string|in:true,false',
            'order.*.column' => 'required|numeric|min:0',
            'order.*.dir' => 'required|string|in:asc,desc',
            'columns.*.data' => 'present|nullable|string|required_without:columns.*.data._,columns.*.data.sort',
            //'columns.*.data._' => 'present|nullable|string|required_without:columns.*.data',
            //'columns.*.data.sort' => 'present|nullable|string|required_without:columns.*.data',
            'columns.*.name' => 'present|nullable|string',
            'columns.*.searchable' => 'required|string|in:true,false',
            'columns.*.orderable' => 'required|string|in:true,false',
            'columns.*.search.value' => 'present|nullable|string',
            'columns.*.search.regex' => 'required|string|in:true,false'
        ];
        request()->validate($rules);
    }

    /** Response for Datatables plugin
     * 
     * @param array $data
     * @param int $draw
     * @param int $total
     * @param int $totalFiltered
     * @return \Illuminate\Http\JsonResponse
     */
    protected function responseDataTables(array $data, int $draw, int $total, int $totalFiltered) {
        $dataSend = array();
        $dataSend['draw'] = $draw;
        $dataSend['recordsTotal'] = $total;
        $dataSend['recordsFiltered'] = $totalFiltered;
        $dataSend['data'] = $data;
        return response()->json($dataSend);
    }

    /**
     * Converts a given mysql default date into spanish representation with format d/m/Y
     *
     * @param string|null $mysqlDt The input datetime that must complain format Y/m/d
     * @return string
     */
    function mysqlDate2Spanish($mysqlDt) {

        try {
            $dtSpanish = Carbon::parse($mysqlDt)->format('d/m/Y');
        }
        catch(InvalidFormatException $ex) {
            $dtSpanish = "1/1/1990";
        }
        return $dtSpanish;
    }


    /**
     * Converts a given mysql default datetime into spanish representation with format d/m/Y H:i
     *
     * @param string|null $mysqlDt The input datetime that must complain format Y/m/d h:m
     * @return string
     */
    function mysqlDateTime2Spanish($mysqlDt) {

        try {
            $dtSpanish = Carbon::parse($mysqlDt)->format('d/m/Y H:i');
        }
        catch(InvalidFormatException $ex) {
            $dtSpanish = "1/1/1990 0:0";
        }
        return $dtSpanish;
    }


    }
