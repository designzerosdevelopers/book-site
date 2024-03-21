<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ExampleMail extends Mailable
{
    use Queueable, SerializesModels;

    public $customerName;
    public $randomPassword;
    public $recipientEmail;

    /**
     * Create a new message instance.
     *
     * @param  string  $customerName
     * @param  string  $randomPassword
     * @param  string  $recipientEmail
     * @return void
     */
    public function __construct($customerName, $randomPassword, $recipientEmail )
    {
        $this->customerName = $customerName;
        $this->randomPassword = $randomPassword;
        $this->recipientEmail = $recipientEmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.example')->with([
                        'customerName' => $this->customerName,
                        'randomPassword' => $this->randomPassword,
                        'email' => $this->recipientEmail
                    ]);
    }
}
