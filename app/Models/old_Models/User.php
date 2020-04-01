<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Permission;


class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'lastname',  'contact', 'dni', 'birthdate', 'avatar', 'sex', 'blood', 'information', 'deleted', 'sip_name', 'sip_id', 'sip_pass', 'role_id', 'rol_perms'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
        // Campos ocultos, encriptados
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //'email_verified_at' => 'datetime',
        'id' => 'integer'
    ];


    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function analytics() {
        return $this->hasMany("App\Analytic");
    }

    public function calls() {
        return $this->hasMany("App\Call");
    }

    public function events() {
        return $this->hasMany("App\Event");
    }

    public function logs() {
        return $this->hasMany("App\Log");
    }

    public function medicines() {
        return $this->hasMany("App\Medicine");
    }

    public function messages() {
        return $this->hasMany("App\Message");
    }

    public function notes() {
        return $this->hasMany("App\Note");
    }

    public function patients() {
        return $this->hasMany("App\Patient");
    }
    
    public function permissions() {
        return $this->hasManyThrough('App\Role', 'App\RolPermission');
    }

    public function protocols() {
        return $this->hasMany("App\Protocol");
    }

    public function relations() {
        return $this->hasMany("App\Relation");
    }

    public function reports() {
        return $this->hasMany("App\Report");
    }

    public function role_id() {
        return $this->belongsTo("App\Role");
    }

    public function staff() {
        return $this->hasMany("App\Staff");
    }

    public function warning_reads() {
        return $this->hasMany("App\Warning_Read");
    }

    public function warnings() {
        return $this->hasMany("App\Warning");
    }

    public static function getPermissions(int $userId, int $valuePermission = null) {
        \DB::enableQueryLog();
        $results = self::select('roles_permissions.permission_id')->join('roles_permissions', 'roles_permissions.role_id', 'users.role_id')->where('users.id', $userId);
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
