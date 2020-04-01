<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class WarningRead
 * @package App\Models
 * @version April 1, 2020, 8:22 pm UTC
 *
 * @property \App\Models\User user
 * @property \App\Models\Warning warning
 * @property integer user_id
 * @property integer warning_id
 */
class WarningRead extends Model
{
    use SoftDeletes;

    public $table = 'warnings_reads';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'warning_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'warning_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'warning_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function warning()
    {
        return $this->belongsTo(\App\Models\Warning::class, 'warning_id');
    }
}
