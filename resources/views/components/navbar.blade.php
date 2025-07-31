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
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            padding-top: 70px; /* Added to prevent content from hiding behind fixed navbar */
        }
        
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: white;
            height: 60px; /* Fixed height */
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            z-index: 1000;
            display: flex;
            align-items: center;
            padding: 0 20px;
        }
        
        .navbar.scrolled {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        
        .nav-link {
            position: relative;
        }
        
        .nav-link:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 0;
            background-color: #2563eb;
            transition: width 0.3s ease;
        }
        
        .nav-link:hover:after {
            width: 100%;
        }
        
        .mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }
        
        .mobile-menu.open {
            max-height: 500px;
        }
        
        .hamburger span {
            transition: all 0.3s ease;
        }
        
        .hamburger.active span:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }
        
        .hamburger.active span:nth-child(2) {
            opacity: 0;
        }
        
        .hamburger.active span:nth-child(3) {
            transform: rotate(-45deg) translate(5px, -5px);
        }
        .main-content {
            padding-top: 60px; /* Must match navbar height */
            min-height: calc(100vh - 60px); /* Optional: full viewport height minus navbar */
        }

        :root {
  --navbar-height: 60px;
}

.navbar {
  height: var(--navbar-height);
}

.main-content {
  padding-top: var(--navbar-height);
}

    </style>
</head>
<body>
    <!-- Navbar - Now properly fixed at the top -->
    <nav class="navbar">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <a href="#" class="logo flex items-center">
                    <span class="text-2xl font-bold text-dark">E-CoM</span>
                    <span class="ml-2 bg-primary text-white text-xs px-2 py-1 rounded-full">PRO</span>
                </a>

                <!-- Desktop Navigation -->
                <!-- Desktop Navigation -->
<div class="hidden md:flex items-center space-x-8">
    <div class="nav-links flex space-x-6">
        <a href="#" class="nav-link text-dark hover:text-primary font-medium">Home</a>
        <a href="#" class="nav-link text-dark hover:text-primary font-medium">Products</a>
        <a href="#" class="nav-link text-dark hover:text-primary font-medium">Categories</a>
        <a href="#" class="nav-link text-dark hover:text-primary font-medium">About</a>
        <a href="#" class="nav-link text-dark hover:text-primary font-medium">Contact</a>
    </div>
    <div class="nav-actions flex items-center space-x-4 ml-6">
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
</div>


                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-button" class="hamburger flex flex-col justify-center items-center w-8 h-8">
                        <span class="block w-6 h-0.5 bg-dark mb-1.5"></span>
                        <span class="block w-6 h-0.5 bg-dark mb-1.5"></span>
                        <span class="block w-6 h-0.5 bg-dark"></span>
                    </button>
                </div>
            </div>

            <!-- Mobile Navigation -->
            <div id="mobile-menu" class="mobile-menu md:hidden">
                <div class="pt-4 pb-2 space-y-2">
                    <a href="#" class="block px-3 py-2 rounded-md text-dark hover:bg-slate-100">Home</a>
                    <a href="#" class="block px-3 py-2 rounded-md text-dark hover:bg-slate-100">Products</a>
                    <a href="#" class="block px-3 py-2 rounded-md text-dark hover:bg-slate-100">Categories</a>
                    <a href="#" class="block px-3 py-2 rounded-md text-dark hover:bg-slate-100">About</a>
                    <a href="#" class="block px-3 py-2 rounded-md text-dark hover:bg-slate-100">Contact</a>
                    <div class="pt-2 mt-2 border-t border-slate-100">
                        <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-primary hover:bg-blue-50">Login</a>
                        <a href="{{ route('register') }}" class="block px-3 py-2 mt-2 rounded-md bg-primary text-white hover:bg-blue-700">Sign Up</a>

                    </div>
                </div>
            </div>
        </div>
        
    </nav>

    <!-- Page content - starts below the navbar -->
    

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