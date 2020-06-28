<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DisputeOrderstudent extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $orderdetails;
    public function __construct($orderdetails)
    {
        $this->orderdetails = $orderdetails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.back.dispute-student')
                    ->with('orderdetails', $this->orderdetails)
                    ->subject('You disputed order #'.$this->orderdetails->id);
    }
}
