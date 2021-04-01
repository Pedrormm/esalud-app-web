<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class MedicineAdministration
 * @package App\MedicineAdministration
 * @version June 12, 2021, 10:35 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection treatments
 * @property string name
 */

class MedicineAdministration extends Model
{
    // use HasFactory;

    use SoftDeletes;

    public $table = 'medicines_administration';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function treatments()
    {
        return $this->hasMany(\App\Models\Treatment::class, 'medicine_administration_id');
    }
}
