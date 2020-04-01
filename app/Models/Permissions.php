<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Permissions
 * @package App\Models
 * @version April 1, 2020, 8:18 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection rolesPermissions
 * @property string flag_meaning
 * @property integer default_permission
 * @property string permission_name
 */
class Permissions extends Model
{
    use SoftDeletes;

    public $table = 'permissions';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'flag_meaning',
        'default_permission',
        'permission_name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'flag_meaning' => 'string',
        'default_permission' => 'integer',
        'permission_name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'flag_meaning' => 'required',
        'default_permission' => 'required',
        'permission_name' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function rolesPermissions()
    {
        return $this->hasMany(\App\Models\RolesPermission::class, 'permission_id');
    }
}
