<?php

namespace App\Http\Controllers;
use App\Models\Dish;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function view_updateMenu()
    {
        return view('admin.updateMenu');
    }

    public function view_requests()
    {

        return view('admin.requests');
    }

    public function view_dishes()
    {
        $dishes = Dish::all();  // Fetch all dishes from the database
        return view('admin.dishes', compact('dishes'));  // Return the view with the list of dishes
        //return view('admin.dishes');
    }
    public function view_time()
    {
        return view('admin.time');
    }
    public function view_orderHistory()
    {
        return view('admin.orderHistory');
    }
    public function view_addDish()
    {
        //$dishes = Dish::all();  // Fetch all dishes from the database
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
}