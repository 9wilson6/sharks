<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderAttachments extends Model
{
    protected $fillable = [
        'filename',
        'original_filename',
        'order_id'
    ];

    public function order() {
        return $this->belongsTo('App\Orders', 'order_id');
    }
}
