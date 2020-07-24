<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class UserInvitation extends Model
{
    use SoftDeletes;

    public $table = "users_invitations";
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    
    public $fillable = [
        'dni',
        'email',
        'verification_token',
        'expiration_date',
        'times_sent',
        'role_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'dni' => 'string',
        'email' => 'string',
        'verification_token' => 'string',
        'expiration_date' => 'date',
        'times_sent' => 'integer',
        'role_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'dni' => 'required',
        'remember_token' => 'required',
        'expiration_date' => 'required',
        'role_id' => 'required'
    ];

    public function role()
    {
        return $this->belongsTo(\App\Models\Role::class, 'role_id');
    }

}
