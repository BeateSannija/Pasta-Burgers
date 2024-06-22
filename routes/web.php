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

Route::get('/cart', function () {
    return view('cart');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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

        //CRUD
route::post('add_dish', [AdminController::class, 'add_dish'])->middleware(['auth', 'admin']);  //create
route::get('delete_dish/{id}', [AdminController::class, 'delete_dish'])->middleware(['auth', 'admin']);   //delete

route::get('edit_dish/{id}', [AdminController::class, 'edit_dish'])->middleware(['auth', 'admin']);     //update
route::post('update_dish/{id}', [AdminController::class, 'update_dish'])->middleware(['auth', 'admin']);


//for status editing
Route::post('dishes/updateStatus/{id}', [AdminController::class, 'updateStatus'])->name('dishes.updateStatus');