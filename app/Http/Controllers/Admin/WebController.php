<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Library\Services\Pesanan;
use App\Models\MasterTenant;
use App\Models\Meja;
use App\Models\Menu;
use App\Models\TransaksiTmp;
use App\Models\Web;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebController extends Controller
{
    public function show()
    {
        $data['data'] = Web::get();
        $data['jsTambahan'] = "$('#web').addClass('active') ;";
        return view('admin.web', $data);
    }

    function createedit(Request $request)
    {
        $vaUpdate = array("description" => $request->input('description'));

        Web::where('name', $request->name)->update($vaUpdate);
        // dd($request->name);
        return redirect('web');
    }

    public function showmenu(Request $request, $id)
    {
        $noFaktur = Pesanan::GetFakturTmp($request);

        $decypted    = explode("-", decrypt($id));
        // dd($decypted);
        $id = $decypted[1];

        if (!Meja::where('id', $id)->exists()) {
            dd("Meja tidak ditemukan"); // user found
        }

        $data = $request->all();
        $request->session()->put('no_meja', $id);
        $web = Web::get();
        foreach ($web as $value) {
            $data[$value->name] = $value->description;
        }
        $data['no_meja'] = $id;
        $data['tmp'] = TransaksiTmp::with(['menu'])->where('no_transaksi', $noFaktur)->get();
        $data['data'] = MasterTenant::get();
        $data['faktur'] = $noFaktur;
        $data['nama_menu'] = Menu::where("status", 1)->with(['tenant'])->get();
        $vaMenu = [];
        $vaMenuLama = [];
        foreach ($data['nama_menu'] as $value) {
            if ($value->tenant->status == 1) {
                $tenanLama = $value->tenant->name;
                $value->tenant->name = str_replace(' ', '', $value->tenant->name);
                $vaMenu[$value->tenant->name][] = $value;
                $vaMenuLama[$value->tenant->name] = $tenanLama;
            }
        }
        $data['menu_tenant'] = $vaMenu;
        $data['menu_tenant_lama'] = $vaMenuLama;

        $data['tenant'] = MasterTenant::select('name')->groupBy('name')->get();


        $data['url'] = $request->url();
        return view('layoutnew.menu', $data);
    }
}
