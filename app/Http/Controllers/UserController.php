<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show()
    {
        $data['data'] = User::get();

        return view('admin.user', $data);
    }

    public function createedit(Request $request)
    {

        $vaUpdate = array(
            "id" => $request->id,
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make("123"),
            "level" => "2",

        );

        if ($request->has('edit')) {
            User::where('id', $request->id)->update($vaUpdate);
        } else {
            User::create($vaUpdate);
            $request->session()->put('notif', "Data berhasil ditambahkan");
        }

        return redirect('user');
    }

    public function destory($id)
    {
        User::where('id', $id)->delete();

        return redirect('user');
    }
}
