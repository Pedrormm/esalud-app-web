<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Appointment extends Model
{
    use SoftDeletes;

    protected $table = "appointments";

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $fillable = [
        'user_id_patient',
        'user_id_creator',
        'user_id_doctor',
        'dt_appointment',
        'checked',
        'accomplished',
        'comments',
        'user_comment'
    ];

    protected $casts = [
        'id' => 'integer',
        'user_id_patient' => 'integer',
        'user_id_creator' => 'integer',
        'user_id_doctor' => 'integer',
        'accomplished' => 'integer',
        'checked' => 'integer',
        'comments' => 'string',
        'user_comment' => 'string'
    ];

    public function userPatient()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id_patient');
    }

    public function userCreator()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id_creator');
    }

    public function userDoctor()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id_doctor');
    }

    public static function getChecked($value){

        $text = "";

        if($value == 0){
            $text = \Lang::get('messages.pending_stat');
        }else if($value == 1){
            $text = \Lang::get('messages.accepted_stat');
        }else if($value == 2){
            $text = \Lang::get('messages.rejected_stat');
        }
        return $text;

    }

    public static function getAccomplished($value){
        
        $text = "";

        if($value == 0){
            $text = \Lang::get('messages.appointment_not_completed');
        }else if($value == 1){
            $text = \Lang::get('messages.appointment_completed');
        }else if($value == 2){
            $text = \Lang::get('messages.appointment_on_hold');
        }
        return $text;

    }
}
