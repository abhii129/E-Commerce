@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="product-form-container">
            <h2 class="page-title">Create New Product</h2>

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="product-form">
                @csrf

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



                <!-- Product Name Field -->
                <div class="form-group mb-4">
                    <label for="name" class="form-label">Product Name:</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Price Field -->
                <div class="form-group mb-4">
                    <label for="price" class="form-label">Price ($):</label>
                    <input type="text" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description Field -->
                <div class="form-group mb-4">
                    <label for="description" class="form-label">Description:</label>
                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="4" required>{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Image Field -->
                <div class="form-group mb-4">
                    <label for="image" class="form-label">Image:</label>
                    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" required>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
            <div class="form-group mb-4">
                <button type="submit"
                        class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-semibold py-2 px-6 rounded shadow-md hover:shadow-lg hover:from-blue-600 hover:to-indigo-700 transition duration-300 ease-in-out">
                    🚀 Create Product
                </button>
            </div>

@endsection
