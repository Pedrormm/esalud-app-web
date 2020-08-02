<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeNewUserMail extends Mailable
{
    use Queueable, SerializesModels;

    private $dni;
    private $name;
    private $lastname;
    private $sex;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $dni, string $name, string $lastname, string $sex)
    {
        $this->dni = $dni;
        $this->name = $name;
        $this->lastname = $lastname;
        $this->sex = $sex;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $welcome = $this->sex == "male" ? "bienvenido" : "bienvenida";
        $publicIp = \IPS::getPublicIp();
        return $this->subject($this->name. " ".$this->lastname. ", ". $welcome ." a ". config('app.name'))
                    ->markdown('mail.welcomeUser', ['dni' => $this->dni, 'name' => $this->name, 
                    'lastname' => $this->lastname, 'publicIp' => $publicIp]);
    }
}
