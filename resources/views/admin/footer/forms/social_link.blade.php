<form method="POST" action="{{ route('admin.footer.update', $section_key) }}">
    @csrf
    <input name="data[link]" value="{{ $data['link'] ?? '' }}" placeholder="Link">
    <input name="data[icon]" value="{{ $data['icon'] ?? '' }}" placeholder="Icon Class">
    <button type="submit">Save</button>
</form>
