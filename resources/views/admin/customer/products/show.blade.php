@extends('layouts.app')

@section('content')
<!-- Hero Banner with Product Image -->
<div class="relative bg-gradient-to-b from-gray-900 to-gray-800 h-96 overflow-hidden">
    <div class="absolute inset-0 bg-black opacity-40"></div>
    <div class="absolute inset-0 flex items-center justify-center">
        <div class="text-center px-6 max-w-4xl">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 animate-fade-in">{{ $product->name }}</h1>
            <p class="text-xl text-gray-200 mb-6">{{ $product->short_description ?? 'Premium quality product for your lifestyle' }}</p>
            <a href="#product-details" class="inline-flex items-center px-6 py-3 bg-white bg-opacity-20 text-white font-medium rounded-full hover:bg-opacity-30 transition-all border border-white border-opacity-30 backdrop-blur-sm">
                Explore Details
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M16.707 10.293a1 1 0 010 1.414l-6 6a1 1 0 01-1.414 0l-6-6a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l4.293-4.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
    </div>
</div>
<!-- Product Details Section -->
<div id="product-details" class="container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="flex flex-col lg:flex-row gap-12">
        <!-- Image Gallery -->
        <div class="lg:w-1/2">
            <div class="sticky top-24">
                <!-- Main Image -->
                <div class="relative bg-white rounded-2xl shadow-xl overflow-hidden mb-6">
                    @if($product->is_new)
                        <span class="absolute top-4 left-4 bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full z-10 shadow-md">NEW ARRIVAL</span>
                    @endif
                    <div class="aspect-w-1 aspect-h-1 bg-gray-50">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                             class="w-full h-full object-contain object-center p-8">
                    </div>
                </div>
                
                <!-- Thumbnail Gallery (if you have multiple images) -->
                <div class="flex gap-3">
                    <div class="w-20 h-20 rounded-lg border-2 border-indigo-400 overflow-hidden cursor-pointer">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                             class="w-full h-full object-cover">
                    </div>
                    <!-- Additional thumbnails would go here -->
                </div>
            </div>
        </div>

        <!-- Product Info -->
        <div class="lg:w-1/2">
            <!-- Price & Badges -->
            <div class="flex flex-wrap items-center gap-4 mb-6">
                <span class="text-4xl font-bold text-gray-900">€{{ number_format($product->price, 2) }}</span>
                @if($product->compare_price)
                    <span class="text-xl text-gray-500 line-through">€{{ number_format($product->compare_price, 2) }}</span>
                    <span class="bg-red-100 text-red-800 text-sm font-semibold px-3 py-1 rounded-full">
                        {{ round(100 - ($product->price / $product->compare_price * 100)) }}% OFF
                    </span>
                @endif
                
                @if($product->availability > 0)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                        <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-green-500" fill="currentColor" viewBox="0 0 8 8">
                            <circle cx="4" cy="4" r="3" />
                        </svg>
                        In Stock ({{ $product->availability }})
                    </span>
                @else
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                        <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-red-500" fill="currentColor" viewBox="0 0 8 8">
                            <circle cx="4" cy="4" r="3" />
                        </svg>
                        Out of Stock
                    </span>
                @endif
            </div>

            <!-- Product Meta -->
            <div class="mb-8">
                <h2 class="text-2xl font-semibold text-gray-800 mb-3">Details</h2>
                <p class="text-gray-600 mb-6 leading-relaxed">{{ $product->description }}</p>
                
                <div class="grid grid-cols-2 gap-4 mb-6">
                    @if($product->brand)
                        <div class="bg-gray-50 p-3 rounded-lg">
                            <h3 class="text-xs font-medium text-gray-500 uppercase tracking-wider">Brand</h3>
                            <p class="text-gray-900 font-medium">{{ $product->brand }}</p>
                        </div>
                    @endif
                    @if($product->fit_type)
                        <div class="bg-gray-50 p-3 rounded-lg">
                            <h3 class="text-xs font-medium text-gray-500 uppercase tracking-wider">Fit Type</h3>
                            <p class="text-gray-900 font-medium">{{ $product->fit_type }}</p>
                        </div>
                    @endif
                    @if($product->gender)
                        <div class="bg-gray-50 p-3 rounded-lg">
                            <h3 class="text-xs font-medium text-gray-500 uppercase tracking-wider">Gender</h3>
                            <p class="text-gray-900 font-medium">{{ ucfirst($product->gender) }}</p>
                        </div>
                    @endif
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <h3 class="text-xs font-medium text-gray-500 uppercase tracking-wider">SKU</h3>
                        <p class="text-gray-900 font-medium">{{ $product->sku ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

                        @if($product->attributeValues->count())
                <div class="mb-8">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-3">Product Attributes</h2>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($product->attributeValues as $attrValue)
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <h3 class="text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ $attrValue->attribute->name }}
                                </h3>
                                <p class="text-gray-900 font-medium">{{ $attrValue->value }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif


            <!-- Add to Cart Section -->
            @auth
                <form method="POST" action="{{ route('cart.add', $product->id) }}" class="bg-gray-50 rounded-xl p-6 shadow-sm">
                    @csrf
                    <div class="flex flex-col sm:flex-row gap-4 mb-6">
                        <!-- Quantity Selector -->
                        <div class="flex items-center border border-gray-200 rounded-lg overflow-hidden bg-white">
                            <button type="button" onclick="decreaseQuantity()" class="px-4 py-3 text-gray-500 hover:bg-gray-100 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                </svg>
                            </button>
                            <input type="number" name="quantity" value="1" min="1" max="{{ $product->availability }}"
                                   class="w-16 text-center border-0 focus:ring-0 text-gray-900 font-medium" id="quantityInput">
                            <button type="button" onclick="increaseQuantity()" class="px-4 py-3 text-gray-500 hover:bg-gray-100 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </button>
                        </div>

                        <!-- Add to Cart Button -->
                        <button type="submit" class="flex-1 bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white font-semibold py-3 px-6 rounded-lg transition-all shadow-md hover:shadow-lg flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Add to Cart
                        </button>
                    </div>

                    <!-- Quick Buy Option -->
                    <a href="{{ route('cart.show') }}" class="block w-full text-center bg-gray-900 hover:bg-gray-800 text-white font-semibold py-3 px-6 rounded-lg transition">
                        Buy Now
                    </a>
                </form>
            @else
                <div class="bg-gray-50 rounded-xl p-6 shadow-sm">
                    <a href="{{ route('login') }}" class="block w-full text-center bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-6 rounded-lg transition mb-3">
                        Sign In to Purchase
                    </a>
                    <p class="text-center text-sm text-gray-500">New customer? <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-700 font-medium">Create an account</a></p>
                </div>
            @endauth

            <!-- Product Features -->
            <div class="mt-12">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Features</h3>
                <ul class="space-y-3">
                    <li class="flex items-start">
                        <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-gray-600">Premium materials for long-lasting durability</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-gray-600">Ergonomic design for maximum comfort</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-gray-600">Environmentally friendly manufacturing</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Product Tabs Section -->
<div class="bg-gray-50 py-16">
    <div class="container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex space-x-8">
                    <button class="border-b-2 border-indigo-500 text-indigo-600 px-1 py-4 text-sm font-medium">
                        Description
                    </button>
                    <button class="border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 px-1 py-4 text-sm font-medium">
                        Specifications
                    </button>
                    <button class="border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 px-1 py-4 text-sm font-medium">
                        Reviews (24)
                    </button>
                </nav>
            </div>

            <div class="py-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Detailed Description</h3>
                <div class="prose max-w-none text-gray-600">
                    <p>{{ $product->description }}</p>
                    <p>Our {{ $product->name }} is designed with precision and crafted with care to deliver exceptional performance. Whether you're using it for professional or personal purposes, this product will exceed your expectations with its innovative features and reliable construction.</p>
                    
                    <h4>Key Benefits:</h4>
                    <ul>
                        <li>Superior comfort and ergonomics</li>
                        <li>High-quality materials for extended durability</li>
                        <li>Sleek, modern design that complements any space</li>
                        <li>Easy to maintain and clean</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Related Products -->
<div class="bg-white py-16">
    <div class="container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-8">You May Also Like</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Sample Related Products (replace with dynamic content) -->
            <div class="group relative bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition">
                <div class="aspect-w-1 aspect-h-1 bg-gray-200 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1546868871-7041f2a55e12" alt="Related product" class="w-full h-full object-cover object-center group-hover:opacity-75 transition">
                </div>
                <div class="p-4">
                    <h3 class="text-sm text-gray-700">
                        <a href="#">
                            <span aria-hidden="true" class="absolute inset-0"></span>
                            Wireless Headphones
                        </a>
                    </h3>
                    <div class="mt-2 flex items-center justify-between">
                        <p class="text-sm font-medium text-gray-900">€129.99</p>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <span class="text-xs text-gray-500 ml-1">4.8</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Repeat for 3 more products -->
        </div>
    </div>
</div>

<script>
    function increaseQuantity() {
        const input = document.getElementById('quantityInput');
        const max = parseInt(input.getAttribute('max')) || 999;
        if (parseInt(input.value) < max) {
            input.value = parseInt(input.value) + 1;
        }
    }
    
    function decreaseQuantity() {
        const input = document.getElementById('quantityInput');
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
    }
</script>

<style>
    /* Animation for hero text */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fadeIn 0.8s ease-out forwards;
    }
    
    /* Custom scrollbar for better UX */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    ::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 4px;
    }
    ::-webkit-scrollbar-thumb:hover {
        background: #a1a1a1;
    }
    
    /* Smooth transitions */
    .transition {
        transition-property: background-color, border-color, color, fill, stroke, opacity, box-shadow, transform;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 150ms;
    }
    
    /* Prose styling for content */
    .prose h4 {
        font-size: 1.125rem;
        line-height: 1.75rem;
        font-weight: 600;
        margin-top: 1.5rem;
        margin-bottom: 0.75rem;
        color: #111827;
    }
    .prose ul {
        list-style-type: disc;
        padding-left: 1.5rem;
        margin-top: 0.75rem;
        margin-bottom: 0.75rem;
    }
    .prose li {
        margin-bottom: 0.25rem;
    }
</style>
@endsection