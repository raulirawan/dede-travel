<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    protected $table = 'travel';

    public function paketTravel()
    {
        return $this->hasOne(PaketTravel::class,'id','paket_travel_id');
    }
}
