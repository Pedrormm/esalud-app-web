<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Staff
 * @package App\Models
 * @version April 1, 2020, 8:11 pm UTC
 *
 * @property \App\Models\User user
 * @property integer staff_id
 * @property time starting_workday_time
 * @property time ending_workday_time
 * @property integer weekday
 */

class StaffSchedule extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'staff_schedules';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $fillable = [
        'staff_id',
        'starting_workday_time',
        'ending_workday_time',
        'weekday'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'staff_id' => 'integer',
        'starting_workday_time' => 'string',
        'ending_workday_time' => 'string',
        'weekday' => 'integer'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function staff()
    {
        return $this->belongsTo(\App\Models\Staff::class, 'staff_id');
    }

}
