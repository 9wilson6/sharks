<?php

namespace App\Broadcasting;

use App\User;
use App\Orders;

class NewBidsChannel
{
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     *
     * @param  \App\User  $user
     * @return array|bool
     */
    public function join(User $user, Orders $orderid) {
        \Log::info($this->orderid);
        return $user->id === $orderid->student_id;
    }
}
