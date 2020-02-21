<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $table = 'medicines';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id_patient', 'user_id_doctor', 'medicine', 'interval', 'stop', 'stop_user', 'created_at', 'updated_at'
    ];

    public function patientUser() {
        return $this->belongsTo("App\User");
    }

    public function doctorUser() {
        return $this->belongsTo("App\User");
    }    
}
