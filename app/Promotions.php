<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotions extends Model
{
    protected $fillable = [
        'email',
        'first',
        'second',
        'third'
    ];
}
