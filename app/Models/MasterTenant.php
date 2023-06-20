<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterTenant extends Model
{
    use HasFactory;
    public $fillable = ["name_menu", "harga_menu", "foto_menu", "desc_menu"];
}
