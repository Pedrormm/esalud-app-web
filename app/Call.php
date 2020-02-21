<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    protected $table = 'calls';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id_caller', 'user_id_receptor', 'event', 'created_at', 'updated_at'
    ];

    public function callerUser() {
        return $this->belongsTo("App\User");
    }

    public function receptorUser() {
        return $this->belongsTo("App\User");
    }
}
