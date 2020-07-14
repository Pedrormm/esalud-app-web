<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

/**
 * Class Medicine
 * @package App\Models
 * @version April 1, 2020, 8:16 pm UTC
 *
 * @property \App\Models\User userDoctor
 * @property \App\Models\User userPatient
 * @property integer user_id_patient
 * @property integer user_id_doctor
 * @property integer medicine
 * @property string interval
 * @property string stop
 * @property integer stop_user
 */
class Medicine extends Model
{
    use SoftDeletes;

    public $table = 'medicines';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id_patient',
        'user_id_doctor',
        'medicine',
        'interval',
        'stop',
        'stop_user'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id_patient' => 'integer',
        'user_id_doctor' => 'integer',
        'medicine' => 'integer',
        'interval' => 'string',
        'stop' => 'string',
        'stop_user' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id_patient' => 'required',
        'user_id_doctor' => 'required',
        'medicine' => 'required',
        'stop_user' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function userDoctor()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id_doctor');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function userPatient()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id_patient');
    }

    public static function interval($interval1){
        $interval = explode('#', $interval1);
        $interval_text = $interval[0] . ' cada ' . $interval[1] . ' ';

        switch($interval[2]){
            case 'h': $interval_text .= 'hora/s';break;
            case 'd': $interval_text .= 'dia/s';break;
            case 'w': $interval_text .= 'semana/s';break;
            case 'm': $interval_text .= 'mes/es';break;
            case 'y': $interval_text .= 'año/s';break;
        }

        return $interval_text;
    }

    public static function medicine_by_user($user_id){

        $medicines = DB::select('SELECT medicines.*, type_medicines.name as nameMedicine FROM medicines INNER JOIN type_medicines ON type_medicines.id = medicines.type_medicine_id WHERE medicines.user_id_patient = '.$user_id.'');
		return $medicines;
	}
}
