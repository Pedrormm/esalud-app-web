<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id_from', 'user_id_to', 'message', 'read', 'created_at', 'updated_at'
    ];

    public function fromUser() {
        return $this->belongsTo("App\User");
    }

    public function toUser() {
        return $this->belongsTo("App\User");
    }
    

}