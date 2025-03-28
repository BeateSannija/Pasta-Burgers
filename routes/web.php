<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;    
use App\Http\Controllers\LocaleController;    
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

Route::get('/', [HomeController::class,'home'])->name('home');

//change locale
route::get('locale/{lang}', [LocaleController::class,'setLocale']);

Route::get('/dashboard', [HomeController::class, 'login_home'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//  ROUTES FOR ADMIN SIDEBAR
route::get('admin/dashboard', [AdminController::class, 'index'])->middleware(['auth', 'admin'])->name('admin.dashboard');
route::get('view_updateMenu', [AdminController::class, 'view_updateMenu'])->middleware(['auth', 'admin'])->name('admin.updateMenu');

route::get('view_requests', [AdminController::class, 'view_requests'])->middleware(['auth', 'admin']);
route::get('view_dishes', [AdminController::class, 'view_dishes'])->middleware(['auth', 'admin'])->name('admin.view_dishes');
route::get('view_time', [AdminController::class, 'view_time'])->middleware(['auth', 'admin']);
route::get('view_orderHistory', [AdminController::class, 'view_orderHistory'])->middleware(['auth', 'admin']);
route::get('view_addDish', [AdminController::class, 'view_addDish'])->middleware(['auth', 'admin']); //page for adding dish
route::post('/admin/orders/update-progress/{id}', [AdminController::class, 'update_order_progress'])->middleware(['auth', 'admin'])->name('admin.update_order_progress');
route::post('update_order/{id}', [AdminController::class, 'update_order'])->middleware(['auth', 'admin'])->name('admin.update_order');  //for orderHistory
route::post('delete_orders', [AdminController::class, 'delete_orders'])->middleware(['auth', 'admin'])->name('admin.delete_orders');    //for orderHistory


        //CRUD for dishes
route::post('add_dish', [AdminController::class, 'add_dish'])->middleware(['auth', 'admin']);  //create
route::get('delete_dish/{id}', [AdminController::class, 'delete_dish'])->middleware(['auth', 'admin']);   //delete

route::get('edit_dish/{id}', [AdminController::class, 'edit_dish'])->middleware(['auth', 'admin']);     //update
route::post('update_dish/{id}', [AdminController::class, 'update_dish'])->middleware(['auth', 'admin']);


    //for status editing (dishes table)
route::post('dishes/updateStatus/{id}', [AdminController::class, 'updateStatus'])->name('dishes.updateStatus');

//  ROUTES FOR USER
route::get('view_menu', [HomeController::class, 'view_menu']);      //MENU view
route::get('add_to_cart/{id}', [HomeController::class, 'add_to_cart'])->middleware(['auth']);      //Add to cart only for registered users
route::get('mycart', [HomeController::class, 'mycart'])->middleware(['auth', 'verified']);      //let verified stay?
route::get('remove_item/{id}', [HomeController::class, 'remove_item'])->middleware(['auth', 'verified']);   //remove item from a cart
route::get('myorders', [HomeController::class, 'myorders'])->middleware(['auth', 'verified']);  //for orders display

route::post('create_order', [HomeController::class, 'create_order'])->middleware(['auth', 'verified']); //confirm order

Route::get('/cart/count', [HomeController::class, 'cart_count'])->name('cart.count');        //cart count testing //dynamic with json