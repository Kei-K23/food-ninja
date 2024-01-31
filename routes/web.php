<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ShoppingCartController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes();

// profile route
Route::group([], function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/{profile}', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/removeProfile/{profile}', [ProfileController::class, 'removeProfile'])->name('profile.removeProfile');
    Route::put('/profile/updatePassword/{profile}', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// category route
Route::group([], function () {
    Route::get('/category', [CategoryController::class, 'index'])->name("category");
    Route::get('/category/{category}', [CategoryController::class, 'show'])->where('category', '[0-9]+')->name('category.show');
});

// menu route
Route::group([], function () {
    Route::get('/menu', [MenuController::class, 'index'])->name("menu");
    Route::get('/menu/{menu}', [MenuController::class, 'show'])->where('menu', '[0-9]+')->name('menu.show');
});

// restaurant route
Route::group([], function () {
    Route::get('/restaurant', [RestaurantController::class, 'index'])->name('restaurant');
    Route::get('/restaurant/{restaurant}', [RestaurantController::class, 'show'])->name('restaurant.show');
});

// shopping cart route
Route::get('/shopping-cart', [ShoppingCartController::class, 'index'])->name('shopping-cart');
