<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Role
 * @package App\Models
 * @version April 1, 2020, 8:02 pm UTC
 *
 * @property \App\Models\User userCreator
 * @property \Illuminate\Database\Eloquent\Collection rolesPermissions
 * @property \Illuminate\Database\Eloquent\Collection user1s
 * @property string name
 * @property integer user_id_creator
 */
class Role extends Model
{
    use SoftDeletes;

    public $table = 'roles';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'user_id_creator'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'user_id_creator' => 'integer',
        'delible' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id_creator' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function userCreator()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id_creator');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function rolesPermissions()
    {
        return $this->hasMany(\App\Models\RolePermission::class, 'role_id');
    }

    public function rolesPermissionsEnabled()
    {
        return $this->hasMany(\App\Models\RolePermission::class, 'role_id')->where('activated',1);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function user1s()
    {
        return $this->hasMany(\App\Models\User::class, 'role_id');
    }
}
