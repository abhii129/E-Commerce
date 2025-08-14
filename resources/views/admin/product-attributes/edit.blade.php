@extends('layouts.admin')

@section('content')
<div class="admin-container">
    <div class="attribute-form">
        <div class="form-header">
            <h1 class="form-title">Edit Product Attribute</h1>
        </div>

        <form action="{{ route('admin.product-attributes.update', $productAttribute->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Category -->
            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="">Select a Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $selectedCategory == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Subcategory -->
            <div class="form-group">
                <label for="subcategory_id">Subcategory</label>
                <select name="subcategory_id" id="subcategory_id" class="form-control">
                    <option value="">Select a Subcategory</option>
                    @foreach($subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}" {{ $productAttribute->subcategory_id == $subcategory->id ? 'selected' : '' }}>
                            {{ $subcategory->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Name -->
            <div class="form-group">
                <label for="name">Attribute Name</label>
                <input type="text" name="name" value="{{ old('name', $productAttribute->name) }}" class="form-control" required>
            </div>

            <!-- Type -->
            <div class="form-group">
                <label for="type">Type</label>
                <select name="type" id="type" class="form-control">
                    <option value="text" {{ $productAttribute->type == 'text' ? 'selected' : '' }}>Text</option>
                    <option value="select" {{ $productAttribute->type == 'select' ? 'selected' : '' }}>Select</option>
                </select>
            </div>

            <!-- Options -->
            <div class="form-group" id="options-container" style="{{ $productAttribute->type == 'select' ? '' : 'display:none;' }}">
                <label for="options">Options (comma separated)</label>
                <input type="text" name="options" value="{{ $productAttribute->options ? implode(',', json_decode($productAttribute->options)) : '' }}" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Update Attribute</button>
            <a href="{{ route('admin.product-attributes.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<script>
    document.getElementById('type').addEventListener('change', function() {
        const optionsContainer = document.getElementById('options-container');
        optionsContainer.style.display = this.value === 'select' ? 'block' : 'none';
    });
</script>
@endsection
