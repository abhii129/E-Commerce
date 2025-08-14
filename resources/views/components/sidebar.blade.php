<div class="w-64 bg-white shadow-lg p-6 h-screen sticky top-0 overflow-y-auto">
    <!-- Logo/Branding -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Admin Panel</h1>
    </div>

    <!-- Main Navigation -->
    <nav class="space-y-1">
        <!-- Dashboard Link -->
        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
            </svg>
            Dashboard
        </a>

        <!-- Categories Section -->
        <div x-data="{ open: false }">
            <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                    Catalog
                </div>
                <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'transform rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div x-show="open" x-collapse class="pl-8 mt-1 space-y-1">
                <!-- Add this to the Catalog section -->
    <a href="{{ route('admin.product-attributes.index') }}" class="block px-4 py-2 text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">Product Attributes</a>
    <a href="{{ route('admin.categories.index') }}" class="block px-4 py-2 text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">Categories</a>
    <a href="{{ route('admin.subcategories.index') }}" class="block px-4 py-2 text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">Subcategories</a>
    <a href="{{ route('admin.products.index') }}" class="block px-4 py-2 text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">Products</a>
</div>

        </div>

        <!-- Customers Section -->
        <div x-data="{ open: false }">
            <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    Customers
                </div>
                <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'transform rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div x-show="open" x-collapse class="pl-8 mt-1 space-y-1">
            <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">Customers List</a>
<a href="{{ route('admin.addresses.index') }}" class="block px-4 py-2 text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">Addresses</a>

            </div>
        </div>

        <!-- Orders -->
        <a href="{{ route('admin.orders.index') }}" class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
            Orders
        </a>

        <!-- Content Management -->
        <div x-data="{ open: false }" class="pt-2">
            <h3 class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Content Management</h3>
            <div class="mt-2 space-y-1">
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            Footer Content
                        </div>
                        <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'transform rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="pl-8 mt-1 space-y-1">
                        <!-- Customer Service -->
                        <div x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-2 text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">
                                <span>Customer Service</span>
                                <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'transform rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div x-show="open" x-collapse class="pl-4 mt-1 space-y-1">
                                <a href="{{ route('admin.footer.edit', ['section_key' => 'customer_service_contact_us']) }}" class="block px-4 py-2 text-gray-500 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">Contact Us</a>
                                <a href="{{ route('admin.footer.edit', ['section_key' => 'customer_service_faqs']) }}" class="block px-4 py-2 text-gray-500 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">FAQs</a>
                                <a href="{{ route('admin.footer.edit', ['section_key' => 'customer_service_shipping_policy']) }}" class="block px-4 py-2 text-gray-500 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">Shipping Policy</a>
                                <a href="{{ route('admin.footer.edit', ['section_key' => 'customer_service_returns_exchanges']) }}" class="block px-4 py-2 text-gray-500 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">Returns & Exchanges</a>
                            </div>
                        </div>

                        <!-- About Us -->
                        <div x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-2 text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">
                                <span>About Us</span>
                                <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'transform rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div x-show="open" x-collapse class="pl-4 mt-1 space-y-1">
                                <a href="{{ route('admin.footer.edit', ['section_key' => 'about_us_our_story']) }}" class="block px-4 py-2 text-gray-500 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">Our Story</a>
                                <a href="{{ route('admin.footer.edit', ['section_key' => 'about_us_blog']) }}" class="block px-4 py-2 text-gray-500 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">Blog</a>
                                <a href="{{ route('admin.footer.edit', ['section_key' => 'about_us_careers']) }}" class="block px-4 py-2 text-gray-500 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">Careers</a>
                                <a href="{{ route('admin.footer.edit', ['section_key' => 'about_us_privacy_policy']) }}" class="block px-4 py-2 text-gray-500 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">Privacy Policy</a>
                            </div>
                        </div>

                        <!-- Connect With Us -->
                        <div x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-2 text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">
                                <span>Connect With Us</span>
                                <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'transform rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div x-show="open" x-collapse class="pl-4 mt-1 space-y-1">
                                <a href="{{ route('admin.footer.edit', ['section_key' => 'connect_with_us_facebook']) }}" class="block px-4 py-2 text-gray-500 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">Facebook</a>
                                <a href="{{ route('admin.footer.edit', ['section_key' => 'connect_with_us_instagram']) }}" class="block px-4 py-2 text-gray-500 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">Instagram</a>
                                <a href="{{ route('admin.footer.edit', ['section_key' => 'connect_with_us_twitter']) }}" class="block px-4 py-2 text-gray-500 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">Twitter</a>
                                <a href="{{ route('admin.footer.edit', ['section_key' => 'connect_with_us_pinterest']) }}" class="block px-4 py-2 text-gray-500 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">Pinterest</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Bottom Section -->
    <div class="absolute bottom-0 left-0 right-0 p-6 border-t border-gray-100">
        <div class="flex items-center">
            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                <span class="text-blue-600 font-medium">{{ auth()->check() ? substr(auth()->user()->name, 0, 1) : 'G' }}</span>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-900">{{ auth()->check() ? auth()->user()->name : 'Guest' }}</p>
                <p class="text-xs text-gray-500">{{ auth()->check() ? auth()->user()->email : 'Not signed in' }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Include Alpine.js for dropdown functionality -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>