<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id_patient', 'user_id_doctor', 'start', 'online', 'location', 'request', 'finished', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function patientUser() {
        return $this->belongsTo("App\User");
    }

    public function doctorUser() {
        return $this->belongsTo("App\User");
    }
    
    public function reports() {
        return $this->hasMany("App\Report");
    }
}
