
<x-navbar />

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/homepage.css') }}" rel="stylesheet">
    <title>{{ config('E-com') }} - Premium Products</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    
</head>
<body>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1 class="hero-title">Premium Products for Your Lifestyle</h1>
            <p class="hero-subtitle">Discover our curated collection of high-quality items designed to elevate your everyday</p>
            <div class="hero-cta">
                <a href="#featured" class="btn btn-primary">Shop Now</a>
                <a href="#categories" class="btn btn-outline">Browse Collections</a>
            </div>
        </div>
    </section>

<!-- Categories Section -->
<section class="categories-section" id="categories">
    <!-- Background Image with Subtle Overlay -->
    <div class="categories-bg" style="
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(rgba(255,255,255,0.5), rgba(255,255,255,0.6)), 
            url('https://images.unsplash.com/photo-1441986300917-64674bd600d8?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        z-index: 0;
    "></div>
    
    <div class="container" style="position: relative; z-index: 1;">
        <h2 class="section-title">Shop by Category</h2>
        <div class="categories-grid">
            @foreach($categories as $category)
                <div class="category-card">
                    <div class="category-image" style="background-image: url('{{ $category->image_url ?? asset('images/default-category.jpg') }}');"></div>
                    <div class="category-content">
                        <h3 class="category-name">{{ $category->name }}</h3>
                        <p class="category-description">
                            {{ $category->description ?? 'Explore our premium selection' }}
                        </p>
                        <a href="{{ route('category.products', $category->id) }}" class="btn btn-outline">Shop Now</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
   <!-- Featured Products Section -->
<!-- Featured Products Section -->
<section class="featured-products" id="featured">
  <div class="container">
    <h2 class="section-title">Most loved</h2>

    <div class="product-carousel">
      <button class="carousel-arrow left" onclick="prevSlide()" aria-label="Previous">‹</button>
      <div class="carousel-viewport">
        <div class="carousel-track" id="carouselTrack">
          @foreach($featuredProducts as $product)
          <div class="carousel-slide">
            <div class="product-card">
              <div class="product-image-container">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image">
                {{-- optional badge --}}
                {{-- <span class="badge-pill">Our pick</span> --}}
              </div>

              <div class="product-meta">
                <h3 class="meta-title">{{ $product->name }}</h3>
                <div class="meta-price">€{{ number_format($product->price, 2) }}</div>
                <div class="meta-subtle">
                  in {{ $product->colors_count ?? 5 }} colors
                </div>

                {{-- Optional swatches if you have an array like $product->colors = ['#000', '#f00', ...] --}}
                @if(!empty($product->colors ?? []))
                  <ul class="swatches">
                    @foreach($product->colors as $c)
                      <li style="--swatch: {{ $c }}"></li>
                    @endforeach
                  </ul>
                @endif

                <a href="{{ route('customer.products.show', $product->id) }}" class="meta-link">View details</a>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      <button class="carousel-arrow right" onclick="nextSlide()" aria-label="Next">›</button>
    </div>
  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const track = document.getElementById('carouselTrack');
  const slides = Array.from(track.children);
  let current = 0;
  let itemsPerView = getItemsPerView();

  // set widths on load + resize
  function applyWidths() {
    itemsPerView = getItemsPerView();
    const widthPct = 100 / itemsPerView;
    slides.forEach(s => s.style.minWidth = widthPct + '%');
    clampIndex();
    update();
  }

  function getItemsPerView() {
    const w = window.innerWidth;
    if (w <= 600) return 1;
    if (w <= 900) return 2;
    if (w <= 1200) return 3;
    return 4;
  }

  function clampIndex() {
    const max = Math.max(0, slides.length - itemsPerView);
    current = Math.min(current, max);
  }

  function update() {
    const step = 100 / itemsPerView; // slide by one card
    track.style.transform = `translateX(-${current * step}%)`;
  }

  function nextSlide() {
    const max = Math.max(0, slides.length - itemsPerView);
    current = Math.min(current + 1, max);
    update();
  }

  function prevSlide() {
    current = Math.max(current - 1, 0);
    update();
  }

  // expose for buttons
  window.nextSlide = nextSlide;
  window.prevSlide = prevSlide;

  // init
  applyWidths();
  window.addEventListener('resize', () => {
    // debounce-ish
    clearTimeout(window.__resizeTimer);
    window.__resizeTimer = setTimeout(applyWidths, 120);
  });
});
</script>


<style>
    /* === Most loved (4‑up, clean dividers) === */
