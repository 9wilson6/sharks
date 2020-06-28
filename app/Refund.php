<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    protected $fillable = [
        'order_id',
        'description',
        'refund_agent',
        'refund_agent_id'
    ];

    public function order() {
        return $this->belongsTo('App\Orders', 'order_id');
    }
}
