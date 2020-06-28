<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Revisions extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'provision',
        'instruction',
        'upload'
    ];

    public function order() {
        return $this->belongsTo('App\Orders');
    }
}
