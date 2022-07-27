<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaketTravel extends Model
{
    protected $table = 'paket_travel';

    public function travel()
    {
        return $this->hasMany(Travel::class,'paket_travel_id','id');
    }
}
