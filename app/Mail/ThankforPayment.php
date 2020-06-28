<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ThankforPayment extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $bidetails;

    public function __construct($bidetails)
    {
        $this->bidetails = $bidetails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.back.thank-payment')
                    ->subject('Project successfully awarded')
                    ->with('bidetails', $this->bidetails);
    }
}
