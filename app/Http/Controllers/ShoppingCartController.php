<?php

namespace App\Http\Controllers;

use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ShoppingCartController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $carts = ShoppingCart::with('menu')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();


        return view('shopping-cart.index', ['user' => $user, 'carts' => $carts]);
    }

    public function increment(Request $request)
    {
        $cartId = $request->input('cart_id');
        $cart = ShoppingCart::find($cartId);
        if ($cart) {
            $cart->quantity++;
            $cart->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    public function decrement(Request $request)
    {
        $cartId = $request->input('cart_id');
        $cart = ShoppingCart::find($cartId);
        if ($cart && $cart->quantity > 1) {
            $cart->quantity--;
            $cart->save();
            return response()->json(['success' => true]);
        } elseif ($cart && $cart->quantity == 1) {
            $cart->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    public function destroy($id)
    {
        $cart = ShoppingCart::find($id);
        if ($cart) {
            $cart->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
}
