<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Country
 * @package App\Models
 * @version June 23, 2021, 8:59 pm UTC
 *
 * @property string $name
 * @property string $short_name
 * @property string $long_name
 */
class Country extends Model
{
    use SoftDeletes;

    // use HasFactory;

    public $table = 'countries';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'short_name',
        'long_name',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'short_name' => 'string',
        'long_name' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'short_name' => 'required',
        'long_name' => 'required',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function users()
    {
        return $this->hasMany(\App\Models\User::class, 'country_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function phonePrefixes()
    {
        return $this->hasMany(\App\Models\PhonePrefix::class, 'country_id');
    }

    
}
