<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        $orderData = OrderItem::join('menus', 'order_items.menu_id', '=', 'menus.id')
            ->where('menus.restaurant_id', $restaurantId);

        $orderItems = OrderItem::join('menus', 'order_items.menu_id', '=', 'menus.id')
            ->select(DB::raw('MONTH(order_items.created_at) as month'), DB::raw('SUM(order_items.quantity) as total_quantity'))
            ->groupBy(DB::raw('MONTH(order_items.created_at)'))
            ->orderBy(DB::raw('MONTH(order_items.created_at)'))
            ->get();

        // Initialize arrays to store labels and data
        $labels = [];
        $data = [];

        // Populate labels and data arrays
        foreach ($orderItems as $item) {
            $labels[] = \DateTime::createFromFormat('!m', $item->month)->format('F'); // Convert month number to month name
            $data[] = $item->total_quantity;
        }

        // Prepare the data array
        $chartData = [
            'labels' => $labels,
            'data' => $data,
        ];

        $orderItems = $orderData->paginate(5);

        return view('dashboard.index', ['user' => $user, 'orderItems' => $orderItems, 'chartData' => $chartData]);
    }
}
