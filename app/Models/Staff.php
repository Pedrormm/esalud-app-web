<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

/**
 * Class Staff
 * @package App\Models
 * @version April 1, 2020, 8:11 pm UTC
 *
 * @property \App\Models\User user
 * @property \Illuminate\Database\Eloquent\Collection specialitiesStaffs
 * @property string historic
 * @property integer user_id
 * @property integer branch
 * @property string shift
 * @property string office
 * @property string room
 * @property string h_phone
 */
class Staff extends Model
{
    use SoftDeletes;

    public $table = 'staff';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'historic',
        'user_id',
        'branch',
        'shift',
        'office',
        'room',
        'h_phone'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'historic' => 'string',
        'user_id' => 'integer',
        'branch' => 'integer',
        'shift' => 'string',
        'office' => 'string',
        'room' => 'string',
        'h_phone' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'branch' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function branch()
    {
        return $this->belongsTo(\App\Models\Branch::class, 'branch_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function specialitiesStaffs()
    {
        return $this->hasMany(\App\Models\SpecialitiesStaff::class, 'staff_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function staffSchedule()
    {
        return $this->hasMany(\App\Models\StaffSchedule::class, 'staff_id');
    }

    public static function getUserStaffById($user_id){
        	
		$staff = DB::select('SELECT * FROM staff WHERE user_id = '.$user_id.'');
        return $staff[0];
 
    }

    public function scopeUserParent($query) {
        return $query->join('users', 'users.id', 'staff.user_id');
    }
}
