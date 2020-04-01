<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PatientDoctor
 * @package App\Models
 * @version April 1, 2020, 8:20 pm UTC
 *
 * @property \App\Models\User userDoctor
 * @property \App\Models\User userPatient
 * @property integer user_id_doctor
 * @property integer user_id_patient
 */
class PatientDoctor extends Model
{
    use SoftDeletes;

    public $table = 'patients_doctors';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id_doctor',
        'user_id_patient'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id_doctor' => 'integer',
        'user_id_patient' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id_doctor' => 'required',
        'user_id_patient' => 'required'
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
}
