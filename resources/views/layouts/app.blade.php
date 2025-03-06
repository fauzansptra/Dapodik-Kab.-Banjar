<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Welcome')</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/brand_logo.svg') }}">

    <!-- Bootstrap CSS (Example) -->
    {{--
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"> --}}
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom CSS (if needed) -->
    {{--
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
</head>

<body>
    @include('components.navbar')

    <main>
        @yield('content')
    </main>

    @include('components.footer')

    <!-- Bootstrap JS (Put before closing body tag) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>


</html>