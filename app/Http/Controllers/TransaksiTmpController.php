<?php

namespace App\Http\Controllers;

use App\Library\Services\Pesanan;
use App\Mail\SendEmail;
use App\Models\MasterTenant;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\TransaksiTmp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Session\Session;

class TransaksiTmpController extends Controller
{
    function tambahpesanan(Request $request)
    {
        $data = $request->all();
        TransaksiTmp::updateOrCreate(['no_transaksi' => $data['no_transaksi'], 'id_menu' => $data['id_menu']], $data);
        echo json_encode("oke");
    }

    function deletepesanan(Request $request)
    {
        $data = $request->all();
        // print_r($data);
        TransaksiTmp::where(['no_transaksi' => $data['no_transaksi'], 'id_menu' => $data['id_menu']])->delete();
        echo json_encode("oke");
    }

    function order(Request $request, $faktur = '')
    {
        $data['nama_pemesanan'] = $request->session()->get('nama_pemesanan');
        $data['email_pemesanan'] = $request->session()->get('email_pemesanan');
        $data['telp_pemesanan'] = $request->session()->get('telp_pemesanan');
        if ($faktur == '') {
            $data['cara_pembayaran'] = 'offline';
            $data['noFaktur'] = $request->session()->get('fakturs');
            $noMeja = $request->session()->get('no_meja');
            $data['no_meja'] = $noMeja;
            $faktur = Pesanan::GetFaktur();
            $tmp = TransaksiTmp::with(['menu'])->where('no_transaksi', $data['noFaktur'])->get()->toArray();
            $total = 0;
            $tenant = MasterTenant::get()->toArray();
            foreach ($tenant as $key => $value) {
                $vaTenant[$value['id']] = $value['user_id'];
            }
            $vaUser = [];
            foreach ($tmp as $value) {
                $value['no_transaksi'] = $faktur;
                $total += $value['qty'] * $value['menu']['harga'];
                $value['total'] = $value['qty'] * $value['menu']['harga'];
                TransaksiDetail::create($value);
                $vaUser[] = $vaTenant[$value['menu']['master_tenants_id']];
            }
            $vaTransaksi = array(
                "no_transaksi" => $faktur,
                "no_transaksi_tmp" => $data['noFaktur'],
                "no_meja" => $noMeja,
                "nama_pemesan" => $data['nama_pemesanan'],
                "email_pemesan" => $data['email_pemesanan'],
                "telp_pemesan" => $data['telp_pemesanan'],
                "tgl_transaksi" => date("Y-m-d"),
                "cara_pembayaran" => "Cash",
                "status_pembayaran" => "0",
                "total" => $total
            );
            Transaksi::create($vaTransaksi);
            TransaksiTmp::with(['menu'])->where('no_transaksi', $data['noFaktur'])->delete();
            $data['tmp'] = TransaksiDetail::where('no_transaksi', $faktur)->get();
            $data['faktur'] = $faktur;
            Pesanan::Notif($vaUser);
        } else {
            $data['cara_pembayaran'] = 'online';
            $noMeja = $request->session()->get('no_meja');
            $data['no_meja'] = $noMeja;
            Transaksi::where("no_transaksi_tmp", $faktur)->update([
                "no_meja" => $noMeja, "nama_pemesan" => $data['nama_pemesanan'],
                "email_pemesan" => $data['email_pemesanan'],
                "telp_pemesan" => $data['telp_pemesanan'],
            ]);
            $datanew = Transaksi::where("no_transaksi_tmp", $faktur)->first();
            $faktur = $datanew->no_transaksi;
        }
        $data['tmp'] = TransaksiDetail::where('no_transaksi', $faktur)->get();
        $data['faktur'] = $faktur;

        Mail::to($data['email_pemesanan'])->send(new SendEmail($data));

        $request->session()->forget('fakturs');
        $request->session()->forget('nama_pemesanan');
        $request->session()->forget('email_pemesanan');
        $request->session()->forget('telp_pemesanan');

        $data['html'] = View::make('layoutnew.order', $data)->render();
        echo json_encode($data);
    }
    function jumlah(Request $request)
    {
        $noFaktur = $request->session()->get('fakturs');
        $data = TransaksiTmp::where('no_transaksi', $noFaktur)->where('qty', '!=', '0')->get()->toArray();
        if (count($data) > 0) {
            echo count($data);
        }
    }

