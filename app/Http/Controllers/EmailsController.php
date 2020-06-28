<?php

namespace App\Http\Controllers;

use App\User;
use Notification;
use Postmark\Inbound;
use Illuminate\Http\Request;
use App\Notifications\NewEmail;


class EmailsController extends Controller
{
    public function postmark(Request $request) {
        $inbound = new Inbound(file_get_contents('php://input'));
        //send this to slack and telegram as a notification
        $admins = User::role('superadmin')->get();
        //Notification::send($admins, new NewEmail($inbound));
    }
}
