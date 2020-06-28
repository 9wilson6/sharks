<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentPayments extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id',
        'order_id',
        'amount',
        'description',
        'payment_method',
        'transaction_id'
    ];

    public function student() {
        return $this->belongsTo('App\User', 'student_id');
    }

    public function order() {
        return $this->belongsTo('App\Orders', 'order_id');
    }
}