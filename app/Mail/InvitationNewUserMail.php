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
        return $this->subject(config('app.name')." ".\Lang::get('messages.has_invited_you_to_create_a_new_account_with_the_DNI')." ". $this->dni)
                    ->markdown('mail.createUser', ['token' => $this->token, 'dni' => $this->dni]);
    }
}
