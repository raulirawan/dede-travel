<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';

    public function review()
    {
        return $this->hasOne(Review::class,'id','review_id');
    }

    public function travel()
    {
        return $this->belongsTo(Travel::class,'travel_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function tourGuide()
    {
        return $this->belongsTo(User::class,'tour_guide_id','id');
    }

    public function tiket()
    {
        return $this->hasMany(Tiket::class,'transaksi_id','id');
    }
}
