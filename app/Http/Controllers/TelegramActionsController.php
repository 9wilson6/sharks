<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramActionsController extends Controller {
    public function getme(){
        $response = Telegram::getMe();
        $botId = $response->getId();
        $firstName = $response->getFirstName();
        $username = $response->getUsername();
        return $response;
    }
}
