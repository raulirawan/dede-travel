<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    protected $table = 'tiket';

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class,'transaksi_id','id');
    }
}
