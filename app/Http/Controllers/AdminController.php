<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function view_updateMenu()
    {
        return view('admin.updateMenu');
    }
}