.featured-products { padding: 40px 0; background:#fff; }

/* frame */
.product-carousel { position: relative; }
.carousel-viewport { overflow: hidden; }
.carousel-track { display:flex; transition: transform .45s ease; }

/* 4 columns by default; JS will set width too */
.carousel-slide { min-width: 25%; box-sizing: border-box; }

/* vertical column divider look */
.carousel-slide:not(:first-child) .product-card { border-left: 1px solid rgba(0,0,0,.06); }

/* card */
.product-card { background:#fff; display:flex; flex-direction:column; height:100%; }

/* image = tall but not huge */
.product-image-container { height: 360px; background:#f7f7f8; overflow:hidden; }
.product-image { width:100%; height:100%; object-fit:cover; transition: transform .5s ease; }
.product-card:hover .product-image { transform: scale(1.03); }

/* optional small pill badge (hidden by default) */
.badge-pill{
  position:absolute; top:12px; left:12px; font-size:.72rem; font-weight:700;
  background:#111; color:#fff; padding:6px 10px; border-radius:999px; opacity:.9;
}

/* meta */
.product-meta { text-align:center; padding:16px 12px 18px; }
.meta-title { font-size:1rem; font-weight:700; color:#111; margin:8px 0 4px; }
.meta-price { font-size:1rem; font-weight:700; color:#111; }
.meta-subtle { font-size:.85rem; color:#6b7280; margin-top:6px; }

/* swatches */
.swatches{ display:flex; justify-content:center; gap:8px; margin:10px 0 2px; padding:0; list-style:none; }
.swatches li{
  width:14px; height:14px; border-radius:50%;
  background: var(--swatch, #ddd);
  border:1px solid rgba(0,0,0,.12);
}

/* arrows */
.carousel-arrow{
  position:absolute; top:50%; transform:translateY(-50%);
  width:40px; height:40px; border-radius:50%;
  border:1px solid rgba(0,0,0,.08); background:#fff;
  box-shadow:0 6px 16px rgba(0,0,0,.08);
  display:grid; place-items:center; cursor:pointer;
  transition: transform .2s ease, background .2s ease;
  z-index:2;
}
.carousel-arrow.left{ left:8px; }
.carousel-arrow.right{ right:8px; }
.carousel-arrow:hover{ transform:translateY(-50%) scale(1.05); background:#f3f4f6; }

/* link */
.meta-link{
  display:inline-block; margin-top:10px; font-size:.9rem; font-weight:700;
  color:#111; text-decoration: none; position:relative;
}
.meta-link::after{
  content:''; position:absolute; left:0; right:0; bottom:-3px; height:1px; background:#111; opacity:.15;
}
.meta-link:hover{ text-decoration:underline; }

/* responsive: 3 / 2 / 1 columns */
@media (max-width: 1200px){
  .carousel-slide{ min-width: 33.3333%; }
  .product-image-container{ height: 320px; }
}
@media (max-width: 900px){
  .carousel-slide{ min-width: 50%; }
  .product-image-container{ height: 300px; }
}
@media (max-width: 600px){
  .carousel-slide{ min-width: 100%; }
  .product-image-container{ height: 260px; }
}

</style>
    <!-- Promo Banner -->
    <section class="promo-banner">
        <div class="container">
            <h2 class="promo-title">Summer Sale: Up to 40% Off</h2>
            <p class="promo-subtitle">Limited time offer on selected items</p>
            <a href="#" class="btn btn-primary">Shop the Sale</a>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="section">
        <div class="container">
            <h2 class="section-title">What Our Customers Say</h2>
            
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <div class="testimonial-rating">★★★★★</div>
                    <p class="testimonial-text">"The quality of these products exceeded my expectations. Fast shipping and excellent customer service too!"</p>
                    <p class="testimonial-author">Sarah M.</p>
                </div>
                
                <div class="testimonial-card">
                    <div class="testimonial-rating">★★★★★</div>
                    <p class="testimonial-text">"I've been a customer for years and the consistency in quality keeps me coming back. Highly recommended!"</p>
                    <p class="testimonial-author">James T.</p>
                </div>
                
                <div class="testimonial-card">
                    <div class="testimonial-rating">★★★★★</div>
                    <p class="testimonial-text">"Customer service went above and beyond when I had an issue. This level of care is rare these days."</p>
                    <p class="testimonial-author">Emma R.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Grid -->
  
    <!-- Newsletter -->
    <section class="section newsletter">
        <div class="container">
            <h2 class="section-title" style="color: white;">Join Our Community</h2>
            <p style="max-width: 600px; margin: 0 auto 30px; font-size: 1.1rem; opacity: 0.9;">
                Subscribe to get exclusive offers, product updates, and insider tips.
            </p>
            
            <form class="newsletter-form">
                <input type="email" class="newsletter-input" placeholder="Your email address" required>
                <button type="submit" class="newsletter-button">Subscribe</button>
            </form>
            
            <p style="font-size: 0.8rem; margin-top: 20px; opacity: 0.7;">
                We respect your privacy. Unsubscribe at any time.
            </p>
        </div>
    </section>

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
            
            // Auto-slide every 5 seconds
            function startInterval() {
                slideInterval = setInterval(nextSlide, 5000);
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
            const carousel = document.querySelector('.product-carousel');
            carousel.addEventListener('mouseenter', () => clearInterval(slideInterval));
            carousel.addEventListener('mouseleave', startInterval);
        });
    </script>
</body>
</html>
