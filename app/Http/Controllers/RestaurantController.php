<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RestaurantController extends Controller
{
    public function index(Request $req): View
    {
        $restaurants = Restaurant::latest()->filter($req->query())->paginate(10);

        return view('restaurant.index', ['restaurants' => $restaurants]);
    }

    public function show(Restaurant $restaurant): View
    {
        $menus = Menu::where('restaurant_id', $restaurant->id)->paginate(10);

        return view('restaurant.show', ['restaurant' => $restaurant, 'menus' => $menus]);
    }
}
