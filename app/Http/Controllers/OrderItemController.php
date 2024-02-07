<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function destroy(OrderItem $orderItem)
    {
        $order = $orderItem->order;

        $order->update([
            'total_item' => $order->total_item - 1,
            'total_quantity' => $order->total_quantity - $orderItem->quantity,
            'total_price' => $order->total_price - ($orderItem->quantity * $orderItem->unit_price)
        ]);

        $order->save();

        $orderItem->delete();

        return back()->with('success', "Deleted order id : $orderItem->id");
    }
}
