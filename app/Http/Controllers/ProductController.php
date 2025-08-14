<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Show create product form
     */
    public function create(Request $request)
    {
        $categories        = Category::all();
        $selectedCategory  = old('category_id') ?? $request->get('category_id');
        $subcategories     = Subcategory::all();

        // Attributes for selected category/subcategory
        $attributes = ProductAttribute::query()
            ->when($selectedCategory, fn ($q) => $q->where('category_id', $selectedCategory))
            ->when($request->get('subcategory_id'), fn ($q) => $q->orWhere('subcategory_id', $request->get('subcategory_id')))
            ->get();

        return view('admin.product.create', compact('categories', 'subcategories', 'selectedCategory', 'attributes'));
    }

    /**
     * List all products
     */
    public function index()
    {
        $products = Product::with(['category', 'subcategory'])->latest()->get();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Store product
     */
    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'category_id'                => ['required','exists:categories,id'],
            'subcategory_id'             => ['required','exists:subcategories,id'],
            'name'                       => ['required','string','max:255'],
            'description'                => ['required','string'],
            'brand'                      => ['nullable','string','max:255'],
            'image'                      => ['required','image','mimes:jpg,jpeg,png','max:2048'],
            'price'                      => ['required','numeric','min:0'],
            'availability'               => ['nullable','integer','min:0'],
            'attributes'                 => ['nullable','array'],
            'attributes.*.enabled'       => ['nullable','boolean'],
            'attributes.*.value'         => ['nullable','string','max:255'],
        ]);

        try {
            return DB::transaction(function () use ($request, $validated) {
                // Upload image
                if ($request->hasFile('image')) {
                    $validated['image'] = $request->file('image')->store('products', 'public');
                }

                $validated['availability'] = $validated['availability'] ?? 0;

                // Create product
                $product = Product::create($validated);

                // Sync dynamic attributes (checkbox + value)
                $summary = $this->syncProductAttributesFromRequest($product, $request->input('attributes', []));

                // Optionally store JSON summary on products table (requires casts on Product model)
                $product->setAttribute('attributes', $summary);
                $product->save();

                return redirect()
                    ->route('admin.products.index')
                    ->with('success', 'Product created successfully!');
            });
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->withInput()->withErrors([
                'general' => 'Something went wrong while creating the product: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Show edit product form
     */
    public function edit(Product $product, Request $request)
{
    $categories    = Category::all();
    $subcategories = Subcategory::all();

    // Use old() / query params if user changed selects on the form
    $selectedCategory    = old('category_id', $request->get('category_id', $product->category_id));
    $selectedSubcategory = old('subcategory_id', $request->get('subcategory_id', $product->subcategory_id));

    // Attributes for the chosen category/subcategory
    $attributes = ProductAttribute::query()
        ->when($selectedCategory, fn($q) => $q->where('category_id', $selectedCategory))
        ->when($selectedSubcategory, fn($q) => $q->orWhere('subcategory_id', $selectedSubcategory))
        ->get();

    // Preload values and make a quick lookup map
    $product->load('attributeValues');
    $values = $product->attributeValues->pluck('value', 'product_attribute_id'); // [attr_id => value]

    return view('admin.product.edit', compact(
        'product', 'categories', 'subcategories', 'attributes',
        'selectedCategory', 'selectedSubcategory', 'values'
    ));
}


    /**
     * Update product
     */
    public function update(Request $request, Product $product)
    {
        // Validation
        $validated = $request->validate([
            'name'                       => ['required','string','max:255'],
            'price'                      => ['required','numeric','min:0'],
            'category_id'                => ['required','exists:categories,id'],
            'subcategory_id'             => ['required','exists:subcategories,id'],
            'description'                => ['required','string'],
            'brand'                      => ['nullable','string','max:255'],
            'availability'               => ['nullable','integer','min:0'],
            'image'                      => ['nullable','image','mimes:jpg,jpeg,png','max:2048'],
            'attributes'                 => ['nullable','array'],
            'attributes.*.enabled'       => ['nullable','boolean'],
            'attributes.*.value'         => ['nullable','string','max:255'],
        ]);

        try {
            return DB::transaction(function () use ($request, $validated, $product) {
                // Image handling
                if ($request->hasFile('image')) {
                    if ($product->image && Storage::disk('public')->exists($product->image)) {
                        Storage::disk('public')->delete($product->image);
                    }
                    $validated['image'] = $request->file('image')->store('products', 'public');
                }

                $validated['availability'] = $validated['availability'] ?? $product->availability ?? 0;

                // Update product (excluding attributes array – handled separately)
                $product->update($validated);

                // Sync dynamic attributes
                $summary = $this->syncProductAttributesFromRequest($product, $request->input('attributes', []));

                // Update JSON summary on products table
                $product->setAttribute('attributes', $summary);
                $product->save();

                return redirect()->route('admin.products.index')->with('success', 'Product updated.');
            });
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['general' => 'Failed to update product: ' . $e->getMessage()]);
        }
    }

    /**
     * Delete product
     */
    public function destroy(Product $product)
    {
        try {
            // Delete image file if exists
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            // Delete attribute values
            ProductAttributeValue::where('product_id', $product->id)->delete();

            $product->delete();

            return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['general' => 'Failed to delete product: ' . $e->getMessage()]);
        }
    }

    /**
     * Products by category
     */
    public function categoryProducts(Category $category)
    {
        $products = $category->products()->paginate(20);
        return view('admin.customer.products.category', compact('category', 'products'));
    }

    /**
     * Update availability only
     */
    public function updateAvailability(Request $request, Product $product)
    {
        $data = $request->validate([
            'availability' => ['required','integer','min:0'],
        ]);

        try {
            $product->update(['availability' => $data['availability']]);
            return back()->with('success', 'Availability updated.');
        } catch (\Exception $e) {
            return back()->withErrors(['general' => 'Failed to update availability: ' . $e->getMessage()]);
        }
    }

    /**
     * PRIVATE: Sync product attribute values from nested request structure:
     * attributes[ATTR_ID][enabled] = 1|0
     * attributes[ATTR_ID][value]   = "..."
     *
     * Returns an array summary for storing on products.attributes JSON.
     */
    private function syncProductAttributesFromRequest(Product $product, array $incoming): array
    {
        $summary = [];
        $idsSeen = [];

        foreach ($incoming as $attributeId => $data) {
            $idsSeen[] = (int) $attributeId;

            $enabled = !empty($data['enabled']);
            $value   = $data['value'] ?? null;

            if ($enabled && $value !== null && $value !== '') {
                ProductAttributeValue::updateOrCreate(
                    [
                        'product_id'           => $product->id,
                        'product_attribute_id' => $attributeId,
                    ],
                    ['value' => $value]
                );

                $name = ProductAttribute::find($attributeId)?->name ?? $attributeId;
                $summary[$name] = $value;
            } else {
                // Remove any stale value if unchecked/empty
                ProductAttributeValue::where([
                    'product_id'           => $product->id,
                    'product_attribute_id' => $attributeId,
                ])->delete();
            }
        }

        // Optional: if some attributes were previously saved but not sent now, delete them
        // ProductAttributeValue::where('product_id', $product->id)
        //    ->when(!empty($idsSeen), fn($q) => $q->whereNotIn('product_attribute_id', $idsSeen))
        //    ->delete();

        return $summary;
    }
}
