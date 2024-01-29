<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MenuController extends Controller
{
    public function index(Request $req): View
    {
        $menu = Menu::latest()->filter($req->query())->paginate(10);

        return view('menu.index', ['menus' => $menu]);
    }

    public function show(Menu $menu): View
    {
        $menus = Menu::where('category_id', $menu->category_id)->inRandomOrder()->take(6)->get();

        return view('menu.show', ['menu' => $menu, 'menus' => $menus]);
    }
}
