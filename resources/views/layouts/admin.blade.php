<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - E-Commerce</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">
        <!-- Navbar -->
        <div class="bg-gray-800 p-4">
            <div class="flex items-center justify-between text-white">
                <a href="{{ route('dashboard') }}" class="font-bold text-lg">Admin Panel</a>
                <div class="flex space-x-4">
                    <a href="{{ route('categories.index') }}" class="hover:text-gray-300">Categories</a>
                    <a href="{{ route('subcategories.index') }}" class="hover:text-gray-300">Subcategories</a>
                    <a href="{{ route('products.index') }}" class="hover:text-gray-300">Products</a>
                    <a href="{{ route('logout') }}" class="hover:text-gray-300">Logout</a>
                </div>
            </div>
        </div>

        <div class="flex flex-grow">
            <div class="w-1/5 bg-white shadow-lg p-4">
                <h2 class="text-lg font-semibold mb-4">Admin Dashboard</h2>
                <ul>
                    <li><a href="{{ route('categories.index') }}" class="block py-2">Categories</a></li>
                    <li><a href="{{ route('subcategories.index') }}" class="block py-2">Subcategories</a></li>
                    <li><a href="{{ route('products.index') }}" class="block py-2">Products</a></li>
                </ul>
            </div>

            <div class="flex-grow p-6">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
