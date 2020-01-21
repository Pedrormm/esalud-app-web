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
        'type', 'user', 'creator', 'result', 'deleted'
    ];

    public function User() {
        return $this->belongsTo("App\User");
    }
}
