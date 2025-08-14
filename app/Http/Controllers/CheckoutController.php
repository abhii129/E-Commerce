<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;              // ✅ needed
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;   // ✅ optional but useful

class CheckoutController extends Controller
{
    public function show()
    {
        $cartItems = auth()->user()->cartItems()->with('product')->get();
        return view('cart.show', compact('cartItems'));
    }

    public function index()
    {
        $user = auth()->user();
        $cartItems = $user->cartItems()->with('product')->get();
        return view('cart.checkout-index', compact('cartItems'));
    }

    // Decrement stock safely + create order
    public function process(Request $request)
    {
        $user = auth()->user();
        $cartItems = $user->cartItems()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.show')->with('error', 'Your cart is empty.');
        }

        return DB::transaction(function () use ($user, $cartItems) {
            // 1) validate + lock + decrement stock
            foreach ($cartItems as $item) {
                $qty = (int) $item->quantity;

                $product = Product::whereKey($item->product_id)
                    ->lockForUpdate()
                    ->firstOrFail();

                if ($product->availability < $qty) {
                    throw new \RuntimeException(
                        "Insufficient stock for {$product->name}. Only {$product->availability} left."
                    );
                }

                $product->decrement('availability', $qty);
            }

            // 2) totals
            $total = $cartItems->sum(fn ($i) => (float)$i->price * (int)$i->quantity);

            // 3) order
            $order = Order::create([
                'user_id' => $user->id,
                'total'   => $total,
                'status'  => 'pending',
            ]);

            // 4) items
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id'     => $order->id,
                    'product_id'   => $item->product_id,
                    'product_name' => $item->product->name,
                    'price'        => $item->price,
                    'quantity'     => (int) $item->quantity,
                ]);
            }

            // 5) clear cart
            $user->cartItems()->delete();

            // 6) commit (implicit)
            return redirect()->route('checkout.success', ['order' => $order->id]);
        }, 3);
    }

    public function success(Order $order)
    {
        $order->load('orderItems'); // make sure relation name matches your model
        return view('cart.checkout-success', compact('order'));
    }
}
