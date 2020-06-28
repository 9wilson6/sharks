<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DisputeOrders extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [        
        'order_id',
        'tutor_id',
        'reason',
    ];

    public function order() {
        return $this->belongsTo('App\Orders', 'order_id');
    }

    public function refund() {
        return $this->hasOne('App\Refund', 'order_id');
    }

}
