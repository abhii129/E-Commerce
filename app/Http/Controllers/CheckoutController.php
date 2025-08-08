<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function show()
    {
        // Get the current user's cart items with product details
        $cartItems = auth()->user()->cartItems()->with('product')->get();
        return view('cart.show', compact('cartItems'));
    }
    

    public function process(Request $request)
    {
        $user = auth()->user();
        $cartItems = $user->cartItems()->with('product')->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.show')->with('error', 'Your cart is empty.');
        }

        DB::beginTransaction();
        try {
            // Calculate totals
            $total = 0;
            foreach ($cartItems as $item) {
                $total += $item->price * $item->quantity;
            }

            // Create the order
            $order = Order::create([
                'user_id' => $user->id,
                'total' => $total,
                'status' => 'pending',
            ]);

            // Create order items
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'price' => $item->price,
                    'quantity' => $item->quantity,
                ]);
            }

            // Clear the user's cart
            $user->cartItems()->delete();

            DB::commit();
            return redirect()->route('checkout.success', $order->id);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Checkout failed. Please try again.');
        }
    }

        // In CheckoutController
        public function index() {
            $cartItems = auth()->user()->cartItems()->with('product')->get();
            return view('cart.checkout-index', compact('cartItems'));
        }
        public function success($orderId) {
            $order = Order::with('orderItems')->findOrFail($orderId);
            return view('cart.checkout-success', compact('order'));
        }

}
