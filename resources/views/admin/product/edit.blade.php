@extends('layouts.admin')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Edit Product</h2>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <!-- Category -->
        <div class="form-group mb-4">
            <label for="category_id" class="form-label">Category:</label>
            <select name="category_id" id="category_id" class="form-control" onchange="this.form.submit()">
                <option value="">Select a Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Subcategory -->
        <div class="form-group mb-4">
            <label for="subcategory_id" class="form-label">Subcategory:</label>
            <select name="subcategory_id" id="subcategory_id" class="form-control">
                <option value="">Select a Subcategory</option>
                @foreach($subcategories as $subcategory)
                    @if(old('category_id', $product->category_id) == $subcategory->category_id)
                        <option value="{{ $subcategory->id }}"
                            {{ old('subcategory_id', $product->subcategory_id) == $subcategory->id ? 'selected' : '' }}>
                            {{ $subcategory->name }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>

        <!-- Name -->
        <div>
            <label for="name" class="form-label">Product Name:</label>
            <input type="text" name="name" id="name" class="form-control"
                   value="{{ old('name', $product->name) }}" required>
        </div>

        <!-- Price -->
        <div>
            <label for="price" class="form-label">Price (€):</label>
            <input type="text" name="price" id="price" class="form-control"
                   value="{{ old('price', $product->price) }}" required>
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="form-label">Description:</label>
            <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
        </div>

        <!-- Optional: Image display (not editable here) -->
        <div>
            <label class="form-label">Current Image:</label><br>
            <img src="{{ asset('storage/' . $product->image) }}" width="120" class="mb-2">
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-primary">Update Product</button>
    </form>
@endsection
