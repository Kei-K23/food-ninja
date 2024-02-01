<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        $categories = Category::all()->take(8);
        $menus = Menu::inRandomOrder()->take(6)->get();

        return view('home.index', ['categories' => $categories, 'menus' => $menus]);
    }
}
