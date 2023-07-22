<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $data['jsTambahan'] = "$('#user').addClass('active') ;";
        return view('admin.user', $data);
    }

    public function change(){
        $id = Auth::user()->id;
        $data['tenant'] = MasterTenant::where("user_id", $id)->first();

        $data['jsTambahan'] = "$('#password').addClass('active') ;";
        return view("admin.change_password", $data);
    }
    public function createedit(Request $request)
    {

        $test = Auth::user();

        $vaUpdate = array(
            "id" => $request->id,
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make("123"),
            "level" => "2",
            // "profile" => $fileName,
            "desc" => $request->desc,
        );

        $vaTenant = array(
            "name" => $request->name,
            "profile" => "",
            "desc" => "",
            "user_id" => $request->id
        );

        if ($request->hasFile('profile')) {
            // $path = $request->file('url')->store('user');
            $file = Request()->profile;
            $fileName = Request()->name . time() . '.' . $file->extension();
            $file->move(public_path('profile_users'), $fileName);
            $vaUpdate['profile'] = $fileName;
        }
        if ($request->has('edit')) {
            User::where('id', $request->id)->update($vaUpdate);
            MasterTenant::where('user_id', $request->id)->update(["name" => $request->name]);
        } else {
            $cek = User::create($vaUpdate);
            $vaTenant = array(
                "name" => $request->name,
                "profile" => "",
                "desc" => "",
                "user_id" => $cek->id
            );
            MasterTenant::create($vaTenant);
            $request->session()->put('notif', "Data berhasil ditambahkan");
        }

        return redirect('user');
    }

    public function destory($id, $name)
    {
        User::where('id', $id)->delete();
        MasterTenant::where('user_id', $id)->delete();
        return redirect('user');
    }

    public function editpassword(Request $request){
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", "Old Password Doesn't match!");
        }
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password changed successfully!");
    }
}
