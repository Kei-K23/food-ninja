<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $categories = Category::all()->take(8);
        $menus = Menu::inRandomOrder()->take(6)->get();
        return view('home.index', ['categories' => $categories, 'menus' => $menus]);
    }
}
