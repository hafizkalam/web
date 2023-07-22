<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public $timestamps = false;

    function menu()
    {
        return $this->belongsTo(Menu::class, 'id_menu', 'id');
    }
}
