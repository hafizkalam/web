<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterTenant;
use App\Models\Menu;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function cetak(Request $request)
    {
        $menu = Menu::get()->toArray();
        foreach ($menu as $value) {
            $data['menu'][$value['id']] = $value;
        }
        $dataTenant = MasterTenant::get()->toArray();
        foreach ($dataTenant as $value) {
            $nama_tenant[$value['id']] = $value['name'];
        }

        $data['nama_tenant'] = $nama_tenant;
        $data['data'] = $request->session()->get('data');
        $data['filter'] = $request->session()->get('filter');

        $pdf = Pdf::loadView('admin.print', $data)->setPaper('a4', 'landscape');
        // return $pdf->stream();
        return $pdf->download(rand() . 'transaksi.pdf');
    }
    public function show(Request $request)
    {

        $user = Auth::user();

        // Check if the user is authenticated and has unread notifications
        if ($user && $user->unreadNotifications) {
            // Access the unread notifications
            $unreadNotifications = $user->unreadNotifications;

            // Perform actions with the unread notifications
            foreach ($unreadNotifications as $notification) {
                $notification->markAsRead();
            }
        }
        $idTenant = Auth::user()->id;
        $tenant = MasterTenant::where("user_id", $idTenant)->first();
        $dataTenant = MasterTenant::get()->toArray();
        foreach ($dataTenant as $value) {
            $nama_tenant[$value['id']] = $value['name'];
        }

        $data['nama_tenant'] = $nama_tenant;

        $data['data'] = Transaksi::with(['detail.menu'])->whereHas('detail.menu', function ($query) use ($tenant) {
            if (Auth::user()->level == 2) {

                $query->where("master_tenants_id", $tenant->id);
            }
        });
        $data['tenant'] = $tenant;
        $filter = $request->all();
        if (count($filter) > 0) {
            $data['data'] = $data['data']->whereBetween("tgl_transaksi", [$filter['awal'], $filter['akhir']]);
            if ($filter['status_pembayaran'] != "") {
                $data['data'] = $data['data']->where("status_pembayaran", $filter['status_pembayaran']);
            }

            if ($filter['cara_pembayaran'] != "") {
                $data['data'] = $data['data']->where("cara_pembayaran", $filter['cara_pembayaran']);
            }
            if (Auth::user()->level == '1' || Auth::user()->level == '3') {
                if ($filter['filter-tenant'] != "") {

                    $idFilterTenant = $filter['filter-tenant'];
                    $data['data'] = $data['data']->whereHas('detail.menu', function ($query) use ($idFilterTenant) {
                        $query->where("master_tenants_id", $idFilterTenant);
                    });
                    $data['id_filter_tenant'] = $idFilterTenant;
                }
            }
        }
        $data['data'] = $data['data']->get()->toArray();

        $menu = Menu::get()->toArray();
        foreach ($menu as $value) {
            $data['menu'][$value['id']] = $value;
        }
        $data['jsTambahan'] = "$('#transaksi').addClass('active') ;";
        $request->session()->put('data', $data['data']);
        $request->session()->put('filter', $filter);

        return view('admin.transaksi', $data);
    }

    function otorisasi(Request $request)
    {
        $data = $request->all();
        Transaksi::where("no_transaksi", $data['faktur'])->update(["status_pembayaran" => $data['acc']]);
        echo json_encode("oke");
    }
}
