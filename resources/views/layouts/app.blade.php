<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Admin</title>

    <!-- Link to custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/custom-styles.css') }}">
</head>

<body>
    <div class="container">
        <header>
            <h1>Welcome to the Admin Panel</h1>

            <!-- Check if the user is an admin and display content accordingly -->
            @if(auth()->check() && auth()->user()->role === 'admin')
                <p>Welcome, Admin!</p>
                <!-- Admin specific navigation or links -->
                <nav>
                    <ul>
                        <li><a href="{{ route('products.create') }}">Create Product</a></li>
                    </ul>
                </nav>
            @else
            

            @endif
        </header>

        <!-- Logout Form -->
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>

        <main>
            @yield('content') <!-- Page-specific content goes here -->
        </main>
    </div>
</body>
</html>
