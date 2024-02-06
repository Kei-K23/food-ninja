<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin.auth');
    }

    public function index(Request $request): View
    {
        $user = $request->user();
        $restaurantId = $request->user()->restaurant->id;

        $orderItems = OrderItem::join('menus', 'order_items.menu_id', '=', 'menus.id')
            ->where('menus.restaurant_id', $restaurantId)
            ->paginate(10);

        return view('dashboard.index', ['user' => $user, 'orderItems' => $orderItems]);
    }
}
