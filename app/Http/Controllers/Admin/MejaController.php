<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Meja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class MejaController extends Controller
{
    public function show(Request $request)
    {
        // dd($request->session()->get('nofaktur'));
        $data['user'] = Auth::user();
        $data['meja'] = Meja::get();
        $data['jsTambahan'] = "$('#meja').addClass('active') ;";

        return view('admin.meja', $data);
    }

    public function create(Request $request)
    {

        $meja = new Meja;
        $meja->no_meja = $request->no_meja;
        $meja->save();
        return redirect('meja');
    }

    public function generate($id)
    {
        $data = Meja::findOrFail($id);
        $encryptedId = encrypt(env("HAFIS_SECRET") . "/-" . $id . "-" . env("HAFIS_SECRET_ID"));
        $qrcode = QrCode::size(300)->generate("http://njenggrik.biz.id/viewmenu/" . "$encryptedId");
        return view('admin.qrcode', compact('qrcode'));
    }

    public function destory($id)
    {
        Meja::where('id', $id)->delete();

        return redirect('meja');
    }
}
