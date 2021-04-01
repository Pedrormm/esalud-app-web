<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

/**
 * Class Treatment
 * @package App\Models
 * @version April 1, 2020, 8:16 pm UTC
 *
 * @property \App\Models\User userDoctor
 * @property \App\Models\User userPatient
 * @property \App\Models\TypeMedcine type_medicine
 * @property \App\Models\MedicineAdministration medicineAdministration
 * @property integer user_id_patient
 * @property integer user_id_doctor
 * @property integer type_medicine_id
 * @property integer medicine_administration_id
 * @property string description
 * @property string treatment_starting_date
 * @property string treatment_end_date
 */
class Treatment extends Model
{
    use SoftDeletes;

    public $table = 'treatments';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'user_id_patient',
        'user_id_doctor',
        'type_medicine_id',
        'medicine_administration_id',
        'description',
        'treatment_starting_date',
        '
        '
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
        'type_medicine_id' => 'integer',
        'medicine_administration_id' => 'integer',
        'description' => 'string',
        'treatment_starting_date' => 'date',
        'treatment_end_date' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id_patient' => 'required',
        'user_id_doctor' => 'required',
        'type_medicine_id' => 'required',
        'description' => 'required'
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function typeMedicine()
    {
        return $this->belongsTo(\App\Models\TypeMedicine::class, 'type_medicine_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function medicineAdministration()
    {
        return $this->belongsTo(\App\Models\MedicineAdministration::class, 'medicine_administration_id');
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

        $treatments = DB::select('SELECT treatments.*, type_medicines.name as nameMedicine FROM treatments INNER JOIN type_medicines ON type_medicines.id = treatments.type_medicine_id WHERE treatments.user_id_patient = '.$user_id.'');
		return $treatments;
	}
}
