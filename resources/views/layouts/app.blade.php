<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Bootstrap CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Vite CSS -->
    @vite(['resources/css/app.css'])
</head>
<body>
    <div id="app">
        @include('layouts.navigation') <!-- Incluye tu navegación aquí -->
        <main class="container mt-4">
            @yield('content')
        </main>
    </div>
    
    <!-- Scripts de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Vite JS -->
    @vite(['resources/js/app.js'])

    <!-- Tu archivo JavaScript específico -->
    @yield('scripts')
</body>
</html>
