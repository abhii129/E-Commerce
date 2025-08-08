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

                <div class="flex items-center p-3 rounded-lg bg-gradient-to-r from-blue-50 via-white to-blue-50 shadow-sm gap-3 max-w-xs">
    <div class="flex-shrink-0">
        <svg class="w-9 h-9 text-blue-500 bg-blue-100 rounded-full p-1.5 shadow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <circle cx="12" cy="8" r="4" stroke="currentColor" stroke-width="1.5" fill="currentColor" class="text-blue-200" />
            <path fill="none" stroke="currentColor" stroke-width="1.5" d="M3 21.5c0-4.142 8-4.142 8 0M21 21.5c0-4.142-8-4.142-8 0"/>
        </svg>
    </div>
    <div>
        @if(auth()->check())
            <div class="font-semibold text-blue-700 leading-none">{{ auth()->user()->name }}</div>
            <div class="text-xs text-blue-400 mt-0.5">Logged In</div>
        @else
            <div class="font-semibold text-gray-500 leading-none">Guest</div>
            <div class="text-xs text-gray-400 mt-0.5">Not signed in</div>
        @endif
    </div>
</div>

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
