<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Protocol extends Model
{
    protected $table = 'protocols';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id_creator', 'user_id_user', 'name', 'deleted', 'created_at', 'updated_at'
    ];

    public function creatorUser() {
        return $this->belongsTo("App\User");
    }

    public function userUser() {
        return $this->belongsTo("App\User");
    }
}