<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warning extends Model
{
    protected $table = 'warnings';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id_creator', 'user_id_patient', 'text', 'scope', 'deleted', 'created_at', 'updated_at'
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

    public function creatorUser() {
        return $this->belongsTo("App\User");
    }

    public function patientUser() {
        return $this->belongsTo("App\User");
    }

    public function warning_reads() {
        return $this->hasMany("App\Warning_Read");
    }
}
