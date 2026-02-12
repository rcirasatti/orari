<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'ORARI') }} - @yield('title')</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-background text-foreground">
        @yield('content')
        
        <script defer>
            // Notification/Toast functionality
            if (typeof window !== 'undefined') {
                window.showNotification = function(message, type = 'info') {
                    // This will be enhanced with Alpine.js or similar if needed
                    console.log(`[${type}] ${message}`);
                };
            }
        </script>
    </body>
</html>
