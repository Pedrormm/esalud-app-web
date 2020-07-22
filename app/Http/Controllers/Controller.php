<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function jsonResponse(string $status, string $message) {
        return response()->json(['status' => $status, 'message' => $message]);
    }

    protected function checkValidation(array $rules){
        return request()->validate($rules);     
    }

    protected function generateUniqueToken(string $tableName, string $field, int $lenght=32){
        $maxSteps = HV_MAX_ITERATION_TOKEN; //Por seguridad, no vamos a permitir esto
        $try = 0;
        do {            
            $token = Str::random($length);

            
            if($try >= $maxSteps) {
                // Caso muy excepcional, que no deberia pasar a no ser que tengamos millones de usuarios
                return response()->back()->withErrors("Internal error");
            }
            $try++;
        } while (!is_null(DB::table($tableName)->where($field, $token)->first()));
        return $token;
    }

    
}
