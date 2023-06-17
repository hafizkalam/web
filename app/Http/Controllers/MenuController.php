<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function show()
    {
        $data['data'] = Menu::get();

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
        Menu::create($vaUpdate);

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
