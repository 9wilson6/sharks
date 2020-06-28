<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfileController extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'about_me',
        'payment_method',
        'skills',
        'highest_level',
        'major', 
        'verified',
        'verified_by',
        'membership'
    ];    
    
    public function user(){
        return $this->belongsTo('App\User');
    }
}
