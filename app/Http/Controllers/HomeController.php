<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Dish;
use App\Models\User;
use App\Models\Cart;

class HomeController extends Controller
{
    public function login_home()        //changed place
    {
        // for the cart item count
        $user = Auth::user();   //checking if user is logged in
        $userid = $user->id;
        $count = Cart::where('user_id',$userid)->count();
        return view('home.index', compact('count'));
    }

    public function index()
    {
        return view('admin.index');
    }

    public function home()
    {
        if(Auth::id())      //checks if there is any logged in id
        {
            $user = Auth::user();   //checking if user is logged in
            $userid = $user->id;
            $count = Cart::where('user_id',$userid)->count();
        }
        else
        {
            $count = '';
        }
        return view('home.index', compact('count'));
    }

    public function view_menu()
    {
        $dish = Dish::where('status', 'Pieejams')->get();

        // for the cart item count
        if(Auth::id())
        {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id',$userid)->count();
        }
        else
        {
            $count = '';
        }
        return view('home.menu', compact('dish', 'count'));
    }

    public function add_to_cart($id)
    {
        $dish_id = $id;
        $user = Auth::user();
        $user_id = $user->id;

        $data = new Cart;
        $data->user_id = $user_id;
        $data->dish_id = $dish_id;

        $data->save();
        return redirect()->back();
    }

    public function mycart()
    {
        //for count 
        if(Auth::id())
        {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id',$userid)->count();

            $cart = Cart::where('user_id', $userid)->get(); //added
        }
        //

        return view('home.mycart', compact('count', 'cart'));
    }

    public function remove_item($id)
    {
        $item = Cart::find($id);
        $item->delete();
        return redirect()->back();
    }


    /*public function confirm_order()
    {
        $order = new Order;
        $cart = Cart::where('user_id', $userid)->get();

        f

    }*/
}
