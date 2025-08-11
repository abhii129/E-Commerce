@extends('layouts.admin')

@section('content')
<div class="container mx-auto max-w-3xl">
    <h2 class="text-xl font-semibold mb-6">Edit Category</h2>

    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        {{-- Category Name --}}
        <div>
            <label for="name" class="block text-gray-700 font-medium">Category Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}"
                   class="w-full mt-1 p-2 border border-gray-300 rounded" required>
        </div>

        {{-- Current Image --}}
        @if($category->image_url)
            <div>
                <p class="text-gray-700 mb-1 font-medium">Current Image:</p>
                <img src="{{ $category->image_url }}" alt="{{ $category->name }}" class="w-32 h-32 object-cover border rounded">
            </div>
        @endif

        {{-- Image Source Choice --}}
        <div>
            <label class="block text-gray-700 font-medium mb-1">Change Category Image</label>
            <div class="flex items-center gap-6 mb-3">
                <label>
                    <input type="radio" name="image_source" value="upload"
                        {{ !$category->image_url || str_starts_with($category->image_url, 'storage/') ? 'checked' : '' }}>
                    Upload from device
                </label>
                <label>
                    <input type="radio" name="image_source" value="url"
                        {{ $category->image_url && !str_starts_with($category->image_url, 'storage/') ? 'checked' : '' }}>
                    Use image URL
                </label>
            </div>

            {{-- File Upload --}}
            <div id="imageUploadField">
                <input type="file" name="image_file" accept="image/*"
                       class="w-full p-2 border border-gray-300 rounded">
            </div>

            {{-- URL Input --}}
            <div id="imageUrlField" style="display: none;">
                <input type="url" name="image_url"
                       value="{{ $category->image_url && !str_starts_with($category->image_url, 'storage/') ? $category->image_url : '' }}"
                       placeholder="https://example.com/image.jpg"
                       class="w-full p-2 border border-gray-300 rounded">
            </div>
        </div>

        {{-- Submit --}}
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
            Update Category
        </button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const radios = document.querySelectorAll('input[name="image_source"]');
    const uploadField = document.getElementById('imageUploadField');
    const urlField = document.getElementById('imageUrlField');

    function toggleImageInput() {
        if (document.querySelector('input[name="image_source"]:checked').value === 'upload') {
            uploadField.style.display = 'block';
            urlField.style.display = 'none';
        } else {
            uploadField.style.display = 'none';
            urlField.style.display = 'block';
        }
    }

    // Run once on page load
    toggleImageInput();

    // Listen to changes
    radios.forEach(radio => radio.addEventListener('change', toggleImageInput));
});
</script>
@endsection
