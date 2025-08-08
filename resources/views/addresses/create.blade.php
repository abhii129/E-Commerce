@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-xl font-bold mb-4">Add New Address</h2>
    <form method="POST" action="{{ route('addresses.store') }}">
        @csrf

        <label class="block mb-2">Label (optional)</label>
        <input type="text" name="label" class="border p-2 w-full mb-4" value="{{ old('label') }}" placeholder="e.g. Home, Office">

        <label class="block mb-2 font-semibold">Address Line 1</label>
        <input type="text" name="address_line1" class="border p-2 w-full mb-4" value="{{ old('address_line1') }}" required>

        <label class="block mb-2">Address Line 2</label>
        <input type="text" name="address_line2" class="border p-2 w-full mb-4" value="{{ old('address_line2') }}">

        <label class="block mb-2 font-semibold">City</label>
        <input type="text" name="city" class="border p-2 w-full mb-4" value="{{ old('city') }}" required>

        <label class="block mb-2">State</label>
        <input type="text" name="state" class="border p-2 w-full mb-4" value="{{ old('state') }}">

        <label class="block mb-2 font-semibold">Postal Code</label>
        <input type="text" name="postal_code" class="border p-2 w-full mb-4" value="{{ old('postal_code') }}" required>

        <label class="block mb-2">Country</label>
        <input type="text" name="country" class="border p-2 w-full mb-4" value="{{ old('country', 'Your Country') }}" required>

        <label class="inline-flex items-center mb-4">
            <input type="checkbox" name="set_default" class="form-checkbox" {{ old('set_default') ? 'checked' : '' }}>
            <span class="ml-2 text-gray-700">Set as default address</span>
            
        </label>

        <button type="submit" class="btn btn-primary">Save Address</button>

        
    </form>
</div>
@endsection
