<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
