@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-4">Users</h1>

<form method="GET" action="{{ route('admin.users.index') }}" class="mb-4">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name"
        class="border p-2 rounded w-full max-w-xs" />
</form>

<table class="min-w-full bg-white shadow rounded">
    <thead>
        <tr class="bg-gray-100 text-left">
            <th class="px-4 py-2">User ID</th>            <!-- New User ID column -->
            <th class="px-4 py-2">Name</th>
            <th class="px-4 py-2">Email</th>
            <th class="px-4 py-2">Phone</th>
            <th class="px-4 py-2">Role</th>
            <th class="px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($users as $user)
        <tr>
            <td class="border px-4 py-2">{{ $user->user_id }}</td>  <!-- Show User ID -->
            <td class="border px-4 py-2">{{ $user->name }}</td>
            <td class="border px-4 py-2">{{ $user->email }}</td>
            <td class="border px-4 py-2">{{ $user->number }}</td>
            <td class="border px-4 py-2">{{ ucfirst($user->role) }}</td>
            <td class="border px-4 py-2">
                <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-600 hover:underline">Edit</a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="border px-4 py-2 text-center">No users found.</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{ $users->withQueryString()->links() }}
@endsection
