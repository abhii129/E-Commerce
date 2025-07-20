@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Subcategories</h2>
        <a href="{{ route('subcategories.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded">Add Subcategory</a>
    </div>

    <table class="min-w-full bg-white shadow-lg rounded">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">ID</th>
                <th class="py-2 px-4 border-b">Category</th>
                <th class="py-2 px-4 border-b">Subcategory Name</th>
                <th class="py-2 px-4 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subcategories as $subcategory)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $subcategory->id }}</td>
                    <td class="py-2 px-4 border-b">{{ $subcategory->category->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $subcategory->name }}</td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('subcategories.edit', $subcategory->id) }}" class="text-blue-500">Edit</a> |
                        <form action="{{ route('subcategories.destroy', $subcategory->id) }}" method="POST" class="inline">
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
