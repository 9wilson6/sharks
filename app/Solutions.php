<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solutions extends Model
{
    protected $fillable = [
        'order_id',
        'tutor_id',
        'filename',
        'original_filename'
    ];

    public function order() {
        return $this->belongsTo('App\Orders');
    }

    public function tutor() {
        return $this->belongsTo('App\User', 'tutor_id');
    }
}