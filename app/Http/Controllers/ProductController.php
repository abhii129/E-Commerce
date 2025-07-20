<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create(Request $request)
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
    
        $selectedCategory = old('category_id') ?? $request->get('category_id');
    
        return view('admin.product.create', compact('categories', 'subcategories', 'selectedCategory'));
    }
    
    public function index()
    {
        $products = Product::with(['category', 'subcategory'])->latest()->get();
    
        return view('admin.product.index', compact('products'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png',
        ]);

        // Store image
        $imagePath = $request->file('image')->store('products', 'public');

        // Store the product
        Product::create([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
{
    // Optionally delete the image
    if ($product->image && \Storage::disk('public')->exists($product->image)) {
        \Storage::disk('public')->delete($product->image);
    }

    $product->delete();

    return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
}

}
