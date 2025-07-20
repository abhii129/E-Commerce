@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Products</h2>
        <a href="{{ route('products.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded">Add Product</a>
    </div>

    <table class="min-w-full bg-white shadow-lg rounded">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">ID</th>
                <th class="py-2 px-4 border-b">Product Name</th>
                <th class="py-2 px-4 border-b">Category</th>
                <th class="py-2 px-4 border-b">Subcategory</th>
                <th class="py-2 px-4 border-b">Price</th>
                <th class="py-2 px-4 border-b">Image</th>
                <th class="py-2 px-4 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $product->id }}</td>
                    <td class="py-2 px-4 border-b">{{ $product->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $product->category->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $product->subcategory->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $product->price }}</td>
                    <td class="py-2 px-4 border-b">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="w-20 h-20 object-cover rounded">
                    </td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('products.edit', $product->id) }}" class="text-blue-500">Edit</a> |
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline ml-2">
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
