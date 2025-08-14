@extends('layouts.admin')

@section('content')
    <div class="admin-container">
        <div class="attribute-form">
            <div class="form-header">
                <h1 class="form-title">Add New Product Attribute</h1>
                <p class="form-subtitle">Define product characteristics for better filtering</p>
            </div>

            <form action="{{ route('admin.product-attributes.store') }}" method="POST" class="modern-form">
                @csrf

                <!-- Category -->
                <div class="form-group floating-control">
                    <select name="category_id" id="category_id" class="form-select @error('category_id') error @enderror">
                        <option value=""></option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ (old('category_id') ?? $selectedCategory) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <label for="category_id">Category</label>
                    @error('category_id')
                        <div class="validation-error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Subcategory -->
                <div class="form-group floating-control">
                    <select name="subcategory_id" id="subcategory_id" class="form-select @error('subcategory_id') error @enderror">
                        <option value=""></option>
                        @foreach($subcategories as $subcategory)
                            <option value="{{ $subcategory->id }}" {{ old('subcategory_id') == $subcategory->id ? 'selected' : '' }}>
                                {{ $subcategory->name }}
                            </option>
                        @endforeach
                    </select>
                    <label for="subcategory_id">Subcategory</label>
                    @error('subcategory_id')
                        <div class="validation-error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Attribute Name -->
                <div class="form-group floating-control">
                    <input type="text" name="name" id="name" class="form-input @error('name') error @enderror" value="{{ old('name') }}" placeholder=" " required>
                    <label for="name">Attribute Name</label>
                    @error('name')
                        <div class="validation-error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Attribute Type -->
                <div class="form-group floating-control">
                    <select name="type" id="type" class="form-select" required>
                        <option value="text" {{ old('type') == 'text' ? 'selected' : '' }}>Text</option>
                        <option value="select" {{ old('type') == 'select' ? 'selected' : '' }}>Select</option>
                    </select>
                    <label for="type">Attribute Type</label>
                </div>

                <!-- Options (only visible when 'Select' type is chosen) -->
                <div class="form-group floating-control" id="options-container" style="display: none;">
                    <input type="text" name="options" id="options" class="form-input @error('options') error @enderror" value="{{ old('options') }}" placeholder=" ">
                    <label for="options">Options (comma separated)</label>
                    <div class="input-hint">Example: Red, Blue, Green</div>
                    @error('options')
                        <div class="validation-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-actions">
                    <button type="button" class="btn-secondary" onclick="window.history.back()">
                        Cancel
                    </button>
                    <button type="submit" class="btn-primary">
                        <span>Save Attribute</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                            <polyline points="17 21 17 13 7 13 7 21"></polyline>
                            <polyline points="7 3 7 8 15 8"></polyline>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a56d4;
            --error: #ef233c;
            --light-gray: #f8f9fa;
            --border-color: #e9ecef;
            --text-muted: #6c757d;
        }

        .admin-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .attribute-form {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .form-header {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid var(--border-color);
        }

        .form-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0;
            color: #212529;
        }

        .form-subtitle {
            font-size: 0.875rem;
            color: var(--text-muted);
            margin: 0.25rem 0 0;
        }

        .modern-form {
            padding: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .floating-control {
            position: relative;
        }

        .floating-control label {
            position: absolute;
            top: 1rem;
            left: 1rem;
            color: var(--text-muted);
            background: white;
            padding: 0 0.25rem;
            transition: all 0.2s;
            pointer-events: none;
        }

        .form-input, .form-select {
            width: 100%;
            padding: 1rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.2s;
            background-color: white;
        }

        .form-input:focus, .form-select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
        }

        .form-input:focus + label,
        .form-input:not(:placeholder-shown) + label,
        .form-select:focus + label,
        .form-select:not([value=""]) + label {
            top: -0.5rem;
            left: 0.75rem;
            font-size: 0.75rem;
            color: var(--primary);
        }

        .form-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%236c757d' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 16px 12px;
        }

        .input-hint {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-top: 0.25rem;
            padding-left: 0.5rem;
        }

        .validation-error {
            color: var(--error);
            font-size: 0.75rem;
            margin-top: 0.25rem;
            padding-left: 0.5rem;
        }

        .error {
            border-color: var(--error) !important;
        }

        .error:focus {
            box-shadow: 0 0 0 3px rgba(239, 35, 60, 0.15) !important;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border-color);
        }

        .btn-primary, .btn-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
        }

        .btn-primary svg {
            stroke: white;
        }

        .btn-secondary {
            background-color: white;
            color: var(--text-muted);
            border: 1px solid var(--border-color);
        }

        .btn-secondary:hover {
            background-color: var(--light-gray);
        }
    </style>

    <script>
        // JavaScript to dynamically load subcategories when a category is selected
        document.getElementById('category_id').addEventListener('change', function() {
            var categoryId = this.value;

            if (categoryId) {
                fetch(`/admin/subcategories/getByCategory/${categoryId}`)
                    .then(response => response.json())
                    .then(data => {
                        let subcategoryDropdown = document.getElementById('subcategory_id');
                        subcategoryDropdown.innerHTML = '<option value=""></option>';

                        data.forEach(subcategory => {
                            let option = document.createElement('option');
                            option.value = subcategory.id;
                            option.textContent = subcategory.name;
                            subcategoryDropdown.appendChild(option);
                        });
                        
                        // Trigger floating label update
                        subcategoryDropdown.dispatchEvent(new Event('change'));
                    });
            } else {
                document.getElementById('subcategory_id').innerHTML = '<option value=""></option>';
            }
        });

        // Show/hide options field based on attribute type
        document.getElementById('type').addEventListener('change', function() {
            const optionsContainer = document.getElementById('options-container');
            optionsContainer.style.display = this.value === 'select' ? 'block' : 'none';
        });

        // Initialize options visibility on page load
        document.addEventListener('DOMContentLoaded', function() {
            const typeSelect = document.getElementById('type');
            const optionsContainer = document.getElementById('options-container');
            
            if (typeSelect.value === 'select') {
                optionsContainer.style.display = 'block';
            }
            
            // Initialize all floating labels
            document.querySelectorAll('.form-input, .form-select').forEach(el => {
                if (el.value || (el.tagName === 'SELECT' && el.selectedIndex > 0)) {
                    el.nextElementSibling.classList.add('floating');
                }
            });
        });
    </script>
@endsection