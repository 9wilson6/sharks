<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model {
    protected $fillable = [
        'enabletelegram',
        'telegram_notify_level',
        'telegramchatid',
        'sitename',
        'siteemail',
        'siteurl',
        'release_grace',
        'levelone',
        'leveltwo',
        'levelthree',
        'levelfour'        
    ];
}
