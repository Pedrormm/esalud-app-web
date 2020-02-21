<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Analytic extends Model
{
    protected $table = 'analytics';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'user_id_user', 'user_id_creator', 'result', 'deleted', 'created_at', 'updated_at'
    ];

    public function userUser() {
        return $this->belongsTo("App\User");
    }

    public function creatorUser() {
        return $this->belongsTo("App\User");
    }
}
