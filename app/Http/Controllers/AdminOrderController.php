<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminOrderController extends Controller
{
    public function index(Request $request): View
    {
        $restaurantId = $request->user()->restaurant->id;

        $orderItems = OrderItem::with(['menu', 'order'])
            ->join('menus', 'order_items.menu_id', '=', 'menus.id')
            ->select('order_items.*') // Select all columns from order_items table
            ->where('menus.restaurant_id', $restaurantId)
            ->orderBy('order_items.created_at', 'desc')
            ->paginate(10);

        return view('adminOrder.index', ['orderItems' => $orderItems]);
    }
}
