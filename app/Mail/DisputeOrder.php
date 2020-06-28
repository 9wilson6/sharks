<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DisputeOrder extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $dispute;
    protected $orderdetails;

    public function __construct($dispute, $orderdetails)
    {
        $this->dispute = $dispute;
        $this->orderdetails = $orderdetails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.back.dispute-tutor')
                    ->with([
                        'dispute' => $this->dispute,
                        'orderdetails' => $this->orderdetails
                    ])
                    ->subject('Dispute for order #'.$this->orderdetails->id.' started by client');
    }
}