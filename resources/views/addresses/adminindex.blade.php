@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">User Addresses</h1>

    <form method="GET" action="{{ route('addresses.index') }}" class="mb-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by user name"
            class="border p-2 rounded w-full max-w-xs" />
    </form>

    <table class="min-w-full bg-white shadow rounded">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="px-4 py-2">Address ID</th>
                <th class="px-4 py-2">User ID</th>
                <th class="px-4 py-2">User Name</th>
                <th class="px-4 py-2">Label</th>
                <th class="px-4 py-2">Address</th>
                <th class="px-4 py-2">City</th>
                <th class="px-4 py-2">Postal Code</th>
                <th class="px-4 py-2">Default</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($addresses as $address)
                <tr>
                    <td class="border px-4 py-2">{{ $address->id }}</td>
                    <td class="border px-4 py-2">{{ $address->user->id ?? '-' }}</td>
                    <td class="border px-4 py-2">{{ $address->user->name ?? '-' }}</td>
                    <td class="border px-4 py-2">{{ $address->label ?? '-' }}</td>
                    <td class="border px-4 py-2">{{ $address->address_line1 }} {{ $address->address_line2 }}</td>
                    <td class="border px-4 py-2">{{ $address->city }}</td>
                    <td class="border px-4 py-2">{{ $address->postal_code }}</td>
                    <td class="border px-4 py-2">
                        @if ($address->is_default)
                            <span class="text-green-600 font-semibold">Yes</span>
                        @else
                            No
                        @endif
                    </td>
                    <td class="border px-4 py-2">
                        <!-- Add admin edit/delete buttons if needed -->
                        <a href="#" class="text-blue-600 hover:underline">Edit</a>
                        <form action="#" method="POST" class="inline-block" onsubmit="return confirm('Delete this address?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline ml-2">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="border px-4 py-2 text-center">No addresses found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $addresses->withQueryString()->links() }}
    </div>
@endsection
