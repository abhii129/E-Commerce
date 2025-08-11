
@if (session('error'))
    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
        {{ session('error') }}
    </div>
@endif

@extends('layouts.app')
@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white rounded shadow">
    
    <h2 class="text-2xl font-bold mb-4">Review Your Order</h2>
    <form method="POST" action="{{ route('checkout.process') }}">
        @csrf
        <ul class="divide-y divide-gray-200 mb-4">
            @foreach($cartItems as $item)
                <li class="flex justify-between py-2">
                    <div>
                        <span class="font-medium">{{ $item->product->name }}</span>
                        <span class="text-sm text-gray-500">x{{ $item->quantity }}</span>
                    </div>
                    <div>€{{ number_format($item->price * $item->quantity, 2) }}</div>
                </li>
            @endforeach
        </ul>
        <div class="font-bold text-lg mb-4">
            Total: €{{ number_format($cartItems->sum(fn($item) => $item->price * $item->quantity), 2) }}
        </div>
        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">
            Place Order
        </button>
    </form>
</div>
@endsection
