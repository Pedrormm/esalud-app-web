<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table = 'notes';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'text', 'event', 'visible', 'created_at', 'updated_at'
    ];

    public function User() {
        return $this->belongsTo("App\User");
    }
}
