<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} | Product Details</title>
    <link href="{{ asset('css/product-show.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
   
</head>
<body>
    <x-navbar />
        <div class="product-hero">
        <i class="fas fa-cube"></i>
        <div>
            <div class="product-hero-title">{{ $product->name }}</div>
            <div class="product-hero-desc">Full description, reviews, and buying options available below.</div>
        </div>
        </div>


    <div class="container">
    <div class="product-card">
  <div class="product-image-panel">
    <!-- Optional badge if you have: -->
    <!-- <span class="product-badge">New</span> -->
    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image">
  </div>
  <div class="product-info">
    <p>{{ $product->description }}</p>
    <span class="price-tag">Price: €{{ number_format($product->price, 2) }}</span>
    <button class="add-to-cart">
      <i class="fas fa-shopping-cart"></i> Add to Cart
    </button>
  </div>
</div>

    </div>

    <x-footer />

</body>
</html>

