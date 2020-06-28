<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAttachments extends Model
{
    protected $fillable = [
        'filename',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }
}
