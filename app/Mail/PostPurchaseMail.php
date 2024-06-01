<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostPurchaseMail extends Mailable
{
    use Queueable, SerializesModels;

    public $customerName;
    public $recipientEmail;

    /**
     * Create a new message instance.
     *
     * @param  string  $customerName
     * @param  string  $recipientEmail
     * @return void
     */
    public function __construct($customerName, $recipientEmail )
    {
        $this->customerName = $customerName;
        $this->recipientEmail = $recipientEmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.postpurchase')->with([
                        'customerName' => $this->customerName,
                        'email' => $this->recipientEmail
                    ])->subject('Purchase Confirmation from DigitalStore');
    }
}
