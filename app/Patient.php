<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'patients';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fk_users_user_id', 'historic', 'status', 'height', 'weight', 'created_at', 'updated_at'
    ];

    public function user() {
        return $this->belongsTo("App\User");
        // Tiene 1 usuario
    }
    

}