@extends('layouts.admin')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Add New Category</h2>

    <form action="{{ route('categories.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="name" class="block text-gray-700">Category Name</label>
            <input type="text" name="name" id="name" class="w-full p-2 border border-gray-300 rounded" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Create Category</button>
    </form>
@endsection
