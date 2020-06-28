<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paypal extends Model
{
    protected $fillable = [
    	'payment_id',
    	'order_id',
    	'tutorid',
    	'amount'
    ];
}