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

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => ['required', 'string', 'min:2'],
            'price' => ['required', 'numeric'],
            'description' => ['required', 'string', 'min:5'],
            'category_id' => ['required'],
            'restaurant_id' => ['required'],
            'image_url' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']
        ]);


        // Check if a new image has been uploaded
        if ($request->hasFile('image_url')) {
            // Store the image in the storage
            $fileName = time() . '.' . $request->image_url->extension();
            $request->image_url->storeAs('public/images', $fileName);


            $validateData['image_url'] = $fileName;
        }

        Menu::create($validateData);
        return back()->with('success', 'Successfully created new menu');
    }

    public function show(Menu $menu): View
    {
        $menus = Menu::where('category_id', $menu->category_id)->inRandomOrder()->take(6)->get();

        return view('menu.show', ['menu' => $menu, 'menus' => $menus]);
    }
}
