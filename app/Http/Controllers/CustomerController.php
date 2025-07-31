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

    public function showFooterSection(string $section_key)
    {
        $section = \App\Models\FooterSection::where('section_key', $section_key)->first();
        $data = $section?->data ?? [];
    
        // Pass the data to a front-end Blade view for rendering
        return view('footer.sections.' . $section_key, [
            'data' => $data,
        ]);
    }


    public function show($id)
{
    // Find the product by ID with related category and subcategory
    $product = Product::with('category', 'subcategory')->findOrFail($id);

    // You can get additional data if needed, e.g., related products, breadcrumbs etc.

    // Return a frontend view showing product details
    return view('admin.customer.products.show', [ 'product' => $product ]);
}

   
}
