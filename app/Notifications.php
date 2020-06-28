<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    protected $fillable = [        
        'user_id',
        'description'
    ];

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }
}
