<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staff';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'branch', 'horary', 'office', 'room', 'h_phone', 'created_at', 'updated_at'
    ];

    public function User() {
        return $this->belongsTo("App\User");
    } 
}
