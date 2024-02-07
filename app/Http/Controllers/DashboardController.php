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

        $orderItems = OrderItem::with(['menu', 'order'])
            ->join('menus', 'order_items.menu_id', '=', 'menus.id')
            ->select('order_items.*') // Select all columns from order_items table
            ->where('menus.restaurant_id', $restaurantId)
            ->orderBy('order_items.created_at', 'desc')
            ->paginate(10);

        return view('dashboard.index', ['user' => $user, 'orderItems' => $orderItems, 'chartData' => $chartData]);
    }
}
