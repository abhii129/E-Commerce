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

        <!-- Product Attributes -->
        @if($attributes->count())
  <div class="mb-4">
    <h3 class="text-lg font-semibold mb-3">Product Attributes</h3>

    @foreach($attributes as $attribute)
      @php
        // value already saved for this product?
        $savedValue = old("attributes.$attribute->id.value", $values[$attribute->id] ?? '');
        $enabled    = old("attributes.$attribute->id.enabled", isset($values[$attribute->id]) ? '1' : null);
        $isOn       = (string)$enabled === '1';
        $options    = $attribute->type === 'select'
                      ? (json_decode($attribute->options, true) ?? [])
                      : [];
      @endphp

      <div class="form-group mb-3">
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
              value="{{ $savedValue }}"
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
                <option value="{{ $opt }}" {{ $savedValue == $opt ? 'selected' : '' }}>
                  {{ $opt }}
                </option>
              @endforeach
            </select>
          @endif
        </div>
      </div>
    @endforeach
  </div>
@endif

{{-- keep this JS once in the page --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.attr-toggle').forEach(function(chk) {
    const onChange = function() {
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
    };
    chk.addEventListener('change', onChange);
  });
});
</script>
<style>.d-none{display:none!important}</style>



        <!-- Optional: Image display (not editable here) -->
        <div>
            <label class="form-label">Current Image:</label><br>
            <img src="{{ asset('storage/' . $product->image) }}" width="120" class="mb-2">
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-primary">Update Product</button>
    </form>
@endsection
