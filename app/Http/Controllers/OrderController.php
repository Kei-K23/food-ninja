<?php

namespace App\Http\Controllers;

use App\Mail\MailableName;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class OrderController extends Controller
{

    public function index(Request $request): View
    {
        $user = $request->user();
        $orders = $user->orders;

        return view('order.index', ['user' => $user, 'orders' => $orders]);
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'total_item' => ['required', 'numeric'],
            'total_quantity' => ['required', 'numeric'],
            'total_price' => ['required', 'numeric'],
            'user_id' => ['required', 'numeric'],
        ]);

        // Create a new order record
        $order = Order::create([
            'total_item' => $validatedData['total_item'],
            'total_quantity' => $validatedData['total_quantity'],
            'total_price' => $validatedData['total_price'],
            'user_id' => $validatedData['user_id'],
        ]);

        // Retrieve the shopping cart items for the current user
        $cartItems = ShoppingCart::where('user_id', $validatedData['user_id'])->get();

        // Create order items based on the shopping cart items
        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'menu_id' => $cartItem->menu_id,
                'quantity' => $cartItem->quantity,
                'unit_price' => $cartItem->menu->price
            ]);
        }

        $user = Auth::user();

        // Clear the shopping cart after creating the order
        ShoppingCart::where('user_id', $validatedData['user_id'])->delete();

        Mail::to($user->email)->send(new MailableName($order));
        return back()->with('success', 'Your purchase successful. We sent an success email for you.');
    }

    public function show(Order $order): View
    {
        return view('order.show', ['order' => $order]);
    }
}
