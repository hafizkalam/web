<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class MejaController extends Controller
{
    public function show()
    {
        $data['user'] = Auth::user();
        $data['data'] = Meja::get();
        return view('admin.meja', $data);
    }

    public function create(Request $request)
    {

        $data = new Meja;
        $data->no_meja = $request->no_meja;
        $data->save();
        return view('admin.meja', $data);

    }

    public function generate($id)
    {
        $data = Meja::findOrFail($id);
        $qrcode = QrCode::size(300)->generate("http://127.0.0.1:8000/"."$data->no_meja");
        return view('admin.qrcode', compact('qrcode'));
    }
}
