<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FavoriteScholar extends Model
{
    protected $fillable = ['student_id', 'tutor_id'];
}
