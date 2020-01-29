<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'message';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'from', 'to', 'message', 'sent', 'read'
    ];

    public function fromUser() {
        return $this->belongsTo("App\User");
    }

    public function toUser() {
        return $this->belongsTo("App\User");
    }
    

}