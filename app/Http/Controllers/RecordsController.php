<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Patient;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
use DateTime;
use DatePeriod;
use DateInterval;

class RecordsController extends Controller
{

    public function index(string $ord=null, string $sex_fil=null, string $age_fil=null, string $n_search=null) {
        $user = Auth::user();

        if (is_null($ord)){
            $ord = 'user_id';
        }

        if ((Schema::hasColumn('users', $ord) || Schema::hasColumn('patient', $ord))) {
            // Comprobar si columna existe en la BD
            $sex = ['male', 'female'];
            if (!is_null($sex_fil) && !empty($sex_fil) && $sex_fil != "no"){
                $sex = explode(" ",$sex_fil);
            }

            $from = get_birthdate_from_yearstring("0");
            $to = get_birthdate_from_yearstring("140");
            if (!is_null($age_fil) && !empty($age_fil) && $age_fil != "no"){
                $splitedDate = explode("-","$age_fil");
                $from = get_birthdate_from_yearstring($splitedDate[0]);
                $to = get_birthdate_from_yearstring($splitedDate[1]);
            }

            $patients = Patient::join('users', 'patient.user_id', 'users.id')->orderBy($ord)
            ->whereIn('sex', $sex)
            ->whereDate('birthdate', '<=', $from)->whereDate('birthdate', '>=', $to)->get();

            if (!is_null($n_search) && !empty($n_search) && isset($n_search)){
                $patients = Patient::join('users', 'patient.user_id', 'users.id')->orderBy($ord)
                ->whereIn('sex', $sex)
                ->whereDate('birthdate', '<=', $from)->whereDate('birthdate', '>=', $to)
                ->where('name', 'LIKE', '%'.$n_search.'%')
                ->orWhere('lastname', 'LIKE', '%'.$n_search.'%')
                ->orWhere('historic', 'LIKE', '%'.$n_search.'%')
                ->orWhere('dni', 'LIKE', '%'.$n_search.'%')
                ->get();
            }
        }

        return view('user/records', ['patients' => $patients,'user' => $user]);
    }

    public function showRecord(string $id=null) {
        $user = Auth::user();        
        return view('user/singlerecord', ['id' => $id,'user' => $user]);
    }

}
