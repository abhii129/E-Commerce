<form method="POST" action="{{ route('footer.update', ['section_key' => $section_key]) }}">
    @csrf
    <h3 class="font-semibold mb-4">Careers / Job Openings</h3>

    <div id="careers-wrapper">
        @if(!empty($data) && is_array($data))
            @foreach($data as $index => $job)
                <div class="career-item mb-5 border rounded p-4 relative">
                    <label class="block mb-1 font-medium">Position</label>
                    <input type="text" name="data[{{ $index }}][position]" value="{{ $job['position'] ?? '' }}" class="w-full border px-3 py-2 mb-2" required>

                    <label class="block mb-1 font-medium">Description</label>
                    <textarea name="data[{{ $index }}][description]" class="w-full border px-3 py-2 mb-2" rows="4" required>{{ $job['description'] ?? '' }}</textarea>

                    <label class="block mb-1 font-medium">Apply Link</label>
                    <input type="url" name="data[{{ $index }}][apply_link]" value="{{ $job['apply_link'] ?? '' }}" class="w-full border px-3 py-2 mb-2" placeholder="https://">

                    <button type="button" onclick="removeCareer(this)" class="absolute top-2 right-2 text-red-600 hover:text-red-800 text-sm font-semibold">Remove</button>
                </div>
            @endforeach
        @else
            <div class="career-item mb-5 border rounded p-4 relative">
                <label class="block mb-1 font-medium">Position</label>
                <input type="text" name="data[0][position]" class="w-full border px-3 py-2 mb-2" required>

                <label class="block mb-1 font-medium">Description</label>
                <textarea name="data[0][description]" class="w-full border px-3 py-2 mb-2" rows="4" required></textarea>

                <label class="block mb-1 font-medium">Apply Link</label>
                <input type="url" name="data[0][apply_link]" class="w-full border px-3 py-2 mb-2" placeholder="https://">

                <button type="button" onclick="removeCareer(this)" class="absolute top-2 right-2 text-red-600 hover:text-red-800 text-sm font-semibold">Remove</button>
            </div>
        @endif
    </div>

    <button type="button" onclick="addCareer()" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 hover:bg-blue-700">
        Add Career
    </button>
    <br>
    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Save</button>
</form>

<script>
    function addCareer() {
        let count = document.querySelectorAll('.career-item').length;
        const wrapper = document.getElementById('careers-wrapper');
        const html = `
            <div class="career-item mb-5 border rounded p-4 relative">
                <label class="block mb-1 font-medium">Position</label>
                <input type="text" name="data[${count}][position]" class="w-full border px-3 py-2 mb-2" required>

                <label class="block mb-1 font-medium">Description</label>
                <textarea name="data[${count}][description]" class="w-full border px-3 py-2 mb-2" rows="4" required></textarea>

                <label class="block mb-1 font-medium">Apply Link</label>
                <input type="url" name="data[${count}][apply_link]" class="w-full border px-3 py-2 mb-2" placeholder="https://">

                <button type="button" onclick="removeCareer(this)" class="absolute top-2 right-2 text-red-600 hover:text-red-800 text-sm font-semibold">Remove</button>
            </div>
        `;
        wrapper.insertAdjacentHTML('beforeend', html);
    }

    function removeCareer(button) {
        button.closest('.career-item').remove();
        // Optional: re-label input names to maintain sequence
        const items = document.querySelectorAll('.career-item');
        items.forEach((item, idx) => {
            item.querySelector('input[name^="data"]').setAttribute('name', `data[${idx}][position]`);
            item.querySelector('textarea[name^="data"]').setAttribute('name', `data[${idx}][description]`);
            item.querySelector('input[name^="data"][type="url"]').setAttribute('name', `data[${idx}][apply_link]`);
        });
    }
</script>
