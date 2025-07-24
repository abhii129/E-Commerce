<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} | Product Details</title>
    <link href="{{ asset('css/product-show.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="page-title">{{ $product->name }}</h2>

        <div class="product-details">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image">
            <div class="product-info">
                <p>{{ $product->description }}</p>
                <p><span class="price-tag">Price: €{{ number_format($product->price, 2) }}</span></p>
                
                <!-- Add to Cart Button -->
                <button class="add-to-cart">
                    Add to Cart
                </button>
            </div>
        </div>
    </div>
</body>
</html>