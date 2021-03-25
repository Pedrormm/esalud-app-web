<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
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
    
    public function __construct() {
        
        view()->composer('*',function($view) {
            $view->with('perms', fillPermissionClass());
        });
    }
    public function getPerms() {
        return $this->perms;
    }
    protected function jsonResponse(string $status, string $message) {
        return response()->json(['status' => $status, 'message' => $message]);
    }
    protected function backWithErrors($errors) {
        if(is_string($errors))
            $errors = [$errors];
        return redirect()->back()->withErrors($errors);
    }
    protected function checkValidation(array $rules){
        return request()->validate($rules);     
    }

    protected function generateUniqueToken(string $tableName, string $field, int $length=32){
        $maxSteps = HV_MAX_ITERATION_TOKEN; //Por seguridad, no vamos a permitir esto
        $try = 0;
        do {            
            $token = Str::random($length);

            if($try >= $maxSteps) {
                // Caso muy excepcional, que no deberia pasar a no ser que tengamos millones de usuarios
                return back()->withErrors("Internal error");
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

    protected function responseDataTables(array $data, int $draw, int $total, int $totalFiltered) {
        $dataSend = array();
        $dataSend['draw'] = $draw;
        $dataSend['recordsTotal'] = $total;
        $dataSend['recordsFiltered'] = $totalFiltered;
        $dataSend['data'] = $data;
        return response()->json($dataSend);
    }

    /**
 * Convert a given mysql default datetime into spanish representation with format d/m/Y H:i:m
 *
 * @param string|null $mysqlDt The input datetime that must complain format Y/m/d h:m:s
 * @return string
 */
function mysqlDt2Spanish($mysqlDt) {
    
    try {
        $dtSpanish = Carbon::parse($mysqlDt)->format('d/m/Y');
    }
    catch(InvalidFormatException $ex) {
        $dtSpanish = "1/1/1990 0:0:0";
    }
    return $dtSpanish;
}

    
}
