<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Analytic extends Model
{
    protected $table = 'analytics';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'user_id_creator', 'created_at', 'updated_at'
    ];

    public function user_creator() {
        return $this->belongsTo("App\User");
    }

    public function rol_permission() {
        return $this->hasMany("App\Rol_Permission");
    }

    public function users() {
        return $this->hasMany("App\User");
    }




}
