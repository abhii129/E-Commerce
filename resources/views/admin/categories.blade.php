@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Categories</h2>
        <a href="{{ route('categories.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded">Add Category</a>
    </div>

    <table class="min-w-full bg-white shadow-lg rounded">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">ID</th>
                <th class="py-2 px-4 border-b">Category Name</th>
                <th class="py-2 px-4 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $category->id }}</td>
                    <td class="py-2 px-4 border-b">{{ $category->name }}</td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('categories.edit', $category->id) }}" class="text-blue-500">Edit</a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
