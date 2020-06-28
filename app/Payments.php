<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    protected $fillable = ['paid_from', 'paid_to', 'description', 'amount', 'fee', 'order_amount', 'order_no'];
}
