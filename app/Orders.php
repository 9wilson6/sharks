<?php
namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject',
        'title',
        'homedate',
        'level',
        'numpages',
        'format',
        'description',
        'agreed_amount',
        'status',
        'student_id',
        'tutor_id',
        'date_awarded',
        'date_completed',
        'budget'
    ];

    public function setHomedateAttribute( $value ) {
        $this->attributes['homedate'] = (new Carbon($value));
    }

    public function bids() {
        return $this->hasMany('App\Bids', 'order_id');
    }

    public function student() {
        return $this->belongsTo('App\User', 'student_id');
    }

    public function tutor() {
        return $this->belongsTo('App\User', 'tutor_id');
    }    

    public function uploads() {
        return $this->hasMany('App\OrderUploads', 'order_id');
    }
    
    public function solutions() {
        return $this->hasMany('App\Solutions', 'order_id');
    }

    public function revisions() {
        return $this->hasMany('App\Revisions', 'order_id');
    }

    public function attachments() {
        return $this->hasMany('App\OrderAttachments', 'order_id');
    }

    public function dispute() {
        return $this->hasOne('App\DisputeOrders', 'order_id');
    }

    public function refund() {
        return $this->hasOne('App\Refund', 'order_id');
    }
	
	public function ratings() {
        return $this->hasMany('muyaedward\Rateable\Rating', 'order_id');
    }

    public function studentpayments() {
        return $this->hasMany('App\StudentPayments', 'order_id');
    }

    public function studentwithdrawals() {
        return $this->hasMany('App\StudentWithdrawals', 'order_id');
    }

    public function tutorpayments() {
        return $this->hasMany('App\TutorPayments', 'order_id');
    }

    public function tutorwithdrawals() {
        return $this->hasMany('App\TutorWithdrawals', 'order_id');
    }

    public function manualrelease() {
        return $this->hasOne('App\ManualRelease', 'order_id');
    }
}