<?php

namespace App\Http\Controllers;
use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class AdminController extends Controller
{
    public function view_updateMenu()
    {
        $dishes = Dish::all();
        return view('admin.updateMenu', compact('dishes'));
    }

    public function view_requests()
    {

        return view('admin.requests');
    }

    public function view_dishes()
    {
        //$dishes = Dish::all();  // Fetch all dishes from the database
        $dishes = Dish::paginate(6); 
        return view('admin.dishes', compact('dishes'));  // Return the view with the list of dishes

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


    //to update status (only)
    public function updateStatus(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'dish-status' => 'required|string|in:Pieejams,Nav pieejams',
        ]);

        $dish = Dish::find($id);
        if (!$dish) {
            return redirect()->back()->with('error', 'Dish not found!');
        }

        // Update the dish status
        $dish->status = $request->input('dish-status');
        $dish->save();

        return redirect()->route('admin.updateMenu')->with('success', 'Dish status updated successfully!');
    }


}