<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Halaman Tidak Ditemukan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-background text-foreground">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="max-w-md text-center">
            <div class="text-6xl font-bold text-primary mb-4">404</div>
            <h1 class="text-3xl font-bold mb-2">Halaman Tidak Ditemukan</h1>
            <p class="text-muted-foreground mb-8">
                Maaf, halaman yang Anda cari tidak ditemukan atau telah dipindahkan.
            </p>
            <a href="{{ route('index') }}" class="inline-block px-6 py-3 bg-primary text-primary-foreground rounded-lg font-medium hover:opacity-90 transition">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</body>
</html>
