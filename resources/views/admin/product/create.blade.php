@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="product-form-container">
        <h2 class="page-title">Create New Product</h2>
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="product-form">
            @csrf

            <!-- Category -->
            <select name="category_id" id="category_id"
                    class="form-control @error('category_id') is-invalid @enderror"
                    onchange="this.form.submit()">
                <option value="">Select a Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ (old('category_id') ?? $selectedCategory) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <!-- Subcategory -->
            <select name="subcategory_id" id="subcategory_id"
                    class="form-control @error('subcategory_id') is-invalid @enderror">
                <option value="">Select a Subcategory</option>
                @foreach($subcategories as $subcategory)
                    @if($selectedCategory == $subcategory->category_id)
                        <option value="{{ $subcategory->id }}"
                            {{ old('subcategory_id') == $subcategory->id ? 'selected' : '' }}>
                            {{ $subcategory->name }}
                        </option>
                    @endif
                @endforeach
            </select>

            <!-- Product Name -->
            <div class="form-group mb-4">
                <label for="name" class="form-label">Product Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <!-- Brand -->
            <div class="form-group mb-4">
                <label for="brand" class="form-label">Brand:</label>
                <input type="text" name="brand" id="brand" class="form-control" value="{{ old('brand') }}">
            </div>

            <!-- Fit Type -->
            <div class="form-group mb-4">
                <label for="fit_type" class="form-label">Fit Type:</label>
                <input type="text" name="fit_type" id="fit_type" class="form-control" value="{{ old('fit_type') }}">
            </div>

            <!-- Gender -->
            <div class="form-group mb-4">
                <label for="gender" class="form-label">Gender:</label>
                <select name="gender" id="gender" class="form-control">
                    <option value="">Select</option>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="unisex" {{ old('gender') == 'unisex' ? 'selected' : '' }}>Unisex</option>
                </select>
            </div>

            <!-- Availability -->
            <div class="form-group mb-4">
                <label for="availability" class="form-label">Availability:</label>
                <input type="number" name="availability" id="availability" class="form-control" value="{{ old('availability', 0) }}" min="0">
            </div>

            <!-- Description -->
            <div class="form-group mb-4">
                <label for="description" class="form-label">Description:</label>
                <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
            </div>

            <!-- Image -->
            <div class="form-group mb-4">
                <label for="image" class="form-label">Image:</label>
                <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
            </div>

            <!-- Simple Price -->
            <div class="form-group mb-4">
                <label for="price" class="form-label">Price ($):</label>
                <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror"
                       step="0.01" min="0" value="{{ old('price') }}" required>
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-4">
                <button type="submit"
                        class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-semibold py-2 px-6 rounded shadow-md hover:shadow-lg hover:from-blue-600 hover:to-indigo-700 transition duration-300 ease-in-out">
                    🚀 Create Product
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
