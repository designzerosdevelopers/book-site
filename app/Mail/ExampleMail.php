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
    public $password_forget_token;

    /**
     * Create a new message instance.
     *
     * @param  string  $customerName
     * @param  string  $randomPassword
     * @param  string  $recipientEmail
     * @param  string  $password_forget_token
     * @return void
     */
    public function __construct($customerName, $randomPassword, $recipientEmail, $password_forget_token)
    {
        $this->customerName = $customerName;
        $this->randomPassword = $randomPassword;
        $this->recipientEmail = $recipientEmail; 
        $this->password_forget_token = $password_forget_token; 
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
                        'email' => $this->recipientEmail,
                        'token' => $this->password_forget_token
                    ]);
    }
}
