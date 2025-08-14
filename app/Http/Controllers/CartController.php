<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product;

class CartController extends Controller
{
    // Add to cart (defaults to +1 unless quantity passed)
    public function add(Request $request, Product $product)
    {
        $user = $request->user();
        $qtyToAdd = max(1, (int) $request->input('quantity', 1));

        // current qty in cart
        $existingQty = (int) $user->cartItems()
            ->where('product_id', $product->id)
            ->value('quantity');

        // ✅ Stock check
        if ($existingQty + $qtyToAdd > (int) $product->availability) {
            return back()->withErrors([
                'stock' => "Only {$product->availability} in stock for {$product->name}."
            ])->withInput();
        }

        // snapshot price + upsert
        $user->cartItems()->updateOrCreate(
            ['product_id' => $product->id],
            [
                'price'    => $product->price,
                'quantity' => $existingQty + $qtyToAdd,
            ]
        );

        return back()->with('success', 'Product added to cart!');
    }

    // Update line quantity to an exact number
    public function updateQuantity(Request $request, Product $product)
    {
        $user = $request->user();
        $newQty = max(1, (int) $request->input('quantity', 1));

        if ($newQty > (int) $product->availability) {
            return back()->withErrors([
                'stock' => "Only {$product->availability} in stock for {$product->name}."
            ])->withInput();
        }

        $item = $user->cartItems()->where('product_id', $product->id)->first();
        if (!$item) {
            return back()->withErrors(['cart' => 'Item not found in your cart.']);
        }

        $item->update(['quantity' => $newQty]);

        return back()->with('success', 'Quantity updated.');
    }

    // Remove line from cart
    public function remove(Request $request, Product $product)
    {
        $request->user()->cartItems()->where('product_id', $product->id)->delete();
        return back()->with('success', 'Product removed from cart!');
    }

    // View cart
    public function view()
    {
        $cartItems = auth()->user()->cartItems()->with('product')->get();
        return view('cart.show', compact('cartItems'));
    }
}
