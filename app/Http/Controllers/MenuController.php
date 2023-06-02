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
}
