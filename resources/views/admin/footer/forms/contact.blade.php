<form method="POST" action="{{ route('admin.footer.update', ['section_key' => $section_key]) }}">
    @csrf
    <input name="data[location]" value="{{ $data['location'] ?? '' }}" placeholder="Location">
    <input name="data[phone]" value="{{ $data['phone'] ?? '' }}" placeholder="Phone">
    <input name="data[email]" value="{{ $data['email'] ?? '' }}" placeholder="Email">
    <button type="submit">Save</button>
</form>
