<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TutorPayments extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tutor_id',
        'order_id',
        'amount',
        'description'
    ];

    public function student() {
        return $this->belongsTo('App\User', 'student_id');
    }

    public function order() {
        return $this->belongsTo('App\Orders', 'order_id');
    }
}
