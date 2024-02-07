<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function destroy(OrderItem $orderItem)
    {
        $orderItem->delete();
        return back()->with('success', "Deleted order id : $orderItem->id");
    }
}
