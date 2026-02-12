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
        <div class="min-h-screen bg-background">
            @include('components.sidebar', [
                'userName' => $userName ?? 'User',
                'userRole' => $userRole ?? 'user',
                'userCallsign' => $userCallsign ?? null
            ])
            
            <main class="pl-16 lg:pl-64 min-h-screen transition-all duration-300">
                <div class="p-6 lg:p-8 max-w-7xl mx-auto">
                    @yield('content')
                </div>
            </main>
        </div>
    </body>
</html>
