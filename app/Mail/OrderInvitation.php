<?php

namespace App\Mail;

use App\User;
use App\Orders;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderInvitation extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $user;
    protected $order;


    public function __construct(Orders $order, User $user) {
        $this->user = $user;
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.back.orderinvite')
                    ->subject('You have been invited to apply for order #'.$this->order->id)
                    ->with([
                        'user' => $this->user,
                        'order' => $this->order,
                    ]);
    }
}
