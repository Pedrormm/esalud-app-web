<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'user_id', 'values', 'rol', 'individual', 'deleted', 'created_at', 'updated_at'
    ];

    public function User() {
        return $this->belongsTo("App\User");
    }
}
