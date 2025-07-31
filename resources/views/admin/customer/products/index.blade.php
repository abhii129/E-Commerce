<x-navbar />

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="{{ asset('css/customer-index.css') }}" rel="stylesheet">
    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <!-- Main Content -->

    <div class="container">

    <div class="products-banner">

    <h2 class="products-banner-title">
        <i class="fas fa-box-open"></i> Our Products
    </h2>
    <p class="products-banner-desc">
        Quality curated just for you – shop smart, shop elegant.
    </p>
</div>



        <!-- Category Filter -->
        <div class="category-filter">
            <h3>Filter by Category</h3>
            <form method="GET" action="{{ route('customer.products.index') }}">
                <select name="category" onchange="this.form.submit()" class="category-select">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" 
                                {{ request()->category == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        <!-- Featured Product Carousel -->
<div class="single-product-carousel">
    <div class="carousel-viewport">
        <div class="carousel-track" id="carouselTrack">
            @foreach($featuredProducts as $product)
            <div class="carousel-slide">
                <div class="carousel-product">
                    <div class="carousel-image-container">
                        <img src="{{ asset('storage/' . $product->image) }}" 
                             alt="{{ $product->name }}" 
                             class="carousel-image">
                    </div>
                    <div class="carousel-info">
                        <h3 class="carousel-title">{{ $product->name }}</h3>
                        <p class="carousel-description">{{ Str::limit($product->description, 200) }}</p>
                        <div class="carousel-price">€{{ number_format($product->price, 2) }}</div>
                        <div class="carousel-offer">20% OFF</div>
                        <a href="{{ route('customer.products.show', $product->id) }}" 
                           class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    
    <div class="carousel-controls">
        <button class="carousel-control" onclick="prevSlide()">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button class="carousel-control" onclick="nextSlide()">
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>
    
    <div class="carousel-indicators" id="carouselIndicators">
        @foreach($featuredProducts as $index => $product)
        <div class="carousel-indicator {{ $index === 0 ? 'active' : '' }}" 
             onclick="goToSlide({{ $index }})"></div>
        @endforeach
    </div>
</div>

        <!-- Products List -->
        <div class="product-list">
            @foreach($products as $product)
                <div class="product-item">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image">
                    <div class="product-content">
                        <h3 class="product-name">{{ $product->name }}</h3>
                        <p class="product-description">{{ Str::limit($product->description, 150) }}</p>
                        <p class="product-price">€{{ number_format($product->price, 2) }}</p>
                        <a href="{{ route('customer.products.show', $product->id) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

   

    <!-- Add this script at the bottom -->
    <script>
        function scrollCarousel(scrollAmount) {
            const carousel = document.getElementById('featuredCarousel');
            carousel.scrollBy({
                left: scrollAmount,
                behavior: 'smooth'
            });
        }

        // Auto-scroll carousel every 5 seconds
        setInterval(() => {
            scrollCarousel(200);
        }, 5000);
    </script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const track = document.getElementById('carouselTrack');
        const slides = document.querySelectorAll('.carousel-slide');
        const indicators = document.querySelectorAll('.carousel-indicator');
        let currentSlide = 0;
        const slideCount = slides.length;
        let slideInterval;
        
        // Initialize carousel
        function updateCarousel() {
            track.style.transform = `translateX(-${currentSlide * 100}%)`;
            
            // Update indicators
            indicators.forEach((indicator, index) => {
                indicator.classList.toggle('active', index === currentSlide);
            });
        }
        
        // Next slide function
        function nextSlide() {
            currentSlide = (currentSlide + 1) % slideCount;
            updateCarousel();
            resetInterval();
        }
        
        // Previous slide function
        function prevSlide() {
            currentSlide = (currentSlide - 1 + slideCount) % slideCount;
            updateCarousel();
            resetInterval();
        }
        
        // Go to specific slide
        function goToSlide(index) {
            currentSlide = index;
            updateCarousel();
            resetInterval();
        }
        
        // Auto-slide every 3 seconds
        function startInterval() {
            slideInterval = setInterval(nextSlide, 3000);
        }
        
        // Reset interval when user interacts
        function resetInterval() {
            clearInterval(slideInterval);
            startInterval();
        }
        
        // Initialize
        updateCarousel();
        startInterval();
        
        // Pause on hover
        const carousel = document.querySelector('.single-product-carousel');
        carousel.addEventListener('mouseenter', () => clearInterval(slideInterval));
        carousel.addEventListener('mouseleave', startInterval);
    });
</script>

<x-footer />
</body>
</html>