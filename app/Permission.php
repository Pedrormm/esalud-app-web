<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'analytics';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'flag_meaning', 'default_permission', 'permission_name', 'created_at', 'updated_at'
    ];

    public function rol_permission() {
        return $this->hasMany("App\Rol_Permission");
    }

}
