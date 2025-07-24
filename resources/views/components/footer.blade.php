<!-- Footer -->
<footer class="footer">
    <div class="footer-container">
        <div class="footer-column">
            <h3>Customer Service</h3>
            <ul class="footer-links">
                <li><a href="{{ route('customer.footer', ['section' => 'customer_service_contact_us']) }}">Contact Us</a></li>
                <li><a href="{{ route('customer.footer', ['section' => 'customer_service_faqs']) }}">FAQs</a></li>
                <li><a href="{{ route('customer.footer', ['section' => 'customer_service_shipping_policy']) }}">Shipping Policy</a></li>
                <li><a href="{{ route('customer.footer', ['section' => 'customer_service_returns_exchanges']) }}">Returns & Exchanges</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h3>About Us</h3>
            <ul class="footer-links">
                <li><a href="{{ route('customer.footer', ['section' => 'about_us_our_story']) }}">Our Story</a></li>
                <li><a href="{{ route('customer.footer', ['section' => 'about_us_blog']) }}">Blog</a></li>
                <li><a href="{{ route('customer.footer', ['section' => 'about_us_careers']) }}">Careers</a></li>
                <li><a href="{{ route('customer.footer', ['section' => 'about_us_privacy_policy']) }}">Privacy Policy</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h3>Connect With Us</h3>
            <ul class="footer-links">
                <li><a href="{{ route('customer.footer', ['section' => 'connect_with_us_facebook']) }}">Facebook</a></li>
                <li><a href="{{ route('customer.footer', ['section' => 'connect_with_us_instagram']) }}">Instagram</a></li>
                <li><a href="{{ route('customer.footer', ['section' => 'connect_with_us_twitter']) }}">Twitter</a></li>
                <li><a href="{{ route('customer.footer', ['section' => 'connect_with_us_pinterest']) }}">Pinterest</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; {{ date('Y') }} ShopName. All rights reserved.</p>
       
    </div>
</footer>

<style>
    
</style>
