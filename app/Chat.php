<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chats';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id_user_A', 'user_id_user_B', 'created_at', 'updated_at'
    ];

    public function userAUser() {
        return $this->belongsTo("App\User");
    }

    public function userBUser() {
        return $this->belongsTo("App\User");
    }
}
