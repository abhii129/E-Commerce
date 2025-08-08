@extends('layouts.app')
@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white rounded shadow text-center">
    <h2 class="text-2xl font-bold mb-4 text-green-700">Thank you for your order!</h2>
    <p class="mb-2">Your order <span class="font-mono text-indigo-600">#{{ $order->id }}</span> totaling <b>€{{ number_format($order->total, 2) }}</b> has been placed and is <span class="text-yellow-600">{{ $order->status }}</span>.</p>
    <h3 class="mt-6 mb-2 text-lg font-semibold">Order Details:</h3>
    <ul class="mb-6 divide-y divide-gray-100 text-left">
        @foreach ($order->orderItems as $item)
            <li class="py-2">{{ $item->product_name }} × {{ $item->quantity }} <span class="float-right">€{{ number_format($item->price * $item->quantity, 2) }}</span></li>
        @endforeach
    </ul>
    <a href="{{ route('customer.products.index') }}" class="inline-block bg-indigo-600 text-white px-5 py-2 rounded hover:bg-indigo-700 mt-4">Continue Shopping</a>
</div>
@endsection
