<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Com Navbar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2563eb',
                        secondary: '#7c3aed',
                        accent: '#059669',
                        dark: '#1e293b',
                        light: '#f8fafc'
                    }
                }
            }
        }
    </script>
 <style>
    :root {
        --navbar-height: 70px;
    }
    body {
        font-family: 'Inter', sans-serif;
        margin: 0;
        padding-top: var(--navbar-height);
        background-color: #f9fafb;
    }
    /* Rekorder Style Navbar */
    .navbar {
        position: fixed;
        top: 0; left: 0; right: 0;
        height: var(--navbar-height);
        z-index: 1000;
        background: transparent;
        transition: background-color 0.4s ease, backdrop-filter 0.4s ease, box-shadow 0.4s ease;
        display: flex;
        align-items: center;
    }
    .navbar.scrolled {
        background: rgba(17, 17, 17, 0.85);
        backdrop-filter: blur(6px);
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    .navbar .nav-link {
        position: relative;
        font-weight: 500;
        color: white;
        transition: color 0.3s ease;
    }
    .navbar.scrolled .nav-link {
        color: white;
    }
    .navbar .nav-link:after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: -2px;
        left: 0;
        background-color: white;
        transition: width 0.3s ease;
    }
    .navbar .nav-link:hover:after {
        width: 100%;
    }
    .navbar .brand {
        font-size: 1.4rem;
        font-weight: bold;
        color: white;
        text-decoration: none;
        transition: color 0.3s ease;
    }
    /* Mobile menu inherits scrolled bg */
    .mobile-menu {
        background: rgba(17, 17, 17, 0.95);
        backdrop-filter: blur(6px);
        color: white;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-out;
    }
    .mobile-menu.open {
        max-height: 500px;
    }
    .mobile-menu a {
        color: white;
    }
    /* Search bar in transparent mode */
    .navbar input[type="search"] {
        background: rgba(255, 255, 255, 0.1);
        border: none;
        color: white;
        transition: background 0.3s ease;
    }
    .navbar input[type="search"]::placeholder {
        color: rgba(255, 255, 255, 0.7);
    }
    .navbar.scrolled input[type="search"] {
        background: rgba(255, 255, 255, 0.15);
    }
</style>

</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container mx-auto flex items-center w-full px-4">
            <!-- Logo -->
            <a href="/" class="flex items-center mr-4">
                <span class="text-2xl font-bold text-dark">E-CoM</span>
                <span class="ml-2 bg-primary text-white text-xs px-2 py-1 rounded-full">PRO</span>
            </a>
            <!-- Address (Desktop only) -->
            <div class="hidden md:flex items-center text-sm bg-gray-100 rounded px-3 py-2 mr-6 select-none relative" x-data="{ open: false }" @click.away="open = false">
    <i class="fas fa-map-marker-alt mr-2 text-primary"></i>
    @auth
        <button @click="open = !open" class="truncate max-w-xs flex items-center space-x-1 focus:outline-none">
            <span>
                Deliver to {{ auth()->user()->defaultAddress->label ?? 'Address' }}
            </span>
            <span>
                , {{ auth()->user()->defaultAddress->city ?? '' }}, {{ auth()->user()->defaultAddress->postal_code ?? '' }}
            </span>
            <i class="fas fa-caret-down ml-1"></i>
        </button>

        <div x-show="open" x-transition class="absolute top-full mt-2 bg-white rounded shadow-lg z-50 max-w-xs w-full max-h-64 overflow-auto">
            @foreach(auth()->user()->addresses as $address)
                <form method="POST" action="{{ route('addresses.setDefault', $address) }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100 {{ $address->is_default ? 'font-semibold bg-gray-200' : '' }}">
                        {{ $address->label ?? 'Address' }}, {{ $address->city }}, {{ $address->postal_code }}
                    </button>
                </form>
            @endforeach

            <div class="border-t my-1"></div>
            <a href="{{ route('addresses.index') }}" class="block px-4 py-2 text-center text-blue-600 hover:underline">
                Manage Addresses
            </a>
        </div>
    @else
        <a href="{{ route('login') }}" class="text-primary hover:underline">Log in</a> to see your delivery info
    @endauth
</div>