    function notespesanan(Request $request)
    {
        $data = $request->all();
        $request->session()->put('nama_pemesanan', $data['nama_pemesanan']);
        $request->session()->put('email_pemesanan', $data['email_pemesanan']);
        $request->session()->put('telp_pemesanan', $data['telp_pemesanan']);
        if (isset($data['notes'])) {
            TransaksiTmp::where(['id' => $data['id']])->update(['notes' => $data['notes']]);
        }
        echo json_encode("oke");
    }
    function list(Request $request)
    {
        $noFaktur = $request->session()->get('fakturs');
        $data['tmp'] = TransaksiTmp::with(['menu'])->where('no_transaksi', $noFaktur)->get();
        $total  = 500;
        $item = [];
        foreach ($data['tmp'] as $key => $value) {
            $item[] = array("id" => $value->id_menu, "price" => $value->menu->harga, "quantity" => $value->qty, "name" => $value->menu->name);
            $total += $value->qty * $value->menu->harga;
        }
        $data['snap_token'] = "xxx";
        if ($total > 500) {
            $data['nama_pemesanan'] = $request->session()->get('nama_pemesanan');
            $data['email_pemesanan'] = $request->session()->get('email_pemesanan');
            $data['telp_pemesanan'] = $request->session()->get('telp_pemesanan');

            \Midtrans\Config::$serverKey = env('MIDTRANS_KEY');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = false;
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = true;
            $data['nama_pemesanan'] = $data['nama_pemesanan'] != "" ? $data['nama_pemesanan'] : "a";
            if (!filter_var($data['email_pemesanan'], FILTER_VALIDATE_EMAIL)) {
                $data['email_pemesanan'] =  "example@gmail.com";
            }
            $data['telp_pemesanan'] = $data['telp_pemesanan'] != "" ? $data['telp_pemesanan'] : "3";
            $params = array(
                'transaction_details' => array(
                    'order_id' => $noFaktur,
                    'gross_amount' => $total,
                ),
                'item_details' => $item,
                'customer_details' => array(
                    'first_name' => $data['nama_pemesanan'],
                    'email' =>  $data['email_pemesanan'],
                    'phone' =>  $data['telp_pemesanan'],
                ),
            );


            $data['snap_token'] = \Midtrans\Snap::getSnapToken($params);
        }

        return view('layoutnew.list_keranjang', $data);
    }

    function orderonline(Request $request)
    {
        $serverKey = env('MIDTRANS_KEY');
        $data = $request->all();
        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        if ($data['status_code'] == "200") {
            if ($data['signature_key'] == $hashed) {
                $tmp = TransaksiTmp::with(['menu'])->where("no_transaksi", $request->order_id)->get()->toArray();
                $total = 0;
                $faktur = Pesanan::GetFaktur();
                $tenant = MasterTenant::get()->toArray();
                $vaUser = [];
                foreach ($tenant as $key => $value) {
                    $vaTenant[$value['id']] = $value['user_id'];
                }
                foreach ($tmp as $value) {
                    $value['no_transaksi'] = $faktur;
                    $total += $value['qty'] * $value['menu']['harga'];
                    $value['total'] = $value['qty'] * $value['menu']['harga'];
                    TransaksiDetail::create($value);
                    $vaUser[] = $vaTenant[$value['menu']['master_tenants_id']];
                }
                Pesanan::Notif($vaUser);
                $vaTransaksi = array(
                    "no_transaksi" => $faktur,
                    "no_transaksi_tmp" => $request->order_id,
                    "no_meja" => "xxx",
                    "tgl_transaksi" => date("Y-m-d"),
                    "cara_pembayaran" => "Online",
                    "status_pembayaran" => "1",
                    "total" => $total
                );
                Transaksi::create($vaTransaksi);

                TransaksiTmp::with(['menu'])->where('no_transaksi', $request->order_id)->delete();
            }
        }
    }
    function orderstatus($faktur)
    {
        $data = Transaksi::where("no_transaksi", $faktur)->first();
        if ($data->status_pembayaran == 0) {
            echo "<span class='badge badge-primary'>Menuggu Otorisasi</span>";
        } else if ($data->status_pembayaran == 1) {
            echo "<span class='badge badge-success'>Pesanan Telah Diproses</span>";
        } else {
            echo "<span class='badge badge-danger'>Pesanan Di Tolak</span>";
        }
        //
    }
}
