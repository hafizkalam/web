<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public $timestamps = false;

    function detail()
    {
        return $this->hasMany(TransaksiDetail::class, 'no_transaksi', 'no_transaksi');
    }
}
