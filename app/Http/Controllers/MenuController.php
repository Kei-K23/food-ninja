<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MenuController extends Controller
{
    public function show(Menu $menu): View
    {
        return view('menu.show', ['menu' => $menu]);
    }

    public function index(): View
    {
        return view('menu.index', ['menus' => Menu::all()]);
    }
}
