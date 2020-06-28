<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bids extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'tutor_id',
        'amount'
    ];

    public function tutor(){
    	return $this->belongsTo('App\User', 'tutor_id');
    }

    public function order(){
    	return $this->belongsTo('App\Orders', 'order_id');
    }
}