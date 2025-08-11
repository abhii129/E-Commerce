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
    

    // Show review page
    public function index()
    {
        $user = auth()->user();
        $cartItems = $user->cartItems()->with('product')->get();

        return view('cart.checkout-index', compact('cartItems'));
    }

    // Place order
    public function process(Request $request)
    {
        $user = auth()->user();
        $cartItems = $user->cartItems()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.show')->with('error', 'Your cart is empty.');
        }

        DB::beginTransaction();
        try {
            // calculate total
            $total = $cartItems->sum(fn($item) => $item->price * $item->quantity);

            // create order
            $order = Order::create([
                'user_id' => $user->id,
                'total'   => $total,
                'status'  => 'pending',
            ]);

            // create order items
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id'     => $order->id,
                    'product_id'   => $item->product_id,
                    // Ensure this column exists in your migration & $fillable:
                    'product_name' => $item->product->name,
                    'price'        => $item->price,
                    'quantity'     => $item->quantity,
                ]);
            }

            // clear cart
            $user->cartItems()->delete();

            DB::commit();

            // redirect to success
            return redirect()->route('checkout.success', ['order' => $order->id]);

        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Checkout Error: '.$e->getMessage(), ['trace' => $e->getTraceAsString()]);
            // Show error on the same page so you see what's wrong
            return redirect()->route('checkout.index')->with('error', 'Checkout failed: '.$e->getMessage());
        }
    }

    // Success page - implicit model binding
    public function success(Order $order)
    {
        $order->load('orderItems');
        return view('cart.checkout-success', compact('order'));
    }
}
