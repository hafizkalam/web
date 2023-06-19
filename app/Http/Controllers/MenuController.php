<?php

namespace App\Http\Controllers;

use App\Models\MasterTenant;
use App\Models\Menu;
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
        $file = Request()->url;
        $fileName = Request()->name.time().'.' . $file->extension();
        $file->move(public_path('picture_menu'), $fileName);

        $vaUpdate = array(
            "name" => $request->name,
            "harga" => $request->harga,
            "url" => $fileName,
        );
        // echo("/picture_menu/".$fileName);
        // dd($vaUpdate);
        MasterTenant::create($vaUpdate);

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

        return redirect('menu');

    }

    public function destory($id)
    {
        Menu::where('id', $id)->delete();

        return redirect('menu');
    }
}
