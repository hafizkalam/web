<?php

namespace App\Library\Services;

use App\Events\NewMessage;
use App\Models\User;
use App\Notifications\NewOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class Pesanan
{
    static function GetFakturTmp(Request $request)
    {

        // $request->session()->forget('fakturs');

        $noFaktur = $request->session()->get('fakturs');

        if ($noFaktur == "") {
            $vaFaktur = DB::table("fakturs")->where('kode', 'FakturTmp')->first();
            $noFaktur = $vaFaktur->keterangan + 1;
            $vaFaktur = DB::table("fakturs")->where('kode', 'FakturTmp')->update(["keterangan" => $noFaktur]);
            $noFaktur = "MLG-" . date("Ymd") . "-" . str_pad($noFaktur, 10, "0", STR_PAD_LEFT);
            $request->session()->put('fakturs', $noFaktur);
        }
        return $noFaktur;
    }
    static function GetFaktur()
    {
        $vaFaktur = DB::table("fakturs")->where('kode', 'Faktur')->first();
        $noFaktur = $vaFaktur->keterangan + 1;
        $vaFaktur = DB::table("fakturs")->where('kode', 'Faktur')->update(["keterangan" => $noFaktur]);
        $noFaktur = "MLG-" . date("Ymd") . "-" . str_pad($noFaktur, 10, "0", STR_PAD_LEFT);

        return $noFaktur;
    }
    static function Notif($vaId)
    {
        $users = User::whereIn("id", $vaId)->orWhere('level', 3)->orWhere('level', 1)->get();
        foreach ($users as $user) {
            $user->notify(new NewOrder(["Order Pesanan"]));
        }
        event(new NewMessage('hello world'));
    }
}
