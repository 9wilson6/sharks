<?php
namespace App;

use muyaedward\Rateable\Rateable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Muyaedward\Messenger\Traits\Messagable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasRoles;
    use Rateable;
    use Messagable;
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $appends = [
    //     'tutorbalance',
    //     'studentbalance',
    //     'tutorawarded',
    //     'tutordisputed'
    // ];


    protected $fillable = [
        'name',
        'email',
        'avatar',
        'password',
        'fullname',
        'status'
    ];

    protected $guard_name = 'web';

    public function routeNotificationForSlack($notification) {
        return 'https://hooks.slack.com/services/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';
    }

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function bids(){
        return $this->hasMany('App\Bids', 'tutor_id');
    }

    public function orderawards(){
        return $this->hasMany('App\Orders', 'tutor_id');
    }

    public function disputedorders(){
        return $this->hasMany('App\DisputeOrders', 'tutor_id');
    }
    
    public function orders(){
        return $this->hasMany('App\Orders', 'student_id');
    }

    public function studentpayments(){
        return $this->hasMany('App\StudentPayments', 'student_id');
    }

    public function studentwithdrawal(){
        return $this->hasMany('App\StudentWithdrawals', 'student_id');
    }

    public function tutorpayments(){
        return $this->hasMany('App\TutorPayments', 'tutor_id');
    }

    public function tutorwithdrawals(){
        return $this->hasMany('App\TutorWithdrawals', 'tutor_id');
    }

    public function profile(){
        return $this->hasOne('App\UserProfileController');
    }

    public function notifications(){
        return $this->hasMany('App\Notifications');
    }

    public function attachments(){
        return $this->hasMany('App\UserAttachments');
    }

    public function getImageAttribute() {
        return $this->avatar;
    }

    // public function getTutorbalanceAttribute(){
    //     $payments = $this->tutorpayments->sum('amount');
    //     $withdrawals = $this->tutorwithdrawals->sum('amount');
    //     return number_format($payments - $withdrawals, 2);
    // }

    // public function getStudentbalanceAttribute(){
    //     $payments = $this->studentpayments->sum('amount');
    //     $withdrawals = $this->studentwithdrawal->sum('amount');
    //     return number_format($payments - $withdrawals, 2);
    // }

    // public function getTutorawardedAttribute(){
    //     return $this->orderawards->count();
    // }

    // public function getTutordisputedAttribute(){        
    //     return $this->disputedorders->count();
    // }
}