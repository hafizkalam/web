<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterTenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TenantController extends Controller
{

    function tenant()
    {

        $data['data'] = MasterTenant::get();
        $data['jsTambahan'] = "$('#tenant').addClass('active') ;";
        return view('admin.list_tenant', $data);
    }

    function edit(Request $request)
    {
        $id = Auth::user()->id;
        $data = $request->all();
        unset($data['_token']);
        if ($request->hasFile('profile')) {
            $file = Request()->profile;
            $fileName = Request()->name . time() . '.' . $file->extension();
            $file->move(public_path('profile_users'), $fileName);
            $data['profile'] = $fileName;
        }

        if (isset($data['status'])) {
            if ($data['status'] == "on") {
                $data['status'] = 1;
            } else if ($data['status'] == "2") {
                $data['status'] = 2;
            }

            $data['status'] = $data['status'];
        } else {
            $data['status'] = 0;
        }
        MasterTenant::where("user_id", $id)->update($data);
        unset($data['status']);
        User::where('id', $id)->update($data);

        return redirect('/info-tenant');
    }

    function blokir(Request $request)
    {
        $data = $request->all();
        if ($data['status'] == "false") {
            $data['status'] = 2;
        } else {
            $data['status'] = 1;
        }

        MasterTenant::where("id", $data['id'])->update($data);
    }
    function show()
    {
        $id = Auth::user()->id;
        $data['tenant'] = MasterTenant::where("user_id", $id)->first();

        $data['jsTambahan'] = "$('#info').addClass('active') ;";
        return view("admin.tenant", $data);
    }
    //
}
