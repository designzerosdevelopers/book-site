<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetLink extends Mailable
{
    use Queueable, SerializesModels;

    public $resetlink;

    public function __construct($url)
    {

        $this->resetlink = $url;
    }

    public function build()
    {
        return $this->view('emails.password_reset')->with([
                        'resetUrl' => $this->resetlink
                    ])->subject('Purchase Confirmation from DigitalStore');
    }
}
