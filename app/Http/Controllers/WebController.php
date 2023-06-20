<?php

namespace App\Http\Controllers;

use App\Models\Web;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function show()
    {
        $data['data'] = Web::get();
        return view('admin.web', $data);
    }

    function edit(Request $request)
    {

        $vaUpdate = array("description" => $request->input('description'));

        Web::where('name', $request->name)->update($vaUpdate);
        // dd($request->name);
        return redirect('web');
    }
}
