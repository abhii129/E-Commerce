<!DOCTYPE html>
<html lang="en">
<head>
@stack('styles')

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Your Store</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9fafb;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        main {
            flex: 1;
            padding-top: 70px; /* Set padding to the ACTUAL height of your navbar! */
        }
    </style>
</head>
<body class="antialiased">
    <x-navbar />

    <main class="container mx-auto px-4 py-8">
        <br><br><br>
        @yield('content')
    </main>

    <x-footer />
</body>
</html>
