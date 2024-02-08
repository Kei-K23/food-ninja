<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();
        $restaurantId = $user->restaurant->id;

        $orderItems = OrderItem::select('order_id')
            ->with(['order.user'])
            ->whereHas('menu', function ($query) use ($restaurantId) {
                $query->where('restaurant_id', $restaurantId);
            })
            ->groupBy('order_id')
            ->paginate(10);

        return view('customers.index', ['orderItems' => $orderItems]);
    }
}
