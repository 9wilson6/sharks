<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RequestRevision extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $revision;
    public function __construct($revision)
    {
        $this->revision = $revision;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

     public function build() {
        return $this->markdown('emails.back.request-revision')
                ->with('revision', $this->revision)
                ->subject('Revision request for order #'.$this->revision->order_id);
    }
}
