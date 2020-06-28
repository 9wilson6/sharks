<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pusher extends Model
{
    protected $fillable = [
        'app_id',
        'app_key',
        'app_secret',
        'app_cluster'
    ];
}
