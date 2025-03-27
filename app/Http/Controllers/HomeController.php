<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


use App\Models\Dish;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;

class HomeController extends Controller
{
    public function login_home()        
    {
        $user = Auth::user(); 
        $userid = $user->id;
        $count = Cart::where('user_id',$userid)->count();
        $randomDishes = Dish::inRandomOrder()->take(2)->get();
        return view('home.index', compact('count', 'randomDishes'));
    }

    public function home()
    {
        $count = 0;
        $cart = collect();
        if(Auth::id())
        {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->whereNull('order_id')->count();
            $cart = Cart::where('user_id', $userid)->whereNull('order_id')->get();
        }

        $randomDishes = Dish::inRandomOrder()->take(2)->get();

        return view('home.index', compact('count', 'randomDishes'));
    }

    public function view_menu()
    {
        $dish = Dish::where('status', 'Pieejams')->get();

        // for the cart item count
        $count = 0;
        $cart = collect();
        if(Auth::id())
        {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->whereNull('order_id')->count();
            $cart = Cart::where('user_id', $userid)->whereNull('order_id')->get();
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
        //for item count in the cart
        $count = 0;
        $cart = collect();
        if(Auth::id())
        {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->whereNull('order_id')->count();
            $cart = Cart::where('user_id', $userid)->whereNull('order_id')->get();
        }
        else 
        {
            $count = 0;
            $cart = collect();
        }
        return view('home.mycart', compact('count', 'cart'));

        
    }

    public function cart_count()
    {
        $count = 0;

        if (Auth::id()) {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->whereNull('order_id')->count();
        }
        return response()->json(['count' => $count]);
    }

    public function remove_item($id)
    {
        $item = Cart::find($id);
        $item->delete();
        return redirect()->back();
    }


    public function create_order(Request $request)
    {
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->whereNull('order_id')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        $order = Order::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'status' => null,
            'progress' => null,
            'estimated_time' => null,
        ]);

        // Assign order_id to cart items
        foreach ($cartItems as $cartItem) {
            $cartItem->order_id = $order->id;
            $cartItem->save();
        }
        return redirect()->route('home')->with('success', 'Your order has been placed successfully!');
    }

    public function myorders()
    {
        $count = 0;
        $cart = collect();
        $orders = collect(); // Initialize an empty collection

        if (Auth::id()) {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->whereNull('order_id')->count();
            $cart = Cart::where('user_id', $userid)->whereNull('order_id')->get();
            $orders = Order::with('cartItems.dish')->where('user_id', $userid)->get(); // Fetch orders with related cart items and dishes
        }
        return view('home.orders', compact('count', 'orders'));
    }
    
}