<!-- Add AlpineJS CDN in layout -->
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>


            <!-- Search bar (centered and grows) -->
            <form action="{{ route('customer.products.index') }}" method="GET" class="hidden md:flex items-center flex-1 max-w-lg mx-4">
                <input
                    type="search"
                    name="search"
                    placeholder="Search products..."
                    class="w-full rounded-l-md border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary"
                    value="{{ request('search') }}"
                >
                <button type="submit" class="rounded-r-md bg-primary p-2 text-white hover:bg-primary-dark transition-colors" aria-label="Search">
                    <i class="fas fa-search"></i>
                </button>
            </form>
            <!-- Navigation links -->
            <div class="hidden md:flex items-center space-x-7 ml-4">
                <a href="/" class="nav-link text-dark hover:text-primary font-medium">Home</a>
                <a href="{{ route('footer.show', 'about_us_our_story') }}" class="nav-link text-dark hover:text-primary font-medium">About</a>
                <a href="{{ route('footer.show', 'customer_service_contact_us') }}" class="nav-link text-dark hover:text-primary font-medium">Contact</a>
                <a href="{{ route('cart.show') }}" class="nav-link text-dark hover:text-primary font-medium">Cart</a>
            </div>
            <!-- Auth links / actions -->
            <div class="hidden md:flex items-center space-x-2 ml-6">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-outline px-4 py-2 border border-primary text-primary font-medium rounded-md hover:bg-primary hover:text-white transition-colors">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-primary px-4 py-2 bg-primary text-white font-medium rounded-md hover:bg-blue-700 transition-colors shadow-sm">
                        Sign Up
                    </a>
                @endguest
                @auth
                    <x-user />
                    <!-- Logout form for security (POST) -->
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="btn btn-outline px-4 py-2 border border-primary text-primary font-medium rounded-md hover:bg-red-600 hover:text-white transition-colors ml-2">
                            <i class="fas fa-sign-out-alt mr-1"></i> Logout
                        </button>
                    </form>
                @endauth
            </div>
            <!-- Mobile Menu Button (right) -->
            <div class="md:hidden flex items-center ml-auto">
                <button id="mobile-menu-button" class="hamburger flex flex-col justify-center items-center w-8 h-8" aria-label="Open menu">
                    <span class="block w-6 h-0.5 bg-dark mb-1.5"></span>
                    <span class="block w-6 h-0.5 bg-dark mb-1.5"></span>
                    <span class="block w-6 h-0.5 bg-dark"></span>
                </button>
            </div>
        </div>
        <!-- Mobile Navigation -->
        <div id="mobile-menu" class="mobile-menu md:hidden w-full bg-white shadow-lg">
            <div class="pt-4 pb-2 space-y-2">
                <!-- Mobile search bar -->
                <form action="{{ route('customer.products.index') }}" method="GET" class="px-3 mb-3">
                    <input type="search" name="search" placeholder="Search products..." value="{{ request('search') }}"
                        class="w-full rounded-md border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary"
                    >
                </form>
                <!-- Mobile Address -->
                @auth
                    <div class="px-3 py-2 bg-gray-100 rounded mb-3 flex items-center text-sm text-gray-700 select-none">
                        <i class="fas fa-map-marker-alt mr-2 text-primary"></i>
                        Deliver to <span class="font-semibold ml-1">{{ auth()->user()->name }}</span>, Your City, 123456
                    </div>
                @else
                    <div class="px-3 py-2 rounded mb-3 text-center text-sm text-gray-700">
                        <a href="{{ route('login') }}" class="text-primary hover:underline">Login</a> to see delivery info
                    </div>
                @endauth

                <a href="/" class="block px-3 py-2 rounded-md text-dark hover:bg-slate-100">Home</a>
                <a href="{{ route('footer.show', 'about_us_our_story') }}" class="block px-3 py-2 rounded-md text-dark hover:bg-slate-100">About</a>
                <a href="{{ route('footer.show', 'customer_service_contact_us') }}" class="block px-3 py-2 rounded-md text-dark hover:bg-slate-100">Contact</a>
                <a href="{{ route('cart.show') }}" class="block px-3 py-2 rounded-md text-dark hover:bg-slate-100">Cart</a>
                <div class="pt-2 mt-2 border-t border-gray-100 space-y-2">
                    @guest
                        <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-primary hover:bg-blue-50">Login</a>
                        <a href="{{ route('register') }}" class="block px-3 py-2 rounded-md bg-primary text-white hover:bg-blue-700">Sign Up</a>
                    @endguest
                    @auth
                        <x-user />
                        <form action="{{ route('logout') }}" method="POST" class="block">
                            @csrf
                            <button type="submit" class="w-full text-left px-3 py-2 rounded-md text-primary hover:bg-blue-50">
                                <i class="fas fa-sign-out-alt mr-1"></i> Logout
                            </button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenuButton.addEventListener('click', () => {
            mobileMenuButton.classList.toggle('active');
            mobileMenu.classList.toggle('open');
        });

        // Navbar scroll effect
        const navbar = document.querySelector('.navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 10) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>
