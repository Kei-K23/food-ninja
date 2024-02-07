<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();
        $restaurantId = $user->restaurant->id;
        $menus = Menu::where('restaurant_id', $restaurantId)->orderBy('created_at', 'desc')->paginate(10);

        return view('products.index', ['menus' => $menus]);
    }

    public function show(Request $request, Menu $menu): View
    {
        return view('products.show', ['menu' => $menu]);
    }
}
