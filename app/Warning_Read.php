<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warning_Read extends Model
{
    protected $table = 'warning_reads';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'warning_id', 'created_at', 'updated_at'
    ];

    public function User() {
        return $this->belongsTo("App\User");
    }

    public function Warning() {
        return $this->belongsTo("App\Warning");
    }
}
