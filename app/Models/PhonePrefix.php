<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class PhonePrefix
 * @package App\Models
 * @version June 23, 2021, 9:10 pm UTC
 *
 * @property string $prefix
 * @property integer $country_id
 */
class PhonePrefix extends Model
{
    use SoftDeletes;

    // use HasFactory;

    public $table = 'phone_prefixes';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'prefix',
        'country_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'prefix' => 'string',
        'country_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'prefix' => 'required',
        'country_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function users()
    {
        return $this->hasMany(\App\Models\User::class, 'phone_prefix_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function countries()
    {
        return $this->belongsTo(\App\Models\Country::class, 'country_id');
    }

    
}
