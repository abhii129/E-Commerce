<form method="POST" action="{{ route('admin.footer.update', ['section_key' => $section_key]) }}">
    @csrf
    <h3 class="font-semibold mb-3">Blog Posts</h3>
    <div id="blog-fields">
        @if(!empty($data) && is_array($data))
            @foreach ($data as $i => $post)
                <div class="blog-item mb-5 border rounded p-3">
                    <label class="block mb-1">Title:</label>
                    <input type="text" name="data[{{ $i }}][title]" value="{{ $post['title'] ?? '' }}" class="w-full border px-2 py-1 mb-2" required>

                    <label class="block mb-1">Content:</label>
                    <textarea name="data[{{ $i }}][content]" class="w-full border px-2 py-1 mb-2" rows="3" required>{{ $post['content'] ?? '' }}</textarea>

                    <label class="block mb-1">Date:</label>
                    <input type="date" name="data[{{ $i }}][date]" value="{{ $post['date'] ?? '' }}" class="w-full border px-2 py-1 mb-2">

                    <button type="button" onclick="removeBlogRow(this)" class="text-red-500 text-xs">Remove</button>
                </div>
            @endforeach
        @else
            <div class="blog-item mb-5 border rounded p-3">
                <label class="block mb-1">Title:</label>
                <input type="text" name="data[0][title]" class="w-full border px-2 py-1 mb-2" required>

                <label class="block mb-1">Content:</label>
                <textarea name="data[0][content]" class="w-full border px-2 py-1 mb-2" rows="3" required></textarea>

                <label class="block mb-1">Date:</label>
                <input type="date" name="data[0][date]" class="w-full border px-2 py-1 mb-2">

                <button type="button" onclick="removeBlogRow(this)" class="text-red-500 text-xs">Remove</button>
            </div>
        @endif
    </div>
    <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded mb-4" onclick="addBlogRow()">Add Blog Post</button>
    <br>
    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Save</button>
</form>

<script>
function addBlogRow() {
    let idx = document.querySelectorAll('.blog-item').length;
    const wrapper = document.getElementById('blog-fields');
    const html = `
        <div class="blog-item mb-5 border rounded p-3">
            <label class="block mb-1">Title:</label>
            <input type="text" name="data[${idx}][title]" class="w-full border px-2 py-1 mb-2" required>

            <label class="block mb-1">Content:</label>
            <textarea name="data[${idx}][content]" class="w-full border px-2 py-1 mb-2" rows="3" required></textarea>

            <label class="block mb-1">Date:</label>
            <input type="date" name="data[${idx}][date]" class="w-full border px-2 py-1 mb-2">

            <button type="button" onclick="removeBlogRow(this)" class="text-red-500 text-xs">Remove</button>
        </div>
    `;
    wrapper.insertAdjacentHTML('beforeend', html);
}
function removeBlogRow(btn) {
    btn.closest('.blog-item').remove();
}
</script>
