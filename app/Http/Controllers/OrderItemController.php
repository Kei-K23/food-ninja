<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OrderItemController extends Controller
{
    public function destroy(Request $request, OrderItem $orderItem)
    {

        if (!$request->user()->restaurant()->exists()) {

            return back()->with('error', "Unauthorized! Cannot delete order item");
        }

        $restaurant = $request->user()->restaurant;

        if (Gate::allows('admin-destroy', $restaurant)) {
            $order = $orderItem->order;

            $order->update([
                'total_item' => $order->total_item - 1,
                'total_quantity' => $order->total_quantity - $orderItem->quantity,
                'total_price' => $order->total_price - ($orderItem->quantity * $orderItem->unit_price)
            ]);


            $order->save();

            $orderItem->delete();

            if ($order->total_item === 0) {
                $order->delete();
            }

            return back()->with('success', "Deleted order id : $orderItem->id");
        } else {
            return back()->with('error', "Unauthorized! Cannot delete order item");
        }
    }
}
