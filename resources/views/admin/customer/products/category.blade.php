@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Products in Category: {{ $category->name }}</h1>

    @if($products->count())
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($products as $product)
                <div class="border rounded p-4">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="mb-4 w-full h-48 object-cover">
                    <h2 class="text-xl font-semibold mb-2">{{ $product->name }}</h2>
                    <p class="text-gray-700 mb-2">{{ Str::limit($product->description, 100) }}</p>
                    <span class="font-bold text-indigo-600">€{{ number_format($product->price, 2) }}</span>
                    <div class="mt-4">
                        <a href="{{ route('customer.products.show', $product->id) }}" class="text-blue-500 hover:underline">View Details</a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $products->links() }} {{-- pagination --}}
        </div>
    @else
        <p>No products found in this category.</p>
    @endif
</div>
@endsection
