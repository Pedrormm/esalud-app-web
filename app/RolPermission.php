<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RolPermission extends Model
{
    protected $table = 'analytics';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rol_id', 'permission_id', 'value', 'value_name', 'created_at', 'updated_at'
    ];

    public function role() {
        return $this->belongsTo(App\Role::class);
    }

    public function permission() {
        return $this->belongsTo(App\Permission::class);
    }
}
