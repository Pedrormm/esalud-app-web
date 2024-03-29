<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    private $token;
    private $name;
    private $language;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $token, string $name, string $language)
    {
        $this->token = $token;
        $this->name = $name;
        $this->language = $language;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // App::setLocale('es');
        app()->setLocale($this->language);
        return $this->subject($this->name .", ".\Lang::get('messages.a_password_changed_has_been_requested_for_a_user_in')." ". config('app.name'))
                    ->markdown('mail.forgot', ['token' => $this->token, 'name' => $this->name, 'language' => $this->language]);
    }
}
