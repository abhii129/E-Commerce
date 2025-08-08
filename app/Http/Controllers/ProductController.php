<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductVariation;


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
        'description' => 'required|string',
        'image' => 'required|image|mimes:jpg,jpeg,png',
        'brand' => 'nullable|string|max:255',
        'fit_type' => 'nullable|string|max:255',
        'gender' => 'nullable|in:male,female,unisex',
        'availability' => 'required|integer|min:0',
        'price' => 'required|numeric|min:0', // base price validation
        'variations.*.price_adjustment' => 'nullable|numeric|min:0', // variation price adjustment validation
    ]);

    $imagePath = $request->file('image')->store('products', 'public');

    $product = Product::create([
        'category_id' => $request->category_id,
        'subcategory_id' => $request->subcategory_id,
        'name' => $request->name,
        'description' => $request->description,
        'image' => $imagePath,
        'brand' => $request->brand,
        'fit_type' => $request->fit_type,
        'gender' => $request->gender,
        'availability' => $request->availability,
        'price' => $request->price, // Save base price
    ]);

    // Save variations with price_adjustment
    if ($request->has('variations')) {
        foreach ($request->input('variations') as $variation) {
            if (isset($variation['price_adjustment']) && $variation['price_adjustment'] !== '') {
                $product->variations()->create([
                    'size' => $variation['size'] ?? null,
                    'color' => $variation['color'] ?? null,
                    'price_adjustment' => $variation['price_adjustment'],
                ]);
            }
        }
    }

    return redirect()->route('products.index')->with('success', 'Product created successfully!');
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
