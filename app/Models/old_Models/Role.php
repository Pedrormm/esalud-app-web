<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
   // use SoftDeletes;

    protected $table = 'roles';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'user_id_creator', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'boolean',
        'name' => 'string',
        'user_id_creator' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id_creator' => 'required'
    ];

    public function userCreator() {
        return $this->belongsTo("App\User", 'user_id_creator');
    }

    public function rolPermission() {
        return $this->hasMany("App\Rol_Permission");
    }
    
    public function users() {
        return $this->hasMany("App\User");
    }




}
