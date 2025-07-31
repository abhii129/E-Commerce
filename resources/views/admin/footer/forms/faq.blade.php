<form method="POST" action="{{ route('footer.update', ['section_key' => $section_key]) }}">
    @csrf
    <h3 class="font-semibold mb-2">FAQs</h3>
    <div id="faq-fields">
        @if(!empty($data) && is_array($data))
            @foreach ($data as $i => $faq)
                <div class="faq-item mb-4 border rounded p-3">
                    <label>Question:</label>
                    <input type="text" name="data[{{ $i }}][question]" value="{{ $faq['question'] ?? '' }}" class="w-full border px-2 py-1 mb-1" required>
                    <label>Answer:</label>
                    <textarea name="data[{{ $i }}][answer]" class="w-full border px-2 py-1 mb-1" required>{{ $faq['answer'] ?? '' }}</textarea>
                    <button type="button" onclick="removeFaqRow(this)" class="text-red-500 text-xs">Remove</button>
                </div>
            @endforeach
        @else
            <div class="faq-item mb-4 border rounded p-3">
                <label>Question:</label>
                <input type="text" name="data[0][question]" class="w-full border px-2 py-1 mb-1" required>
                <label>Answer:</label>
                <textarea name="data[0][answer]" class="w-full border px-2 py-1 mb-1" required></textarea>
                <button type="button" onclick="removeFaqRow(this)" class="text-red-500 text-xs">Remove</button>
            </div>
        @endif
    </div>
    <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded mb-4" onclick="addFaqRow()">Add FAQ</button>
    <br>
    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Save</button>
</form>

<script>
function addFaqRow() {
    let index = document.querySelectorAll('.faq-item').length;
    const wrapper = document.getElementById('faq-fields');
    const html = `
        <div class="faq-item mb-4 border rounded p-3">
            <label>Question:</label>
            <input type="text" name="data[${index}][question]" class="w-full border px-2 py-1 mb-1" required>
            <label>Answer:</label>
            <textarea name="data[${index}][answer]" class="w-full border px-2 py-1 mb-1" required></textarea>
            <button type="button" onclick="removeFaqRow(this)" class="text-red-500 text-xs">Remove</button>
        </div>
    `;
    wrapper.insertAdjacentHTML('beforeend', html);
}

function removeFaqRow(btn) {
    btn.closest('.faq-item').remove();
}
</script>
