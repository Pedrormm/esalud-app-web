<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Reports
 * @package App\Models
 * @version April 1, 2020, 8:21 pm UTC
 *
 * @property integer event_id
 * @property string report
 * @property integer absence
 */
class Reports extends Model
{
    use SoftDeletes;

    public $table = 'reports';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'event_id',
        'report',
        'absence'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'event_id' => 'integer',
        'report' => 'string',
        'absence' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'event_id' => 'required',
        'absence' => 'required'
    ];

    
}
