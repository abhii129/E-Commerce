<div class="w-1/5 bg-white shadow-lg p-4">
    <h2 class="text-lg font-semibold mb-4">Admin Dashboard</h2>
    <ul class="space-y-4">
        <li><a href="{{ route('categories.index') }}" class="block py-2 text-gray-700 hover:bg-gray-200">Categories</a></li>
        <li><a href="{{ route('subcategories.index') }}" class="block py-2 text-gray-700 hover:bg-gray-200">Subcategories</a></li>
        <li><a href="{{ route('products.index') }}" class="block py-2 text-gray-700 hover:bg-gray-200">Products</a></li>
        
        <!-- Master Menu Dropdown -->
        <li>
            <button class="w-full text-left py-2 px-4 text-gray-700 hover:bg-gray-200" onclick="toggleDropdown('masterMenu')">
                Master Menu
            </button>
            <ul id="masterMenu" class="space-y-2 hidden pl-4">
                
                <!-- Customer Service Dropdown -->
                <li>
                    <button class="w-full text-left py-2 text-gray-700 hover:bg-gray-200" onclick="toggleDropdown('customerMenu')">
                        Customer Service
                    </button>
                    <ul id="customerMenu" class="space-y-2 hidden pl-4">
                        <li><a href="{{ route('admin.footer.edit', ['section_key' => 'customer_service_contact_us']) }}" class="block py-2 text-gray-700 hover:bg-gray-200">Edit Contact Us</a></li>
                        <li><a href="{{ route('admin.footer.edit', ['section_key' => 'customer_service_faqs']) }}" class="block py-2 text-gray-700 hover:bg-gray-200">Edit FAQs</a></li>
                        <li><a href="{{ route('admin.footer.edit', ['section_key' => 'customer_service_shipping_policy']) }}" class="block py-2 text-gray-700 hover:bg-gray-200">Edit Shipping Policy</a></li>
                        <li><a href="{{ route('admin.footer.edit', ['section_key' => 'customer_service_returns_exchanges']) }}" class="block py-2 text-gray-700 hover:bg-gray-200">Edit Returns & Exchanges</a></li>
                    </ul>
                </li>

                <!-- About Us Dropdown -->
                <li>
                    <button class="w-full text-left py-2 text-gray-700 hover:bg-gray-200" onclick="toggleDropdown('aboutUsMenu')">
                        About Us
                    </button>
                    <ul id="aboutUsMenu" class="space-y-2 hidden pl-4">
                        <li><a href="{{ route('admin.footer.edit', ['section_key' => 'about_us_our_story']) }}" class="block py-2 text-gray-700 hover:bg-gray-200">Edit Our Story</a></li>
                        <li><a href="{{ route('admin.footer.edit', ['section_key' => 'about_us_blog']) }}" class="block py-2 text-gray-700 hover:bg-gray-200">Edit Blog</a></li>
                        <li><a href="{{ route('admin.footer.edit', ['section_key' => 'about_us_careers']) }}" class="block py-2 text-gray-700 hover:bg-gray-200">Edit Careers</a></li>
                        <li><a href="{{ route('admin.footer.edit', ['section_key' => 'about_us_privacy_policy']) }}" class="block py-2 text-gray-700 hover:bg-gray-200">Edit Privacy Policy</a></li>
                    </ul>
                </li>
                
                <!-- Connect With Us Dropdown -->
                <li>
                    <button class="w-full text-left py-2 text-gray-700 hover:bg-gray-200" onclick="toggleDropdown('connectMenu')">
                        Connect With Us
                    </button>
                    <ul id="connectMenu" class="space-y-2 hidden pl-4">
                        <li><a href="{{ route('admin.footer.edit', ['section_key' => 'connect_with_us_facebook']) }}" class="block py-2 text-gray-700 hover:bg-gray-200">Edit Facebook</a></li>
                        <li><a href="{{ route('admin.footer.edit', ['section_key' => 'connect_with_us_instagram']) }}" class="block py-2 text-gray-700 hover:bg-gray-200">Edit Instagram</a></li>
                        <li><a href="{{ route('admin.footer.edit', ['section_key' => 'connect_with_us_twitter']) }}" class="block py-2 text-gray-700 hover:bg-gray-200">Edit Twitter</a></li>
                        <li><a href="{{ route('admin.footer.edit', ['section_key' => 'connect_with_us_pinterest']) }}" class="block py-2 text-gray-700 hover:bg-gray-200">Edit Pinterest</a></li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
</div>

<script>
    // Function to toggle the visibility of dropdown menus
    function toggleDropdown(menuId) {
        const menu = document.getElementById(menuId);
        menu.classList.toggle('hidden');
    }
</script>
