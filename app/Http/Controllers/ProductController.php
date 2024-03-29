<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin.auth');
    }

    public function index(Request $request): View
    {
        $user = $request->user();
        $restaurantId = $user->restaurant->id;
        $menus = Menu::where('restaurant_id', $restaurantId)->orderBy('created_at', 'desc')->paginate(10);

        $categories = Category::all();

        return view('products.index', ['menus' => $menus, 'restaurantId' => $restaurantId, 'categories' => $categories]);
    }

    public function show(Request $request, Menu $menu): View
    {
        $user = $request->user();
        $restaurantId = $user->restaurant->id;

        $categories = Category::all();

        return view('products.show', [
            'menu' => $menu,
            'categories' => $categories,
            'restaurantId' => $restaurantId
        ]);
    }
}
