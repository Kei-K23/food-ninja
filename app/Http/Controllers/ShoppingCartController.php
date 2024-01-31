<?php

namespace App\Http\Controllers;

use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ShoppingCartController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $carts = ShoppingCart::with('menu')->where('user_id', $user->id)->get();
        return view('shopping-cart.index', ['user' => $user, 'carts' => $carts]);
    }
}
