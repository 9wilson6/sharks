<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TutorWithdrawal extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $user;
    protected $withdraw;
    public function __construct($user, $withdraw)
    {
        $this->user = $user;
        $this->withdraw = $withdraw;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.back.tutorwithdraw')
                    ->with('withdraw', $this->withdraw)
                    ->with('user', $this->user)
                    ->subject('Withdrawal Started');
    }
}
