<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('term');

        $menus = Menu::latest()->filter($request->query())->paginate(10);

        return view('search.index', ['search' => $search, 'menus' => $menus]);
    }
}
