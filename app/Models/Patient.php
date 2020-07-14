<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Patient
 * @package App\Models
 * @version April 1, 2020, 8:43 pm UTC
 *
 * @property \App\Models\User user
 * @property integer user_id
 * @property string historic
 * @property integer height
 * @property number weight
 */
class Patient extends Model
{
    use SoftDeletes;

    public $table = 'patients';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'historic',
        'height',
        'weight'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'historic' => 'string',
        'height' => 'integer',
        'weight' => 'float'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'historic' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
	
	
	public static function getPatientByUser($user_id){
		
		$patient = DB::select('SELECT * FROM patients WHERE user_id = '.$user_id.'');
		return $patient[0];
		
	}
}
