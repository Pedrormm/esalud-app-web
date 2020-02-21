<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'reports';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'event_id', 'report', 'absence', 'created_at', 'updated_at'
    ];

    public function Event() {
        return $this->belongsTo("App\Event");
    }

}
