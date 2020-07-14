<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

/**
 * Class Event
 * @package App\Models
 * @version April 1, 2020, 8:16 pm UTC
 *
 * @property \App\Models\User userDoctor
 * @property \App\Models\User userPatient
 * @property integer user_id_patient
 * @property integer user_id_doctor
 * @property integer start
 * @property integer online
 * @property string location
 * @property string request
 * @property integer finished
 */
class Event extends Model
{
    use SoftDeletes;

    public $table = 'events';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id_patient',
        'user_id_doctor',
        'start',
        'online',
        'location',
        'request',
        'finished'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id_patient' => 'integer',
        'user_id_doctor' => 'integer',
        'start' => 'integer',
        'online' => 'integer',
        'location' => 'string',
        'request' => 'string',
        'finished' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id_patient' => 'required',
        'user_id_doctor' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function userDoctor()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id_doctor');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function userPatient()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id_patient');
    }
	
	public static function eventsForUser($user_id){
		$events = DB::select('SELECT events.*,reports.* FROM events INNER JOIN reports ON reports.event_id = events.id WHERE events.user_id_patient = '.$user_id.' and reports.report != "" ');
		return $events;
	}
}
