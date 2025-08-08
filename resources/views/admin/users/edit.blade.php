@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Edit User: {{ $user->name }}</h1>

<form method="POST" action="{{ route('admin.users.update', $user) }}">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label for="name" class="block font-semibold mb-1">Name</label>
        <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" class="w-full border p-2" required>
        @error('name') <p class="text-red-600">{{ $message }}</p> @enderror
    </div>

    <div class="mb-4">
        <label for="email" class="block font-semibold mb-1">Email</label>
        <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" class="w-full border p-2" required>
        @error('email') <p class="text-red-600">{{ $message }}</p> @enderror
    </div>

    <div class="mb-4">
        <label for="number" class="block font-semibold mb-1">Phone Number</label>
        <input id="number" name="number" type="text" value="{{ old('number', $user->number) }}" class="w-full border p-2" required>
        @error('number') <p class="text-red-600">{{ $message }}</p> @enderror
    </div>

    <div class="mb-4">
        <label for="age" class="block font-semibold mb-1">Age</label>
        <input id="age" name="age" type="number" value="{{ old('age', $user->age) }}" class="w-full border p-2" required>
        @error('age') <p class="text-red-600">{{ $message }}</p> @enderror
    </div>

    <div class="mb-4">
        <label for="address" class="block font-semibold mb-1">Address</label>
        <input id="address" name="address" type="text" value="{{ old('address', $user->address) }}" class="w-full border p-2" required>
        @error('address') <p class="text-red-600">{{ $message }}</p> @enderror
    </div>

    <div class="mb-4">
        <label for="gender" class="block font-semibold mb-1">Gender</label>
        <select id="gender" name="gender" class="w-full border p-2" required>
            <option value="male" {{ (old('gender', $user->gender) == 'male') ? 'selected' : '' }}>Male</option>
            <option value="female" {{ (old('gender', $user->gender) == 'female') ? 'selected' : '' }}>Female</option>
            <option value="other" {{ (old('gender', $user->gender) == 'other') ? 'selected' : '' }}>Other</option>
        </select>
        @error('gender') <p class="text-red-600">{{ $message }}</p> @enderror
    </div>

    <div class="mb-4">
        <label for="role" class="block font-semibold mb-1">Role</label>
        <select id="role" name="role" class="w-full border p-2" required>
            <option value="customer" {{ (old('role', $user->role) == 'customer') ? 'selected' : '' }}>Customer</option>
            <option value="admin" {{ (old('role', $user->role) == 'admin') ? 'selected' : '' }}>Admin</option>
        </select>
        @error('role') <p class="text-red-600">{{ $message }}</p> @enderror
    </div>

    <button type="submit" class="btn btn-primary">Update User</button>
</form>
@endsection
