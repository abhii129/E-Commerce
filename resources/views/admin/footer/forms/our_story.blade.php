<form method="POST" action="{{ route('footer.update', ['section_key' => $section_key]) }}">
    @csrf
    
    <div class="mb-4">
        <label for="title" class="block font-medium mb-1">Title</label>
        <input type="text" name="data[title]" id="title" value="{{ old('data.title', $data['title'] ?? '') }}" required
            class="w-full border rounded px-3 py-2">
        @error('data.title')
            <span class="text-red-600 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-4">
        <label for="content" class="block font-medium mb-1">Content</label>
        <textarea name="data[content]" id="content" rows="6" required
            class="w-full border rounded px-3 py-2">{{ old('data.content', $data['content'] ?? '') }}</textarea>
        @error('data.content')
            <span class="text-red-600 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-4">
        <label for="image" class="block font-medium mb-1">Image URL</label>
        <input type="url" name="data[image]" id="image" value="{{ old('data.image', $data['image'] ?? '') }}"
            placeholder="https://example.com/image.jpg"
            class="w-full border rounded px-3 py-2">
        @error('data.image')
            <span class="text-red-600 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Save
    </button>
</form>
