<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActivationEmail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Registered successfully')
            ->markdown('emails.pending')
            ->with([
                'activationUrl' => route('activation.verify', ['token' => $this->user->activation_token]),
            ]);
    }
}
