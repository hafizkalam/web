<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterTenant;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class MenuController extends Controller
{
    public function show()
    {

        $id = Auth::user()->id;
        $tenant = MasterTenant::where("user_id", $id)->first();

        $data['data'] = Menu::where('master_tenants_id', @$tenant->id)->get();
        $data['jsTambahan'] = "$('#menu').addClass('active') ;";
        return view('admin.menu', $data);
    }

    public function createedit(Request $request)
    {
        $id = Auth::user()->id;

        $tenant = MasterTenant::where("user_id", $id)->first();

        $vaUpdate = array(
            // "id" => $request->id,
            "name" => $request->name_menu,
            "harga" => str_replace(",", "", $request->harga_menu),
            "desc" => $request->desc_menu,
            "master_tenants_id" => $tenant->id
        );
        if ($request->hasFile('foto_menu')) {
            $path = $request->file('foto_menu')->store('menu', 'public');
            $vaUpdate['foto'] = $path;
        }
        if ($request->has('edit')) {
            Menu::where('id', $request->id)->update($vaUpdate);
        } else {
            Menu::create($vaUpdate);
        }

        return redirect('menu')->with('success', 'Data berhasil diperbarui.');
    }

    public function destory($id)
    {
        Menu::where('id', $id)->delete();
        return redirect('menu');
    }

    public function status(Request $request)
    {
        $data = $request->all();
        if ($data['status'] == "true") {
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }
        Menu::where("id", $data['id'])->update($data);
    }
}
