<?php

namespace App\Http\Controllers;

use App\Models\MasterTenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function show()
    {
        $test = Auth::user();
        $data['data'] = MasterTenant::where('name_tenant',$test->name)->get();
// echo "<pre>";
//         print_r($data);
//         exit;
        return view('admin.menu', $data);
    }

    public function createedit(Request $request)
    {
        $data = $request->except('name_tenant');

        $file = $request->foto_menu;
        $fileName = $request->name_menu . time() . '.' . $file->extension();
        $file->move(public_path('picture_menu'), $fileName);

        $vaUpdate = array(
            "name_tenant" => $data['name_tenant'],
            "name_menu" => $request->name_menu,
            "harga_menu" => $request->harga_menu,
            "foto_menu" => $fileName,
            "desc_menu" => $request->desc_menu,
        );

        // MasterTenant::where('id', $id)->update($data);
        MasterTenant::create($vaUpdate);

        // echo("/picture_menu/".$fileName);
        // dd($vaUpdate);
        // MasterTenant::create($vaUpdate);

        // if ($request->hasFile('url')) {
        //     $path = $request->file('url')->store('menu');
        //     $vaUpdate['url'] = $path;
        // }
        // if ($request->has('edit')) {
        //     Menu::where('id', $request->id)->update($vaUpdate);
        // } else {
        //     // echo "<script>alert('Your message Here');</script>";
        //     Menu::create($vaUpdate);
        // }

        return redirect('menu')->with('success', 'Data berhasil diperbarui.');

    }

    public function destory($id)
    {
        MasterTenant::where('id', $id)->delete();

        return redirect('menu');
    }
}
