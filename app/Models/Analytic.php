<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Analytic
 * @package App\Models
 * @version April 1, 2020, 8:14 pm UTC
 *
 * @property \App\Models\AnalyticsResult analyticResult
 * @property \App\Models\User userCreator
 * @property \App\Models\User userUser
 * @property integer type
 * @property integer user_id_user
 * @property integer user_id_creator
 * @property integer analytic_result
 * @property string result
 */
class Analytic extends Model
{
    use SoftDeletes;

    public $table = 'analytics';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'type',
        'user_id_user',
        'user_id_creator',
        'analytic_result',
        'result'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'type' => 'integer',
        'user_id_user' => 'integer',
        'user_id_creator' => 'integer',
        'analytic_result' => 'integer',
        'result' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'type' => 'required',
        'user_id_user' => 'required',
        'user_id_creator' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function analyticResult()
    {
        return $this->belongsTo(\App\Models\AnalyticsResult::class, 'analytic_result');
    }

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
    public function userUser()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id_user');
    }
}
