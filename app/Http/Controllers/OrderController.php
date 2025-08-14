<?php

namespace App\Http\Controllers;

use App\Models\Order; // Add this line

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    public function adminIndex()
{
    $orders = \App\Models\Order::with('user', 'orderItems')->latest()->paginate(20);
    return view('orders.adminindex', compact('orders'));
}

public function updateStatus(Order $order, Request $request)
{
    $new = $request->validate([
        'status' => 'required|in:pending,processing,completed,cancelled,refunded',
    ])['status'];

    DB::transaction(function () use ($order, $new) {
        // When moving into a restocking state
        $restockStatuses = ['cancelled', 'refunded'];
        $wasRestocked = in_array($order->status, $restockStatuses);
        $willBeRestocked = in_array($new, $restockStatuses);

        if (!$wasRestocked && $willBeRestocked) {
            foreach ($order->items as $item) {
                Product::whereKey($item->product_id)->lockForUpdate()->increment('availability', $item->quantity);
            }
        }

        $order->update(['status' => $new]);
    });

    return back()->with('success', 'Order status updated.');
}

}
