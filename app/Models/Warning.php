<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Warning
 * @package App\Models
 * @version April 1, 2020, 8:22 pm UTC
 *
 * @property \App\Models\User userCreator
 * @property \App\Models\User userPatient
 * @property \Illuminate\Database\Eloquent\Collection warningsReads
 * @property integer user_id_creator
 * @property integer user_id_patient
 * @property string text
 * @property integer scope
 */
class Warning extends Model
{
    use SoftDeletes;

    public $table = 'warnings';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id_creator',
        'user_id_patient',
        'text',
        'scope'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id_creator' => 'integer',
        'user_id_patient' => 'integer',
        'text' => 'string',
        'scope' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id_creator' => 'required',
        'user_id_patient' => 'required',
        'scope' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function userCreator()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id_creator');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function userPatient()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id_patient');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function warningsReads()
    {
        return $this->hasMany(\App\Models\WarningsRead::class, 'warning_id');
    }
}
