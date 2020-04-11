<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class RolePermission
 * @package App\Models
 * @version April 1, 2020, 8:22 pm UTC
 *
 * @property \App\Models\Permission permission
 * @property \App\Models\Role role
 * @property integer role_id
 * @property integer permission_id
 * @property integer value
 * @property string value_name
 */
class RolePermission extends Model
{
    use SoftDeletes;

    public $table = 'roles_permissions';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'role_id',
        'permission_id',
        'value',
        'value_name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'role_id' => 'integer',
        'permission_id' => 'integer',
        'value' => 'integer',
        'value_name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'role_id' => 'required',
        'permission_id' => 'required',
        'value' => 'required',
        'value_name' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function permission()
    {
        return $this->belongsTo(\App\Models\Permissions::class, 'permission_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function role()
    {
        return $this->belongsTo(\App\Models\Role::class, 'role_id');
    }
}
