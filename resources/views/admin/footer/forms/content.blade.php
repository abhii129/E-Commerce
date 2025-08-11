<form method="POST" action="{{ route('admin.footer.update', $section_key) }}">
    @csrf
    <input name="data[title]" value="{{ $data['title'] ?? '' }}" placeholder="Title">
    <textarea name="data[content]">{{ $data['content'] ?? '' }}</textarea>
    <button type="submit">Save</button>
</form>
