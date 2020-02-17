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

    public function patients() {
        return $this->hasMany("App\Patient");
    }

    public function messages() {
        return $this->hasMany("App\Message");
    }

}
