@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Categories</h2>
            <a href="{{ route('admin.categories.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded">Add New Category</a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-2 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full bg-white shadow-lg rounded">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">ID</th>
                    <th class="py-2 px-4 border-b">Image</th>
                    <th class="py-2 px-4 border-b">Category Name</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $category->id }}</td>
                        <td class="py-2 px-4 border-b">
                            @if($category->image_url)
                                <img src="{{ $category->image_url }}" alt="{{ $category->name }}" class="w-12 h-12 object-cover rounded">
                            @else
                                <img src="{{ asset('images/default-category.jpg') }}" alt="Default" class="w-12 h-12 object-cover rounded">
                            @endif
                        </td>
                        <td class="py-2 px-4 border-b">{{ $category->name }}</td>
                        <td class="py-2 px-4 border-b">
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-blue-500">Edit</a> |
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
