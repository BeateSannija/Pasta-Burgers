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
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'dish-name' => 'required|string|max:255',
            'dish-description' => 'required|string',
            'dish-category' => 'required|string',
            'dish-price' => 'required|numeric',
        ]);

        $category = $request->input('dish-category');
        \Illuminate\Support\Facades\Log::info('Submitted category: ' . $category);

        // Create a new dish
        Dish::create([
            'dish_name' => $request->input('dish-name'),
            'dish_description' => $request->input('dish-description'),
            'dish_category' => $request->input('dish-category'),
            'dish_price' => $request->input('dish-price'),
        ]);

        // Redirect to the update menu route with a success message
        return redirect()->route('admin.view_dishes')->with('success', 'Dish added successfully!'); //here
    }

    public function delete_dish($id)
    {
        $dish = Dish::find($id);
        $dish->delete();
        return redirect()->back();
    }

    public function edit_dish($id)      //edit
    {
        $dish = Dish::find($id);
        
        return view('admin.edit_dish', compact('dish'));
    }
    public function update_dish(Request $request, $id)
    {
        $dish = Dish::find($id);
        $dish->dish_name = $request->input('dish-name');
        $dish->dish_description = $request->input('dish-description');
        $dish->dish_category = $request->input('dish-category');
        $dish->dish_price = $request->input('dish-price');

        $dish->save();
        return redirect('/view_dishes');
    }

}
