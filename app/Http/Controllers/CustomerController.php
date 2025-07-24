<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\FooterMessage;


class CustomerController extends Controller
{
    public function index()
    {
        // Get the selected category from the request
        $categoryId = request()->input('category');
        
        // Base query with relationships
        $productsQuery = Product::with(['category', 'subcategory']);
        
        // Apply category filter if one is selected
        if ($categoryId) {
            $productsQuery->where('category_id', $categoryId);
        }
        
        // Paginate the results
        $products = $productsQuery->paginate(12);
        
        // Get all categories for the dropdown
        $categories = Category::all();
        
        // Get featured products (or random products if no featured ones)
        $featuredProducts = Product::inRandomOrder()->take(10)->get();
        
        return view('admin.customer.products.index', [
            'products' => $products,
            'categories' => $categories,
            'featuredProducts' => $featuredProducts,
            'selectedCategory' => $categoryId
        ]);
    }

    public function show($id)
    {
        // Find the product by ID and display the product details
        $product = Product::findOrFail($id);
        return view('admin.customer.products.show', compact('product'));
    }

    
}
