<?php


namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'image_source'  => 'required|in:upload,url',
            'image_file'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'image_url'     => 'nullable|url'
        ]);

        $imagePath = null;

        if ($request->image_source === 'upload' && $request->hasFile('image_file')) {
            $imagePath = $request->file('image_file')->store('categories', 'public');
            $imagePath = 'storage/' . $imagePath; // Public path
        } elseif ($request->image_source === 'url') {
            $imagePath = $request->image_url;
        }

        Category::create([
            'name' => $request->name,
            'image_url' => $imagePath
        ]);

        return redirect()->route('categories.index')->with('success', 'Category created successfully');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'image_source'  => 'nullable|in:upload,url',
            'image_file'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'image_url'     => 'nullable|url'
        ]);

        $imagePath = $category->image_url; // keep old image if not changed

        if ($request->image_source) {
            if ($request->image_source === 'upload' && $request->hasFile('image_file')) {
                // Optionally delete old file if stored locally
                if ($imagePath && str_starts_with($imagePath, 'storage/')) {
                    Storage::disk('public')->delete(str_replace('storage/', '', $imagePath));
                }
                $imagePath = 'storage/' . $request->file('image_file')->store('categories', 'public');
            } elseif ($request->image_source === 'url') {
                $imagePath = $request->image_url;
            }
        }

        $category->update([
            'name' => $request->name,
            'image_url' => $imagePath
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully');
    }

    public function destroy(Category $category)
    {
        if ($category->image_url && str_starts_with($category->image_url, 'storage/')) {
            Storage::disk('public')->delete(str_replace('storage/', '', $category->image_url));
        }

        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    }
}
