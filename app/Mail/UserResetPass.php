<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserResetPass extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $user;
    protected $pass;
    public function __construct($user, $pass) {
        $this->user = $user;
        $this->pass = $pass;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->markdown('emails.back.userpassreset')
                    ->with('user', $this->user)
                    ->with('pass', $this->pass)
                    ->subject('Password reset ' . defaultsettings()['sitename']);
    }
}
