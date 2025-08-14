@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="product-form-container">
        <h2 class="page-title">Create New Product</h2>

        @if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


        <!-- Separate GET Form for Category Selection -->
        <form method="GET" action="{{ route('admin.products.create') }}">
            <select name="category_id" id="category_id" class="form-control mb-4" onchange="this.form.submit()">
                <option value="">Select a Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </form>

        <!-- Main POST Form for Creating Product -->
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="product-form">
            @csrf

            <!-- Hidden input to persist selected category -->
            <input type="hidden" name="category_id" value="{{ request('category_id') }}">

            <!-- Subcategory -->
            <select name="subcategory_id" id="subcategory_id"
                    class="form-control @error('subcategory_id') is-invalid @enderror mb-4">
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

            <!-- Product fields (name, price, brand, etc.) remain unchanged -->
            <!-- Make sure all input fields are inside this form only -->

            <!-- Product Name -->
            <div class="form-group mb-4">
                <label for="name">Product Name:</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <!-- Product Attributes -->
            @if($attributes->count())
  <h3>Product Attributes</h3>

  @foreach($attributes as $attribute)
    @php
      $oldEnabled = old("attributes.$attribute->id.enabled");
      $oldValue   = old("attributes.$attribute->id.value");
      $isOn       = (string)$oldEnabled === '1';
      $options    = $attribute->type === 'select'
                    ? (json_decode($attribute->options, true) ?? [])
                    : [];
    @endphp

    <div class="form-group mb-4">
      <div class="form-check mb-2">
        <input
          type="checkbox"
          class="form-check-input attr-toggle"
          id="attr_chk_{{ $attribute->id }}"
          name="attributes[{{ $attribute->id }}][enabled]"
          value="1"
          {{ $isOn ? 'checked' : '' }}
          data-target="#attr_wrap_{{ $attribute->id }}"
          data-input="#attr_input_{{ $attribute->id }}"
        >
        <label class="form-check-label" for="attr_chk_{{ $attribute->id }}">
          Use {{ $attribute->name }}
        </label>
      </div>

      <div id="attr_wrap_{{ $attribute->id }}" class="{{ $isOn ? '' : 'd-none' }}">
        @if($attribute->type === 'text')
          <input
            type="text"
            class="form-control"
            id="attr_input_{{ $attribute->id }}"
            name="attributes[{{ $attribute->id }}][value]"
            value="{{ $oldValue }}"
            {{ $isOn ? '' : 'disabled' }}
            placeholder="Enter {{ strtolower($attribute->name) }}"
          >
        @elseif($attribute->type === 'select')
          <select
            class="form-control"
            id="attr_input_{{ $attribute->id }}"
            name="attributes[{{ $attribute->id }}][value]"
            {{ $isOn ? '' : 'disabled' }}
          >
            <option value="">-- Select {{ $attribute->name }} --</option>
            @foreach($options as $opt)
              <option value="{{ $opt }}" {{ $oldValue == $opt ? 'selected' : '' }}>
                {{ $opt }}
              </option>
            @endforeach
          </select>
        @endif
      </div>
    </div>
  @endforeach
@endif


            <!-- Rest: brand, price, image, etc. -->

            <div class="form-group mb-4">
                <label for="brand">Brand:</label>
                <input type="text" name="brand" class="form-control">
            </div>

            <div class="form-group mb-4">
    <label for="description">Description:</label>
    <textarea name="description" id="description" class="form-control" required>{{ old('description') }}</textarea>
</div>


            <div class="form-group mb-4">
                <label for="price">Price:</label>
                <input type="number" name="price" class="form-control" step="0.01" required>
            </div>

            <div class="form-group mb-4">
                <label for="availability">Availability:</label>
                <input type="number" name="availability" class="form-control" value="0" min="0">
            </div>

            <div class="form-group mb-4">
                <label for="image">Image:</label>
                <input type="file" name="image" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Create Product</button>
        </form>
    </div>
</div>
@endsection


<script>
document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.attr-toggle').forEach(function(chk) {
    chk.addEventListener('change', function() {
      const target = document.querySelector(this.dataset.target);
      const input  = document.querySelector(this.dataset.input);
      if (this.checked) {
        target && target.classList.remove('d-none');
        input && input.removeAttribute('disabled');
      } else {
        target && target.classList.add('d-none');
        input && input.setAttribute('disabled', 'disabled');
        if (input && input.tagName === 'SELECT') input.selectedIndex = 0;
        if (input && input.tagName === 'INPUT')  input.value = '';
      }
    });
  });
});
</script>

<style>
.d-none { display: none !important; }
</style>
