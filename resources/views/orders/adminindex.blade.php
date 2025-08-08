@extends('layouts.admin')
@section('content')

<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">All Orders</h1>
    </div>

    @foreach($orders as $order)
        <div class="mb-6 p-6 bg-white rounded-lg shadow-md border border-gray-100 hover:shadow-lg transition-shadow duration-200">
            <div class="flex justify-between items-start mb-4">
            <form method="POST" action="{{ route('admin.orders.updateStatus', $order->id) }}">
    @csrf
    @method('PUT')
    <select name="status" onchange="this.form.submit()" class="border rounded px-2 py-1 text-sm" >
        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
        <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
    </select>
</form>

                <div class="text-right">
                    <p class="text-sm text-gray-500">Placed on</p>
                    <p class="text-gray-700">{{ $order->created_at->format('M d, Y \a\t H:i') }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <div class="bg-gray-50 p-3 rounded">
                    <p class="text-sm text-gray-500">Customer</p>
                    <p class="font-medium">{{ $order->user->name ?? 'N/A' }} <span class="text-gray-500 text-sm">(ID: {{ $order->user->id ?? 'N/A' }})</span></p>
                </div>
                <div class="bg-gray-50 p-3 rounded">
                    <p class="text-sm text-gray-500">Total Amount</p>
                    <p class="font-medium text-lg text-indigo-600">€{{ number_format($order->total, 2) }}</p>
                </div>
                <div class="bg-gray-50 p-3 rounded">
                    <p class="text-sm text-gray-500">Payment Method</p>
                    <p class="font-medium">{{ $order->payment_method ?? 'N/A' }}</p>
                </div>
            </div>

            <h3 class="mt-4 mb-2 font-semibold text-gray-700 border-b pb-2">Order Items</h3>
            <ul class="divide-y divide-gray-200">
                @foreach($order->orderItems as $item)
                    <li class="py-3 flex justify-between">
                        <div>
                            <p class="font-medium">{{ $item->product_name }}</p>
                            <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                        </div>
                        <div class="text-right">
                            <p class="font-medium">€{{ number_format($item->price, 2) }}</p>
                            <p class="text-sm text-gray-500">€{{ number_format($item->price * $item->quantity, 2) }} total</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endforeach

    <div class="mt-8">
        {{ $orders->links() }}
    </div>
</div>

@endsection