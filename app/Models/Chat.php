<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Chat
 * @package App\Models
 * @version April 1, 2020, 8:15 pm UTC
 *
 * @property \App\Models\User userUserA
 * @property \App\Models\User userUserB
 * @property integer user_id_user_A
 * @property integer user_id_user_B
 */
class Chat extends Model
{
    use SoftDeletes;

    public $table = 'chats';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id_user_A',
        'user_id_user_B'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id_user_A' => 'integer',
        'user_id_user_B' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id_user_A' => 'required',
        'user_id_user_B' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function userUserA()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id_user_A');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function userUserB()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id_user_B');
    }
}
