<?php

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

Route::get('/', function () {
    return view('home.index');
})->name('home');

Auth::routes();

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

Route::get('/category', function () {
    return view("category.index");
})->name("category");

Route::get('/menu', function () {
    return view("menu.index");
})->name("menu");
