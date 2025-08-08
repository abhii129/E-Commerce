<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product;

class CartController extends Controller
{
    public function add(Request $request, $productId)
    {
        $user = auth()->user();

        $cartItem = CartItem::firstOrCreate(
            ['user_id' => $user->id, 'product_id' => $productId],
            ['price' => Product::findOrFail($productId)->price]
        );
        $cartItem->quantity += 1;
        $cartItem->save();

        return back()->with('success', 'Product added to cart!');
    }

    public function remove(Request $request, $productId)
    {
        $user = auth()->user();
        CartItem::where('user_id', $user->id)->where('product_id', $productId)->delete();
        return back()->with('success', 'Product removed from cart!');
    }

    public function view()
    {
        $cartItems = auth()->user()->cartItems()->with('product')->get();
        return view('cart.show', compact('cartItems'));
    }

    public function updateQuantity(Request $request, $productId)
{
    $request->validate([
        'quantity' => 'required|integer|min:1',
    ]);

    $cartItem = \App\Models\CartItem::where('user_id', auth()->id())
        ->where('product_id', $productId)
        ->first();

    if ($cartItem) {
        $cartItem->quantity = $request->quantity;
        $cartItem->save();
    }

    return back()->with('success', 'Cart updated.');
    }
    
    public function show()
    {
        $cartItems = auth()->user()->cartItems()->with('product')->get();
        return view('cart.show', compact('cartItems'));
    }

}
