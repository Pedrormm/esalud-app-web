<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Call
 * @package App\Models
 * @version April 1, 2020, 8:15 pm UTC
 *
 * @property \App\Models\User userCaller
 * @property \App\Models\User userReceptor
 * @property integer user_id_caller
 * @property integer user_id_receptor
 * @property integer event
 */
class Call extends Model
{
    use SoftDeletes;

    public $table = 'calls';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id_caller',
        'user_id_receptor',
        'event'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id_caller' => 'integer',
        'user_id_receptor' => 'integer',
        'event' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id_caller' => 'required',
        'user_id_receptor' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function userCaller()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id_caller');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function userReceptor()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id_receptor');
    }
}
