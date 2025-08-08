@extends('layouts.app')

@section('content')
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center gap-6">
            <div class="bg-white p-4 rounded-full shadow-md">
                <i class="fas fa-cube text-4xl text-indigo-600"></i>
            </div>
            <div>
                <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>
                <p class="text-lg text-gray-600">Full description, reviews, and buying options available below.</p>
            </div>
        </div>
    </div>

    <div class="container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden flex flex-col md:flex-row">
            <!-- Image Panel -->
            <div class="md:w-1/2 relative p-6">
                @if($product->is_new)
                    <span class="absolute top-6 left-6 bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full z-10">NEW</span>
                @endif
                <div class="aspect-w-1 aspect-h-1 bg-gray-100 rounded-lg overflow-hidden">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                         class="w-full h-full object-contain object-center transition duration-500 ease-in-out transform hover:scale-105">
                </div>
            </div>

            <!-- Info Panel -->
            <div class="md:w-1/2 p-8 flex flex-col justify-between">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Product Details</h2>
                    <p class="text-gray-600 mb-6 leading-relaxed">{{ $product->description }}</p>
                    
                    <div class="mb-4">
                        <span class="text-3xl font-bold text-gray-900">€{{ number_format($product->price, 2) }}</span>
                        @if($product->compare_price)
                            <span class="ml-3 text-lg text-gray-500 line-through">€{{ number_format($product->compare_price, 2) }}</span>
                            <span class="ml-3 bg-red-100 text-red-800 text-sm font-medium px-2.5 py-0.5 rounded">
                                {{ round(100 - ($product->price / $product->compare_price * 100)) }}% OFF
                            </span>
                        @endif
                    </div>

                    <ul class="mb-6 space-y-1 text-gray-700">
                        @if($product->brand)
                            <li><strong>Brand:</strong> {{ $product->brand }}</li>
                        @endif
                        @if($product->fit_type)
                            <li><strong>Fit Type:</strong> {{ $product->fit_type }}</li>
                        @endif
                        @if($product->gender)
                            <li><strong>Gender:</strong> {{ ucfirst($product->gender) }}</li>
                        @endif
                        <li><strong>Availability:</strong> {{ $product->availability }} in stock</li>
                    </ul>
                </div>

                @auth
                    <form method="POST" action="{{ route('cart.add', $product->id) }}" class="mt-auto">
                        @csrf
                        <div class="flex items-center gap-4 mb-4">
                            <div class="flex items-center border border-gray-300 rounded-md">
                                <button type="button" class="px-3 py-2 text-gray-600 hover:bg-gray-100" onclick="decreaseQuantity()">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" name="quantity" value="1" min="1" 
                                       class="w-12 text-center border-0 focus:ring-0" id="quantityInput">
                                <button type="button" class="px-3 py-2 text-gray-600 hover:bg-gray-100" onclick="increaseQuantity()">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button type="submit" 
                                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200 flex items-center justify-center gap-2">
                            <i class="fas fa-shopping-cart"></i> Add to Cart
                        </button>
                        <a href="{{ route('cart.show') }}" 
                           class="mt-4 inline-block w-full text-center bg-gray-800 text-white font-semibold py-3 rounded-lg hover:bg-gray-900 transition">
                            Go to Cart
                        </a>
                    </form>
                @else
                    <a href="{{ route('login') }}" 
                       class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200 block text-center">
                        Login to Purchase
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <script>
        function increaseQuantity() {
            const input = document.getElementById('quantityInput');
            input.value = parseInt(input.value) + 1;
        }
        function decreaseQuantity() {
            const input = document.getElementById('quantityInput');
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        }
    </script>
@endsection
