@extends('layouts.admin')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Add New Subcategory</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('subcategories.store') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Category Selection -->
        <div>
            <label for="category_id" class="block text-gray-700">Select Category</label>
            <select name="category_id" id="category_id" class="w-full p-2 border border-gray-300 rounded @error('category_id') border-red-500 @enderror" required>
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Subcategory Name -->
        <div>
            <label for="name" class="block text-gray-700">Subcategory Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="w-full p-2 border border-gray-300 rounded @error('name') border-red-500 @enderror" required>
            @error('name')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit -->
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Create Subcategory</button>
    </form>
@endsection
