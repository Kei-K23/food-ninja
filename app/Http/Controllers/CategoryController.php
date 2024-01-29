<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        return view('category.index', ['categories' => Category::all()]);
    }

    public function show(Category $category): View
    {
        $menus = Menu::where('category_id', $category->id)->paginate(10);

        return view('category.show', ['category' => $category, 'menus' => $menus]);
    }
}
