<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ManualReleaseRequest extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $order;
    protected $sendto;

    public function __construct($order, $sendto)
    {
        $this->order = $order;
        $this->sendto = $sendto;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.back.manualrelease-request')
                    ->with('sendto', $this->sendto)
                    ->with('order', $this->order)
                    ->subject('Manual release for order #'.$this->order->id.' requested');
    }
}
