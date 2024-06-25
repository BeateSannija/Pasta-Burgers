<?php

namespace App\Http\Controllers;
use App\Models\Dish;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;


class AdminController extends Controller
{
    public function index()
    {
        // return view('admin.index');
        // Fetch orders with status 'accepted' and progress 'null' or 'in_progress'
        /*$orders = Order::with(['user', 'cartItems.dish'])
                ->where('status', 'accepted')
                ->whereIn('progress', [null, 'in_progress'])
                ->get();

        return view('admin.index', compact('orders'));*/
        $orders = Order::with(['user', 'cartItems.dish'])
            ->where('status', 'accepted')
            ->where(function ($query) { $query->where('progress', 'in_progress')->orWhereNull('progress');})->get();

        return view('admin.index', compact('orders'));

    }

    public function update_order_progress(Request $request, $id)
    {
        /*$order = Order::find($id);

        if ($order) {
            $order->progress = $request->input('progress');
            $order->save();

            return redirect()->back()->with('success', 'Order progress updated successfully!');
        }

        return redirect()->back()->with('error', 'Order not found!');*/


        $order = Order::findOrFail($id);
        $order->progress = $request->input('progress');
        $order->save();

        return redirect()->back()->with('success', 'Order progress updated successfully.');
    }

    
    public function view_updateMenu()
    {
        $dishes = Dish::all();
        return view('admin.updateMenu', compact('dishes'));
    }

    public function view_requests()     //needs to show orders with no statuss yet
    {
        //$orders = Order::all();
        /*$orders = Order::with(['user', 'cartItems.dish'])->get();
        return view('admin.requests', compact('orders'));*/

        $orders = Order::with('cartItems.dish')->get();
        return view('admin.requests', compact('orders'));
    }

    public function view_dishes()
    {
        //$dishes = Dish::all();
        $dishes = Dish::paginate(6); 
        return view('admin.dishes', compact('dishes')); 

    }

    public function view_time()
    {
        return view('admin.time');
    }

    public function view_orderHistory() //needs to show all orders with any status
    {
        /*$orders = Order::with('cartItems.dish')->get();*/
        $orders = Order::with(['user', 'cartItems.dish'])->get();
        return view('admin.orderHistory', compact('orders'));
    }

    public function view_addDish()
    {
        //$dishes = Dish::all();
        return view('admin.addDish');

    }

    // for 'Dish' Model
    public function add_dish(Request $request)
    {
        $dish = new Dish;
        $dish->dish_name = $request->input('dish-name');
        $dish->dish_description = $request->input('dish-description');
        $dish->dish_price = $request->input('dish-price');
        $dish->dish_category = $request->input('dish-category');

        if ($request->hasFile('image') && $request->file('image')->isValid()) 
        {
            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('dishes', $imagename, 'public');
            $dish->image = $path;
        }
        $dish->save();
        return redirect()->route('admin.view_dishes');
    }

    public function delete_dish($id)
    {
        $dish = Dish::find($id);
        //image deleting from public folder
        $image_path = public_path('storage/' . $dish->image);
        if(file_exists($image_path))
        {
            unlink($image_path);
        }

        $dish->delete();
        return redirect()->back();
    }


    public function edit_dish($id)
    {
        $dish = Dish::find($id);   
        return view('admin.edit_dish', compact('dish'));
    }

    public function update_dish(Request $request,$id)
    {
        $dish = Dish::find($id); 
        $dish->dish_name = $request->input('dish-name');
        $dish->dish_description = $request->input('dish-description');
        $dish->dish_price = $request->input('dish-price');
        $dish->dish_category = $request->input('dish-category');

        if ($request->hasFile('image') && $request->file('image')->isValid()) 
        {
            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('dishes', $imagename, 'public');
            $dish->image = $path;
        }
        $dish->save();
        return redirect()->route('admin.view_dishes');
    }


    //to update status (only) DISH!!!
    public function updateStatus(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'dish-status' => 'required|string|in:Pieejams,Nav pieejams',
        ]);

        $dish = Dish::find($id);
        /*if (!$dish) {
            return redirect()->back()->with('error', 'Dish not found!');
        }*/

        // Update the dish status
        $dish->status = $request->input('dish-status');
        $dish->save();

        return redirect()->route('admin.updateMenu')->with('success', 'Dish status updated successfully!');
    }

    //to update order: set status and time to receive
    public function update_order(Request $request, $id)
    {
        $order = Order::find($id);

        if ($order) {
            $order->status = $request->input('status');
            $order->progress = $request->input('progress');
            $order->estimated_time = Carbon::today()->format('Y-m-d') . ' ' . ($request->input('estimated_time') ?? '00:00');
            $order->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }


    public function delete_orders(Request $request)
    {
        $orderIds = $request->input('order_ids');

        if ($orderIds && is_array($orderIds) && count($orderIds) > 0) {
            Order::whereIn('id', $orderIds)->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

}