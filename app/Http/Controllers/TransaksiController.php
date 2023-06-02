<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function show()
    {
        $data['data'] = Transaksi::get();
        return view('admin.transaksi', $data);
    }
}
