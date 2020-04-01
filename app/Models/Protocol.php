<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Protocol
 * @package App\Models
 * @version April 1, 2020, 8:19 pm UTC
 *
 * @property \App\Models\User userCreator
 * @property \App\Models\User userUser
 * @property integer user_id_creator
 * @property integer user_id_user
 * @property string name
 */
class Protocol extends Model
{
    use SoftDeletes;

    public $table = 'protocols';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id_creator',
        'user_id_user',
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id_creator' => 'integer',
        'user_id_user' => 'integer',
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id_creator' => 'required',
        'user_id_user' => 'required'
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
    public function userUser()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id_user');
    }
}
