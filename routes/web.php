<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;    //added
use App\Http\Controllers\AdminController;    //added
use App\Http\Middleware\Admin;

/*
  - profile?
  - kontakti & par mums 
 */

Route::get('/', [HomeController::class,'home'])->name('home');

/*Route::get('/cart', function () {
    return view('cart');
});*/

/*Route::get('/dashboard', function () {        //original one
    return view('home.index');
})->middleware(['auth', 'verified'])->name('dashboard');*/

Route::get('/dashboard', [HomeController::class, 'login_home'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//  ROUTES FOR ADMIN SIDEBAR
route::get('admin/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'admin'])->name('admin.dashboard');
route::get('view_updateMenu', [AdminController::class, 'view_updateMenu'])->middleware(['auth', 'admin'])->name('admin.updateMenu');
route::get('view_requests', [AdminController::class, 'view_requests'])->middleware(['auth', 'admin']);
route::get('view_dishes', [AdminController::class, 'view_dishes'])->middleware(['auth', 'admin'])->name('admin.view_dishes');
route::get('view_time', [AdminController::class, 'view_time'])->middleware(['auth', 'admin']);
route::get('view_orderHistory', [AdminController::class, 'view_orderHistory'])->middleware(['auth', 'admin']);
route::get('view_addDish', [AdminController::class, 'view_addDish'])->middleware(['auth', 'admin']); //page for adding dish
route::post('update_order/{id}', [AdminController::class, 'update_order'])->middleware(['auth', 'admin']);

        //CRUD
route::post('add_dish', [AdminController::class, 'add_dish'])->middleware(['auth', 'admin']);  //create
route::get('delete_dish/{id}', [AdminController::class, 'delete_dish'])->middleware(['auth', 'admin']);   //delete

route::get('edit_dish/{id}', [AdminController::class, 'edit_dish'])->middleware(['auth', 'admin']);     //update
route::post('update_dish/{id}', [AdminController::class, 'update_dish'])->middleware(['auth', 'admin']);


    //for status editing
route::post('dishes/updateStatus/{id}', [AdminController::class, 'updateStatus'])->name('dishes.updateStatus');

//  ROUTES FOR USER
route::get('view_menu', [HomeController::class, 'view_menu']);      //MENU view
route::get('add_to_cart/{id}', [HomeController::class, 'add_to_cart'])->middleware(['auth']);      //Add to cart only for registered users
route::get('mycart', [HomeController::class, 'mycart'])->middleware(['auth', 'verified']);      //let verified stay?
route::get('remove_item/{id}', [HomeController::class, 'remove_item'])->middleware(['auth', 'verified']);   //remove item from a cart

route::post('create_order', [HomeController::class, 'create_order'])->middleware(['auth', 'verified']); //confirm order