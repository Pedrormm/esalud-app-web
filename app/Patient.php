<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'patient';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'historic', 'user_id', 'status', 'height', 'weight'
    ];

    public function user() {
        return $this->belongsTo("App\User");
        // Tiene 1 usuario
    }
    

}