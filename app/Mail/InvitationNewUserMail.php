<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvitationNewUserMail extends Mailable
{
    use Queueable, SerializesModels;

    private $token;
    private $dni;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $token, string $dni)
    {
        $this->token = $token;
        $this->dni = $dni;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Se le ha invitado a crear una nueva cuenta en mi Hospital Virtual con el dni ". $this->dni)
                    ->markdown('mail.createUser', ['token' => $this->token, 'dni' => $this->dni]);
    }
}
