<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManualRelease extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [        
        'order_id',
        'released',
    ];

    public function order() {
        return $this->belongsTo('App\Orders', 'order_id');
    }
}
