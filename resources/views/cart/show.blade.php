@extends('layouts.app')

@section('content')



<div class="max-w-4xl mx-auto">

    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Your Shopping Cart</h1>
        <span class="text-gray-500">{{ $cartItems->count() }} items</span>
    </div>

    @if($cartItems->isEmpty())
        <div class="bg-white rounded-xl shadow-sm p-8 text-center">
            <div class="empty-cart-icon inline-flex items-center justify-center w-20 h-20 bg-indigo-50 rounded-full mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <h2 class="text-xl font-medium text-gray-900 mb-2">Your cart is empty</h2>
            <p class="text-gray-500 mb-6">Looks like you haven't added anything to your cart yet</p>
            <a href="{{ route('customer.products.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                Continue Shopping
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
        </div>
    @else
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="hidden md:grid grid-cols-12 bg-gray-50 px-6 py-4 text-sm font-medium text-gray-500 uppercase tracking-wider">
                <div class="col-span-6">Product</div>
                <div class="col-span-2 text-center">Quantity</div>
                <div class="col-span-2 text-right">Price</div>
                <div class="col-span-2"></div>
            </div>
            
            <div class="divide-y divide-gray-200">
                @foreach($cartItems as $item)
                <div class="cart-item grid grid-cols-12 gap-4 items-center p-6 hover:bg-gray-50">
                    <div class="col-span-6 flex items-center">
                        <div class="flex-shrink-0 h-20 w-20 rounded-md overflow-hidden">
                            <img src="{{ $item->product->image_url ?? 'https://via.placeholder.com/150' }}" alt="{{ $item->product->name }}" class="h-full w-full object-cover object-center">
                        </div>
                        <div class="ml-4">
                            <h3 class="text-base font-medium text-gray-900">{{ $item->product->name }}</h3>
                            <p class="text-sm text-gray-500">SKU: {{ $item->product->sku ?? 'N/A' }}</p>
                        </div>
                    </div>
                    
                    <div class="col-span-2 flex justify-center">
    <div class="flex items-center border border-gray-300 rounded-md">
        {{-- Minus Button --}}
        <form method="POST" action="{{ route('cart.updateQuantity', $item->product_id) }}">
            @csrf
            <input type="hidden" name="quantity" value="{{ max($item->quantity - 1, 1) }}">
            <button type="submit" class="px-3 py-1 text-gray-500 hover:text-gray-700" {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                </svg>
            </button>
        </form>
        <span class="px-3 py-1">{{ $item->quantity }}</span>
        {{-- Plus Button --}}
        <form method="POST" action="{{ route('cart.updateQuantity', $item->product_id) }}">
            @csrf
            <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
            <button type="submit" class="px-3 py-1 text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
            </button>
        </form>
    </div>
</div>

                    
                    <div class="col-span-2 text-right font-medium text-gray-900">
                        €{{ number_format($item->price, 2) }}
                    </div>
                    
                    <div class="col-span-2 text-right">
                        <form method="POST" action="{{ route('cart.remove', $item->product_id) }}">
                            @csrf
                            <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium flex items-center justify-end w-full">
                                Remove
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="border-t border-gray-200 px-6 py-4">
                <div class="flex justify-between items-center">
                    <div class="text-sm text-gray-500">
                        Items: {{ $cartItems->sum('quantity') }}
                    </div>
                    <div class="text-lg font-bold text-gray-900">
                        Total: €{{ number_format($cartItems->sum(function($item) { return $item->price * $item->quantity; }), 2) }}
                    </div>
                </div>
            </div>
            
            <div class="bg-gray-50 px-6 py-4 flex flex-col md:flex-row justify-between space-y-4 md:space-y-0 md:space-x-4">
                <a href="{{ route('customer.products.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 rounded-md shadow-sm text-base font-medium text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Continue Shopping
                </a>
                <a href="{{ route('cart.checkout-index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Proceed to Checkout
                </a>
            </div>
        </div>
    @endif
</div>
@endsection