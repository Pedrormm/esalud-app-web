<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
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

    public function userCreator() {
        return $this->belongsTo("App\User");
    }

    public function rolPermission() {
        return $this->hasMany("App\Rol_Permission");
    }

    public function users() {
        return $this->hasMany("App\User");
    }




}
