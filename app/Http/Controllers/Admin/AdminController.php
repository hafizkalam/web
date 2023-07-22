<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterTenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function notif()
    {
        $user = Auth::user();
        $data['total'] = 0;
        // Check if the user is authenticated and has unread notifications
        if ($user && $user->unreadNotifications) {
            // Access the unread notifications
            $data['total'] = count($user->unreadNotifications);
        }
        return  view("admin.notif", $data);
    }
    public function show(Request $request)
    {
        $level = Auth::user()->level;
        $idTenant = Auth::user()->id;
        $tenant = MasterTenant::where("user_id", $idTenant)->first();
        $filter = $request->all();
        if (count($filter) > 0) {
            $tgl = $filter['tahun'] . '-' .  $filter['bulan'] . '-01';
            $periode = $filter['tahun'] . '-' .  $filter['bulan'];
            $tgl_akhir = date("t", strtotime($tgl));
        } else {
            $periode = date('Y-m');
            $tgl_akhir = date("d");
        }

        // $periode = date('Y-m');
        // $tgl_akhir = date("d");


        for ($i = 1; $i <= $tgl_akhir; $i++) {
            $tgl_filter = date("Y-m-d", strtotime($periode . "-$i"));
            if ($level == 2) {

                $transaksi = DB::table('transaksis')->join("transaksi_details", "transaksi_details.no_transaksi", "=", "transaksis.no_transaksi")
                    ->join("menus", "menus.id", "=", "transaksi_details.id_menu")
                    ->select(DB::raw('ifnull(sum(transaksi_details.total),0) as total'))
                    ->where('tgl_transaksi', $tgl_filter)
                    ->where('status_pembayaran', 1)
                    ->where("menus.master_tenants_id", $tenant->id)->first();
            } else {
                $transaksi = DB::table('transaksis')
                    ->select(DB::raw('ifnull(sum(total),0) as total'))
                    ->where('status_pembayaran', 1)
                    ->where('tgl_transaksi', $tgl_filter)->first();
            }
            $tanggal[] = $i;
            $penjualan[] = intval($transaksi->total);
        }
        $data['total'] = $penjualan;
        $data['tanggal'] = $tanggal;
        $data['jsTambahan'] = "$('#dashboard').addClass('active') ;";

        return view('admin.dashboard', $data);
    }
}
