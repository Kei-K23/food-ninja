<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProfileController;
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

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

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
