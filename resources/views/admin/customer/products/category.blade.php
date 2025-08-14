@extends('layouts.app')

@section('content')
<!-- Hero Banner Section -->
<div class="relative bg-gradient-to-r from-indigo-900 to-purple-800 py-20 overflow-hidden">
    <!-- Decorative elements -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-1/3 h-full bg-white opacity-20 transform -skew-x-12"></div>
        <div class="absolute top-0 right-0 w-1/4 h-full bg-white opacity-10 transform skew-y-12"></div>
    </div>
    
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 animate-fade-in-down">
                {{ $category->name }}
            </h1>
            <p class="text-xl text-indigo-100 mb-8 max-w-2xl mx-auto">
                Discover our premium collection of {{ $category->name }} products
            </p>
            <div class="flex justify-center space-x-4">
                
                
            </div>
        </div>
    </div>
    
    <!-- Wave divider -->
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M1440 21.21C1206.67 58.42 1022.17 5.21004 755.5 5.21004C469.5 5.21004 256 68.21 0 21.21V120H1440V21.21Z" fill="#F9FAFB"/>
        </svg>
    </div>
</div>

<!-- Main Content Section -->
<div id="products" class="bg-gray-50 py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        @if($products->count())
            <!-- Category Info -->
            <div class="mb-12 text-center">
                <h2 class="text-2xl font-semibold text-gray-800 mb-2">Our {{ $category->name }} Collection</h2>
                <div class="w-20 h-1 bg-indigo-600 mx-auto mb-6"></div>
                <p class="text-gray-600 max-w-3xl mx-auto">
                    Carefully curated selection of premium {{ $category->name }} products to suit your needs.
                </p>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($products as $product)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                        <!-- Product Image -->
                        <div class="relative h-60 overflow-hidden group">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            @if($product->is_new)
                                <span class="absolute top-3 left-3 bg-indigo-600 text-white text-xs font-bold px-2 py-1 rounded-full">NEW</span>
                            @endif
                            @if($product->compare_price)
                                <span class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                                    SALE
                                </span>
                            @endif
                        </div>
                        
                        <!-- Product Details -->
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-lg font-semibold text-gray-900 truncate">{{ $product->name }}</h3>
                                @if($product->compare_price)
                                    <span class="text-sm line-through text-gray-500">€{{ number_format($product->compare_price, 2) }}</span>
                                @endif
                            </div>
                            
                            <p class="text-gray-600 text-sm mb-4">{{ Str::limit($product->description, 80) }}</p>
                            
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-bold text-indigo-600">€{{ number_format($product->price, 2) }}</span>
                                
                                <!-- Rating Badge -->
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    <span class="text-xs text-gray-500 ml-1">4.8</span>
                                </div>
                            </div>
                            
                            <!-- View Details Button -->
                            <div class="mt-6">
                                <a href="{{ route('customer.products.show', $product->id) }}" 
                                   class="block w-full text-center bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12 flex justify-center">
                {{ $products->links('pagination::tailwind') }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16 bg-white rounded-xl shadow-sm max-w-3xl mx-auto">
                <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="mt-4 text-xl font-medium text-gray-900">No products found</h3>
                <p class="mt-2 text-gray-500">We couldn't find any products in this category yet.</p>
                <div class="mt-6">
                    <a href="{{ route('customer.categories.index') }}" class="inline-flex items-center px-5 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                        Browse other categories
                        <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Newsletter Section -->
<div class="bg-gradient-to-r from-indigo-700 to-purple-800 py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Stay Updated</h2>
            <p class="text-xl text-indigo-100 mb-8">Subscribe to our newsletter for new arrivals, exclusive offers, and style inspiration.</p>
            <form class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                <input type="email" placeholder="Your email address" class="flex-grow px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-300">
                <button type="submit" class="px-6 py-3 bg-white text-indigo-700 font-medium rounded-lg hover:bg-indigo-50 transition-all">
                    Subscribe
                </button>
            </form>
        </div>
    </div>
</div>

<style>
    /* Animation for banner text */
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .animate-fade-in-down {
        animation: fadeInDown 0.8s ease-out forwards;
    }
    
    /* Smooth transitions */
    .transition-all {
        transition-property: all;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 300ms;
    }
    
    /* Card hover effect */
    .hover\:-translate-y-2:hover {
        transform: translateY(-8px);
    }
    
    /* Image zoom effect */
    .group-hover\:scale-110:hover {
        transform: scale(1.1);
    }
    
    /* Custom scrollbar */
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
</style>
@endsection