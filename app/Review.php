<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'review';

    public function travel()
    {
        return $this->hasOne(Travel::class,'id','travel_id');
    }
}
