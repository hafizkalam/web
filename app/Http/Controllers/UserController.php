<?php

namespace App\Http\Controllers;

use App\Models\MasterTenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        // $file = Request()->proile;
        // $fileName = Request()->name.time().'.' . $file->extension();
        // $file->move(public_path('profile_users'), $fileName);

        $test = Auth::user();
        // $nama = $test->name;

        $vaUpdate = array(
            "id" => $request->id,
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make("123"),
            "level" => "2",
            "profile" => "sdfsdf"/*$fileName*/,
            "desc" => $test->name,
        );

        $vaTenant = array(
            "name_tenant" => $request->name
        );


        if ($request->has('edit')) {
            User::where('id', $request->id)->update($vaUpdate);
        } else {
            User::create($vaUpdate);
            MasterTenant::create($vaTenant);
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
