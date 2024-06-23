<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dish;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function home()
    {
        return view('home.index');
    }

    public function view_menu()
    {
        $dish = Dish::where('status', 'Pieejams')->get();

        return view('home.menu', compact('dish'));
    }
}
