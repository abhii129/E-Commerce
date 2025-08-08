<?php

namespace App\Http\Controllers;

use App\Models\Order; // Add this line

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function adminIndex()
{
    $orders = \App\Models\Order::with('user', 'orderItems')->latest()->paginate(20);
    return view('orders.adminindex', compact('orders'));
}

public function updateStatus(Request $request, Order $order)
{
    $request->validate([
        'status' => 'required|in:pending,completed,processing,cancelled',
    ]);

    // Optionally check if user is admin here or via middleware

    $order->status = $request->input('status');
    $order->save();

    return redirect()->back()->with('success', 'Order status updated successfully.');
}


}
