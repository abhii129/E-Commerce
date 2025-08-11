@extends('layouts.admin')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Edit Subcategory</h2>

    <form action="{{ route('admin.subcategories.update', $subcategory->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label for="category_id" class="block text-gray-700">Category</label>
            <select name="category_id" id="category_id" class="w-full p-2 border border-gray-300 rounded" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $subcategory->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="name" class="block text-gray-700">Subcategory Name</label>
            <input type="text" name="name" id="name" value="{{ $subcategory->name }}" class="w-full p-2 border border-gray-300 rounded" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Update Subcategory</button>
    </form>
@endsection
