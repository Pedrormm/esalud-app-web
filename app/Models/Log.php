<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Log
 * @package App\Models
 * @version April 1, 2020, 8:16 pm UTC
 *
 * @property \App\Models\User user
 * @property integer user_id
 * @property integer action
 * @property integer tool
 * @property integer element
 */
class Log extends Model
{
    use SoftDeletes;

    public $table = 'logs';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'action',
        'tool',
        'element'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'action' => 'integer',
        'tool' => 'integer',
        'element' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
