<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Message
 * @package App\Models
 * @version April 1, 2020, 8:17 pm UTC
 *
 * @property \App\Models\User userFrom
 * @property \App\Models\User userTo
 * @property integer user_id_from
 * @property integer user_id_to
 * @property string message
 * @property integer read
 */
class Message extends Model
{
    use SoftDeletes;

    public $table = 'messages';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id_from',
        'user_id_to',
        'message',
        'read'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id_from' => 'integer',
        'user_id_to' => 'integer',
        'message' => 'string',
        'read' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id_from' => 'required',
        'user_id_to' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function userFrom()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id_from');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function userTo()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id_to');
    }
}
