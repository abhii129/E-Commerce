@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-xl font-semibold mb-4">Edit Footer Message for {{ ucfirst(str_replace('_', ' ', $message->section)) }}</h2>

    <form action="{{ route('admin.footer-messages.update', ['section' => $message->section]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="message" class="block text-gray-700">Message</label>
            <textarea name="message" id="message" rows="4" class="w-full p-3 border border-gray-300 rounded" required>{{ $message->message }}</textarea>
        </div>

        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Save Changes</button>
    </form>
</div>
@endsection
