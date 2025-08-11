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
            'description' => 'required|string',
            'image' => 'required|image',
            'brand' => 'nullable|string|max:255',
            'fit_type' => 'nullable|string|max:255',
            'gender' => 'nullable|in:male,female,unisex',
            'availability' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0', // single product price
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
            'price' => $request->price,
        ]);

        return redirect()->route('admin.product.index')->with('success', 'Product created successfully!');
    }

    public function destroy(Product $product)
    {
        if ($product->image && \Storage::disk('public')->exists($product->image)) {
            \Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return redirect()->route('admin.product.index')->with('success', 'Product deleted successfully.');
    }

    // Category Product listing (if you need to show by category)
    
 
public function categoryProducts(\App\Models\Category $category)
 {
     $products = $category->products()->paginate(20);
     return view('admin.customer.products.category', compact('category', 'products'));
 }

    

    public function edit(Product $product)
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('admin.product.edit', compact('product','categories','subcategories'));
    }

    public function update(Request $request, Product $product)
{
    $data = $request->validate([
        'name'           => ['required','string','max:255'],
        'price'          => ['required','numeric'],
        'category_id'    => ['required','exists:categories,id'],
        'subcategory_id' => ['nullable','exists:subcategories,id'],
        'description'    => ['nullable','string'],
        // add any other fields you actually use, e.g. 'brand','fit_type','gender','availability','image'
        'image' => ['nullable','image','max:2048'],
    ]);

    
    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('products', 'public');
        $data['image'] = $path;
    }
    

    $product->update($data);

    return redirect()
        ->route('admin.products.index')
        ->with('success', 'Product updated.');
}
}