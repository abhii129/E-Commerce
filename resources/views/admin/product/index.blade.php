
@extends('layouts.admin')

@section('content')
<link href="{{ asset('css/admin-products.css') }}" rel="stylesheet">
    <div class="admin-products-container">
        <div class="admin-header">
            <h1 class="admin-title">Products</h1>
            
            <div class="flex items-center gap-4">
                <p class="welcome-message">Welcome, {{ Auth::user()->name }}!</p>
                <a href="{{ route('admin.products.create') }}" class="add-product-btn">Add Product</a>
            </div>
        </div>
        

        <table class="products-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Subcategory</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->subcategory->name }}</td>
                        <td>${{ number_format($product->price, 2) }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="product-image">
                        </td>
                        <td class="flex items-center">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="action-link edit-link">Edit</a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn">Delete</button>
                            </form>
                            <a href="{{ route('customer.products.show', $product->id) }}" class="action-link view-link ml-2">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
