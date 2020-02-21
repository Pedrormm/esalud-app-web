<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
        'name', 'lastname',  'contact', 'dni', 'birthdate', 'avatar', 'sex', 'blood', 'information', 'deleted', 'sip_name', 'sip_id', 'sip_pass', 'rol', 'rol_perms'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        // Campos ocultos, encriptados
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //'email_verified_at' => 'datetime',
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
        return $this->hasMany("App\Permission");
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

    public function staff() {
        return $this->hasMany("App\Staff");
    }

    public function warning_reads() {
        return $this->hasMany("App\Warning_Read");
    }

    public function warnings() {
        return $this->hasMany("App\Warning");
    }

}
