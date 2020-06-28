<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderPayments extends Model
{
    protected $fillable = ['paid_from', 'paid_to', 'description', 'amount', 'order_amount', 'order_no'];
}
