<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetLink extends Mailable
{
    use Queueable, SerializesModels;

    public $resetlink;

    /**
     * Create a new message instance.
     *
     * @param  string  $customerName
     * @param  string  $recipientEmail
     * @return void
     */
    public function __construct($url)
    {
        $this->resetlink = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.password_reset')->with([
                        'resetUrl' => $this->resetlink
                    ])->subject('Purchase Confirmation from DigitalStore');
    }
}
