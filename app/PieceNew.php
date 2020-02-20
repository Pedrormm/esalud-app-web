<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PieceNew extends Model
{
    protected $table = 'piecenews';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'date', 'created_at', 'updated_at'
    ];
    
}