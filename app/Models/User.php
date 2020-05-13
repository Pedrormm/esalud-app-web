<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class User
 * @package App\Models
 * @version April 1, 2020, 8:30 pm UTC
 *
 * @property \App\Models\Role role
 * @property \Illuminate\Database\Eloquent\Collection analytics
 * @property \Illuminate\Database\Eloquent\Collection analytic1s
 * @property \Illuminate\Database\Eloquent\Collection calls
 * @property \Illuminate\Database\Eloquent\Collection call2s
 * @property \Illuminate\Database\Eloquent\Collection chats
 * @property \Illuminate\Database\Eloquent\Collection chat3s
 * @property \Illuminate\Database\Eloquent\Collection events
 * @property \Illuminate\Database\Eloquent\Collection event4s
 * @property \Illuminate\Database\Eloquent\Collection logs
 * @property \Illuminate\Database\Eloquent\Collection medicines
 * @property \Illuminate\Database\Eloquent\Collection medicine5s
 * @property \Illuminate\Database\Eloquent\Collection messages
 * @property \Illuminate\Database\Eloquent\Collection message6s
 * @property \Illuminate\Database\Eloquent\Collection notes
 * @property \Illuminate\Database\Eloquent\Collection patients
 * @property \Illuminate\Database\Eloquent\Collection patientsDoctors
 * @property \Illuminate\Database\Eloquent\Collection patientsDoctor7s
 * @property \Illuminate\Database\Eloquent\Collection protocols
 * @property \Illuminate\Database\Eloquent\Collection protocol8s
 * @property \Illuminate\Database\Eloquent\Collection role9s
 * @property \Illuminate\Database\Eloquent\Collection staff
 * @property \Illuminate\Database\Eloquent\Collection warnings
 * @property \Illuminate\Database\Eloquent\Collection warning10s
 * @property \Illuminate\Database\Eloquent\Collection warningsReads
 * @property string dni
 * @property string password
 * @property string name
 * @property string lastname
 * @property string address
 * @property string city
 * @property string country
 * @property integer zipcode
 * @property string email
 * @property string phone
 * @property string birthdate
 * @property string avatar
 * @property string sex
 * @property string blood
 * @property integer role_id
 * @property string remember_token
 */
class User extends Model
{
    use SoftDeletes;

    public $table = 'users';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'dni',
        'password',
        'name',
        'lastname',
        'address',
        'city',
        'country',
        'zipcode',
        'email',
        'phone',
        'birthdate',
        'avatar',
        'sex',
        'blood',
        'role_id',
        'remember_token'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'dni' => 'string',
        'password' => 'string',
        'name' => 'string',
        'lastname' => 'string',
        'address' => 'string',
        'city' => 'string',
        'country' => 'string',
        'zipcode' => 'integer',
        'email' => 'string',
        'phone' => 'string',
        'birthdate' => 'date',
        'avatar' => 'string',
        'sex' => 'string',
        'blood' => 'string',
        'role_id' => 'integer',
        'remember_token' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'dni' => 'required',
        'password' => 'required',
        'birthdate' => 'required',
        'sex' => 'required',
        'blood' => 'required',
        'role_id' => 'required',
        'remember_token' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function role()
    {
        return $this->belongsTo(\App\Models\Role::class, 'role_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function analytics()
    {
        return $this->hasMany(\App\Models\Analytic::class, 'user_id_creator');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function analytic1s()
    {
        return $this->hasMany(\App\Models\Analytic::class, 'user_id_user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function calls()
    {
        return $this->hasMany(\App\Models\Call::class, 'user_id_caller');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function call2s()
    {
        return $this->hasMany(\App\Models\Call::class, 'user_id_receptor');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function chats()
    {
        return $this->hasMany(\App\Models\Chat::class, 'user_id_user_A');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function chat3s()
    {
        return $this->hasMany(\App\Models\Chat::class, 'user_id_user_B');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function events()
    {
        return $this->hasMany(\App\Models\Event::class, 'user_id_doctor');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function event4s()
    {
        return $this->hasMany(\App\Models\Event::class, 'user_id_patient');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function logs()
    {
        return $this->hasMany(\App\Models\Log::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function medicines()
    {
        return $this->hasMany(\App\Models\Medicine::class, 'user_id_doctor');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function medicine5s()
    {
        return $this->hasMany(\App\Models\Medicine::class, 'user_id_patient');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function messages()
    {
        return $this->hasMany(\App\Models\Message::class, 'user_id_from');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function message6s()
    {
        return $this->hasMany(\App\Models\Message::class, 'user_id_to');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function notes()
    {
        return $this->hasMany(\App\Models\Note::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function patients()
    {
        return $this->hasMany(\App\Models\Patient::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function patientsDoctors()
    {
        return $this->hasMany(\App\Models\PatientsDoctor::class, 'user_id_doctor');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function patientsDoctor7s()
    {
        return $this->hasMany(\App\Models\PatientsDoctor::class, 'user_id_patient');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function protocols()
    {
        return $this->hasMany(\App\Models\Protocol::class, 'user_id_creator');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function protocol8s()
    {
        return $this->hasMany(\App\Models\Protocol::class, 'user_id_user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function role9s()
    {
        return $this->hasMany(\App\Models\Role::class, 'user_id_creator');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function staff()
    {
        return $this->hasMany(\App\Models\Staff::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function warnings()
    {
        return $this->hasMany(\App\Models\Warning::class, 'user_id_creator');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function warning10s()
    {
        return $this->hasMany(\App\Models\Warning::class, 'user_id_patient');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function warningsReads()
    {
        return $this->hasMany(\App\Models\WarningsRead::class, 'user_id');
    }

    public static function getPermissions(int $userId, int $valuePermission = null) {
        //\DB::enableQueryLog();
        $results = self::select('roles_permissions.permission_id')->join('roles_permissions', 'roles_permissions.role_id', 'users.role_id')
        ->where('users.id', $userId);
        if(!is_null($valuePermission))
            $results = $results->where('roles_permissions.value', $valuePermission);
        $permissions = $results->get();
        //dd(\DB::getQueryLog());
        return $permissions->pluck('permission_id')->toArray();
    }

    public function scopeActive($query) {
        return $query->where('disabled', 0);
        // This allows to call User::active()->all();
    }
    
    public function scopeActiveUsers($query) {
        return $query->whereNotNull('role_id');
    }
}