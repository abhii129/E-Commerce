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
                <a href="{{ route('products.index') }}" class="font-bold text-lg">Admin's Panel</a>
                <div class="flex space-x-4">
                    <a href="{{ route('categories.index') }}" class="hover:text-gray-300">Categories</a>
                    <a href="{{ route('subcategories.index') }}" class="hover:text-gray-300">Subcategories</a>
                    <a href="{{ route('products.index') }}" class="hover:text-gray-300">Products</a>
                    <a href="{{ route('customer.products.index') }}" class="hover:text-gray-300">View Products</a>

                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
    @csrf
    <button type="submit" class="hover:text-gray-300 bg-transparent border-none text-lg">Logout</button>
</form>
</div>
        </div>
    </div>
    <div class="flex flex-grow">
        <!-- Sidebar -->
        <x-sidebar /> <!-- This is the sidebar component you just created -->

        <div class="flex-grow p-6">
            @yield('content')
        </div>
    </div>
</div>
            
</body>
</html>
