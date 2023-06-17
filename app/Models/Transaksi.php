<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    public $fillable = ["pesanan", "harga", "tgl_pembayaran", "tipe_pembayaran", "no_meja"];
}
