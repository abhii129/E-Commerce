@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-xl font-bold mb-4">Your Addresses</h2>
    <a href="{{ route('addresses.create') }}" class="btn btn-primary mb-4">Add New Address</a>

    @if($addresses->isEmpty())
        <p>You haven't added any addresses yet.</p>
    @else
        <ul class="divide-y divide-gray-200">
            @foreach($addresses as $address)
            <li class="flex justify-between items-center py-3">
                <div>
                    <strong>{{ $address->label ?? 'Address' }}:</strong>
                    <p>{{ $address->address_line1 }}, {{ $address->address_line2 }}<br>
                       {{ $address->city }}, {{ $address->state }} {{ $address->postal_code }}<br>
                       {{ $address->country }}</p>
                </div>
                <div class="flex items-center space-x-2">
                    @if($address->is_default)
                        <span class="text-green-600 font-semibold">Default</span>
                    @else
                        <form method="POST" action="{{ route('addresses.setDefault', $address) }}">
                            @csrf
                            <button type="submit" class="px-3 py-1 border border-gray-300 rounded hover:bg-gray-100">Set as Default</button>
                        </form>
                    @endif

                    <form method="POST" action="{{ route('addresses.destroy', $address) }}" onsubmit="return confirm('Delete this address?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3 py-1 border border-red-500 text-red-500 rounded hover:bg-red-100">Delete</button>
                    </form>
                </div>
            </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
