@extends('layouts.admin')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Add New Category</h2>

    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        
        {{-- Category Name --}}
        <div>
            <label for="name" class="block text-gray-700">Category Name</label>
            <input type="text" name="name" id="name" 
                   class="w-full p-2 border border-gray-300 rounded" required>
        </div>

        {{-- Image Source Choice --}}
        <div>
            <label class="block text-gray-700 mb-1">Category Image Source</label>
            <div class="flex gap-6 mb-2">
                <label>
                    <input type="radio" name="image_source" value="upload" checked>
                    Upload from device
                </label>
                <label>
                    <input type="radio" name="image_source" value="url">
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
                <input type="url" name="image_url" placeholder="https://example.com/image.jpg" 
                       class="w-full p-2 border border-gray-300 rounded">
            </div>
        </div>

        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">
            Create Category
        </button>
    </form>

    {{-- Script directly here so it always runs --}}
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

            // Change on radio click
            radios.forEach(radio => {
                radio.addEventListener('change', toggleImageInput);
            });
        });
    </script>
@endsection
