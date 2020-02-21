<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    protected $table = 'relations';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id_doctor', 'user_id_patient', 'deleted', 'created_at', 'updated_at'
    ];

    public function doctorUser() {
        return $this->belongsTo("App\User");
    }

    public function patientUser() {
        return $this->belongsTo("App\User");
    }
}
