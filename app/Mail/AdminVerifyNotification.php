<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminVerifyNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $tutor;
    public function __construct($tutor)
    {
        $this->tutor = $tutor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         return $this->markdown('emails.back.verify.adminverify')
                    ->subject('Tutor account verified')
                    ->with('tutor', $this->tutor);
    }
}
