<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;

class ProductAttributeController extends Controller
{
    public function create(Request $request)
    {
        $categories           = Category::all();
        $selectedCategory     = old('category_id') ?? $request->get('category_id');
        $subcategories        = $selectedCategory
            ? Subcategory::where('category_id', $selectedCategory)->get()
            : collect();
        $selectedSubcategory  = old('subcategory_id') ?? $request->get('subcategory_id');

        // show attributes strictly for chosen subcategory (or category-only when no subcategory)
        $attributes = collect();
        if ($selectedSubcategory) {
            $attributes = ProductAttribute::where('subcategory_id', $selectedSubcategory)->get();
        } elseif ($selectedCategory) {
            // optional: only category-level (global) attrs live here (subcategory_id NULL)
            $attributes = ProductAttribute::where('category_id', $selectedCategory)
                            ->whereNull('subcategory_id')
                            ->get();
        }

        return view('admin.product-attributes.create', compact(
            'categories','subcategories','selectedCategory','selectedSubcategory','attributes'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id'    => ['required','exists:categories,id'],
            'subcategory_id' => ['required','exists:subcategories,id'],
            'name'           => ['required','string','max:255'],
            'type'           => ['required','in:text,select'],
            'options'        => ['nullable','string'],
        ]);

        // (optional) ensure subcategory belongs to category
        abort_unless(
            Subcategory::where('id', $request->subcategory_id)
                ->where('category_id', $request->category_id)->exists(),
            422, 'Subcategory does not belong to the selected category.'
        );

        $options = $request->type === 'select' && $request->filled('options')
            ? json_encode(array_values(array_filter(array_map('trim', explode(',', $request->options)))))
            : null;

        ProductAttribute::create([
            'category_id'    => $request->category_id,
            'subcategory_id' => $request->subcategory_id, // ← tie to subcategory
            'name'           => $request->name,
            'type'           => $request->type,
            'options'        => $options,
        ]);

        return redirect()->route('admin.product-attributes.index')
            ->with('success', 'Attribute added successfully.');
    }

    public function index(Request $request)
    {
        // optional filters
        $q = ProductAttribute::with(['category','subcategory'])
            ->when($request->filled('category_id'), fn($qq) => $qq->where('category_id', $request->category_id))
            ->when($request->filled('subcategory_id'), fn($qq) => $qq->where('subcategory_id', $request->subcategory_id));

        $attributes = $q->get();
        $categories = Category::all();
        $subcategories = $request->filled('category_id')
            ? Subcategory::where('category_id', $request->category_id)->get()
            : Subcategory::all();

        return view('admin.product-attributes.index', compact('attributes','categories','subcategories'));
    }

    public function edit(ProductAttribute $productAttribute)
    {
        $categories          = Category::all();
        $selectedCategory    = old('category_id') ?? $productAttribute->category_id;
        $subcategories       = $selectedCategory
            ? Subcategory::where('category_id', $selectedCategory)->get()
            : collect();
        $selectedSubcategory = old('subcategory_id') ?? $productAttribute->subcategory_id;

        return view('admin.product-attributes.edit', compact(
            'productAttribute','categories','subcategories','selectedCategory','selectedSubcategory'
        ));
    }

    public function update(Request $request, ProductAttribute $productAttribute)
    {
        $request->validate([
            'category_id'    => ['required','exists:categories,id'],
            'subcategory_id' => ['required','exists:subcategories,id'],
            'name'           => ['required','string','max:255'],
            'type'           => ['required','in:text,select'],
            'options'        => ['nullable','string'],
        ]);

        abort_unless(
            Subcategory::where('id', $request->subcategory_id)
                ->where('category_id', $request->category_id)->exists(),
            422, 'Subcategory does not belong to the selected category.'
        );

        $options = $request->type === 'select' && $request->filled('options')
            ? json_encode(array_values(array_filter(array_map('trim', explode(',', $request->options)))))
            : null;

        $productAttribute->update([
            'category_id'    => $request->category_id,
            'subcategory_id' => $request->subcategory_id, // ← keep tied to subcategory
            'name'           => $request->name,
            'type'           => $request->type,
            'options'        => $options,
        ]);

        return redirect()->route('admin.product-attributes.index')
            ->with('success', 'Attribute updated successfully.');
    }

    public function destroy(ProductAttribute $productAttribute)
    {
        $productAttribute->delete();
        return redirect()->route('admin.product-attributes.index')->with('success', 'Attribute deleted successfully.');
    }

    public function getSubcategoriesByCategory($categoryId)
    {
        $subcategories = Subcategory::where('category_id', $categoryId)->get();
        return response()->json($subcategories);
    }

    // NEW: attributes by subcategory (for AJAX on product form)
    public function getAttributesBySubcategory($subcategoryId)
    {
        $attrs = ProductAttribute::where('subcategory_id', $subcategoryId)->get();
        return response()->json($attrs);
    }
}
