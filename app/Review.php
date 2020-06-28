<?php

namespace App;

use muyaedward\Rateable\Rating;

class Review extends Rating
{
    public $table = 'ratings';

    public $fillable = ['rating', 'order_id', 'comments', 'recommend', 'publish'];

    public function order() {
        return $this->belongsTo('App\Orders', 'order_id');
    }

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }
}
