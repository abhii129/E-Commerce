@extends('layouts.admin')

@section('content')
<link href="{{ asset('css/admin-products.css') }}" rel="stylesheet">
<div class="admin-products-container">
    <div class="admin-header">
        <h1 class="admin-title">Products</h1>
        <div class="flex items-center gap-4">
            <p class="welcome-message">Welcome, {{ Auth::user()->name }}!</p>
            <a href="{{ route('admin.products.create') }}" class="add-product-btn">Add Product</a>
        </div>
    </div>

    <table class="products-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Category</th>
                <th>Subcategory</th>
                <th>Price</th>
                <th>Availability</th>
                <th>Quantity</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ optional($product->subcategory)->name }}</td>
                    <td class="font-medium">${{ number_format($product->price, 2) }}</td>

                    <!-- Availability Badge -->
                    <td>
                        @if((int) $product->availability > 0)
                            <span class="availability-badge in-stock">
                                <span class="dot"></span>
                                In Stock
                            </span>
                        @else
                            <span class="availability-badge out-of-stock">
                                <span class="dot"></span>
                                Out of Stock
                            </span>
                        @endif
                    </td>

                    <!-- Quantity Control -->
                    <td>
                        <form action="{{ route('admin.products.updateAvailability', $product) }}" method="POST" class="quantity-form">
                            @csrf
                            @method('PATCH')
                            
                            <div class="quantity-control">
                                <button type="button" onclick="decrementQuantity({{ $product->id }})" class="quantity-btn minus">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="2" viewBox="0 0 12 2">
                                        <path d="M11 0H1a1 1 0 0 0 0 2h10a1 1 0 0 0 0-2z" fill="currentColor"/>
                                    </svg>
                                </button>
                                
                                <input
                                    id="availability-{{ $product->id }}"
                                    name="availability"
                                    type="number"
                                    min="0"
                                    value="{{ (int) $product->availability }}"
                                    class="quantity-input"
                                    onchange="validateQuantity({{ $product->id }})"
                                />
                                
                                <button type="button" onclick="incrementQuantity({{ $product->id }})" class="quantity-btn plus">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                                        <path d="M11 5H7V1a1 1 0 0 0-2 0v4H1a1 1 0 0 0 0 2h4v4a1 1 0 0 0 2 0V7h4a1 1 0 0 0 0-2z" fill="currentColor"/>
                                    </svg>
                                </button>
                            </div>
                            
                            <button type="submit" class="save-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                                    <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                    <polyline points="7 3 7 8 15 8"></polyline>
                                </svg>
                            </button>
                        </form>
                    </td>

                    <td>
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="product-image">
                    </td>
                    <td class="action-buttons">
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="action-btn edit-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                        </a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn delete-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                </svg>
                            </button>
                        </form>
                        <a href="{{ route('customer.products.show', $product->id) }}" class="action-btn view-btn ml-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    function incrementQuantity(id) {
        const input = document.getElementById(`availability-${id}`);
        input.stepUp();
        validateQuantity(id);
    }

    function decrementQuantity(id) {
        const input = document.getElementById(`availability-${id}`);
        input.stepDown();
        if (parseInt(input.value, 10) < 0) input.value = 0;
        validateQuantity(id);
    }

    function validateQuantity(id) {
        const input = document.getElementById(`availability-${id}`);
        if (parseInt(input.value, 10) < 0) {
            input.value = 0;
        }
    }
</script>

<style>
    /* Availability Badges */
    .availability-badge {
        display: inline-flex;
        align-items: center;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 500;
        line-height: 1;
    }

    .availability-badge .dot {
        display: inline-block;
        width: 6px;
        height: 6px;
        border-radius: 50%;
        margin-right: 6px;
    }

    .in-stock {
        background-color: #f0fdf4;
        color: #166534;
    }

    .in-stock .dot {
        background-color: #166534;
    }

    .out-of-stock {
        background-color: #fef2f2;
        color: #b91c1c;
    }

    .out-of-stock .dot {
        background-color: #b91c1c;
    }

    /* Quantity Control */
    .quantity-form {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .quantity-control {
        display: flex;
        align-items: center;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        overflow: hidden;
    }

    .quantity-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        background-color: #f9fafb;
        color: #4b5563;
        border: none;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .quantity-btn:hover {
        background-color: #f3f4f6;
    }

    .quantity-btn.minus {
        border-right: 1px solid #e5e7eb;
    }

    .quantity-btn.plus {
        border-left: 1px solid #e5e7eb;
    }

    .quantity-input {
        width: 50px;
        height: 28px;
        text-align: center;
        border: none;
        font-size: 14px;
        font-weight: 500;
        color: #111827;
        -moz-appearance: textfield;
    }

    .quantity-input::-webkit-outer-spin-button,
    .quantity-input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .save-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        background-color: #3b82f6;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .save-btn:hover {
        background-color: #2563eb;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .action-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        border-radius: 6px;
        transition: background-color 0.2s;
    }

    .edit-btn {
        color: #3b82f6;
        background-color: #eff6ff;
    }

    .edit-btn:hover {
        background-color: #dbeafe;
    }

    .delete-btn {
        color: #ef4444;
        background-color: #fef2f2;
    }

    .delete-btn:hover {
        background-color: #fee2e2;
    }

    .view-btn {
        color: #10b981;
        background-color: #ecfdf5;
    }

    .view-btn:hover {
        background-color: #d1fae5;
    }
</style>
@endsection