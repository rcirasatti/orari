<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'ORARI') }} - Sistem Pengajuan Kenaikan Tingkat</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-background text-foreground">
    <div class="min-h-screen bg-background">
        <!-- Hero Section -->
        <section class="relative overflow-hidden gradient-hero text-primary-foreground">
            <div class="absolute inset-0 opacity-50"></div>
            <div class="container mx-auto px-4 py-20 lg:py-32 relative">
                <div class="max-w-3xl mx-auto text-center">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-accent/20 text-accent-foreground text-sm font-medium mb-6">
                        <span class="text-lg">📻</span>
                        Sistem Pengajuan Kenaikan Tingkat
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                        Organisasi Amatir Radio Indonesia
                    </h1>
                    <p class="text-lg md:text-xl opacity-90 mb-8">
                        Platform digital untuk pengajuan dan verifikasi kenaikan tingkat anggota ORARI dengan proses yang transparan dan efisien.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('login') }}" class="inline-block">
                            <button class="px-8 py-3 bg-secondary text-secondary-foreground rounded-lg font-medium hover:opacity-90 transition flex items-center justify-center gap-2">
                                Masuk ke Sistem
                                <span class="text-lg">→</span>
                            </button>
                        </a>
                        <button class="px-8 py-3 bg-transparent border-2 border-primary-foreground/70 text-primary-foreground rounded-lg font-medium hover:bg-primary-foreground/10 transition">
                            Pelajari Lebih Lanjut
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="py-20 px-4 bg-background">
            <div class="container mx-auto">
                <div class="text-center max-w-2xl mx-auto mb-12">
                    <h2 class="text-3xl font-bold mb-4">Fitur Unggulan</h2>
                    <p class="text-muted-foreground">
                        Sistem yang dirancang untuk memudahkan proses pengajuan kenaikan tingkat
                    </p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Feature Card 1 -->
                    <div class="rounded-lg border bg-card p-6 shadow-sm hover:shadow-lg transition">
                        <div class="w-12 h-12 rounded-xl gradient-accent flex items-center justify-center mb-4 text-white">
                            📄
                        </div>
                        <h3 class="font-semibold text-lg mb-2">Pengajuan Online</h3>
                        <p class="text-sm text-muted-foreground">Ajukan kenaikan tingkat secara digital dengan form yang terstruktur</p>
                    </div>
                    
                    <!-- Feature Card 2 -->
                    <div class="rounded-lg border bg-card p-6 shadow-sm hover:shadow-lg transition">
                        <div class="w-12 h-12 rounded-xl gradient-accent flex items-center justify-center mb-4 text-white">
                            🕐
                        </div>
                        <h3 class="font-semibold text-lg mb-2">Tracking Realtime</h3>
                        <p class="text-sm text-muted-foreground">Pantau status pengajuan Anda dari mulai hingga selesai</p>
                    </div>
                    
                    <!-- Feature Card 3 -->
                    <div class="rounded-lg border bg-card p-6 shadow-sm hover:shadow-lg transition">
                        <div class="w-12 h-12 rounded-xl gradient-accent flex items-center justify-center mb-4 text-white">
                            ✓
                        </div>
                        <h3 class="font-semibold text-lg mb-2">Verifikasi Terpusat</h3>
                        <p class="text-sm text-muted-foreground">Proses verifikasi yang transparan dan tercatat</p>
                    </div>
                    
                    <!-- Feature Card 4 -->
                    <div class="rounded-lg border bg-card p-6 shadow-sm hover:shadow-lg transition">
                        <div class="w-12 h-12 rounded-xl gradient-accent flex items-center justify-center mb-4 text-white">
                            🛡️
                        </div>
                        <h3 class="font-semibold text-lg mb-2">Aman & Terpercaya</h3>
                        <p class="text-sm text-muted-foreground">Data tersimpan dengan aman dalam sistem terintegrasi</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Process Section -->
        <section class="py-20 px-4 bg-muted/50">
            <div class="container mx-auto">
                <div class="text-center max-w-2xl mx-auto mb-12">
                    <h2 class="text-3xl font-bold mb-4">Alur Pengajuan</h2>
                    <p class="text-muted-foreground">
                        Proses yang jelas dan terstruktur untuk kenaikan tingkat Anda
                    </p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 max-w-4xl mx-auto">
                    <!-- Step 1 -->
                    <div class="flex flex-col items-center text-center">
                        <div class="w-14 h-14 rounded-full gradient-primary flex items-center justify-center text-white font-bold text-xl mb-4 shadow-lg">
                            1
                        </div>
                        <h3 class="font-semibold mb-1">Isi Form</h3>
                        <p class="text-sm text-muted-foreground">Lengkapi data pribadi dan dokumen</p>
                    </div>
                    
                    <!-- Step 2 -->
                    <div class="flex flex-col items-center text-center">
                        <div class="w-14 h-14 rounded-full gradient-primary flex items-center justify-center text-white font-bold text-xl mb-4 shadow-lg">
                            2
                        </div>
                        <h3 class="font-semibold mb-1">Review ORLOK</h3>
                        <p class="text-sm text-muted-foreground">Diproses oleh ORLOK setempat</p>
                    </div>
                    
                    <!-- Step 3 -->
                    <div class="flex flex-col items-center text-center">
                        <div class="w-14 h-14 rounded-full gradient-primary flex items-center justify-center text-white font-bold text-xl mb-4 shadow-lg">
                            3
                        </div>
                        <h3 class="font-semibold mb-1">Verifikasi</h3>
                        <p class="text-sm text-muted-foreground">Diverifikasi oleh tim verifikator</p>
                    </div>
                    
                    <!-- Step 4 -->
                    <div class="flex flex-col items-center text-center">
                        <div class="w-14 h-14 rounded-full gradient-primary flex items-center justify-center text-white font-bold text-xl mb-4 shadow-lg">
                            4
                        </div>
                        <h3 class="font-semibold mb-1">Selesai</h3>
                        <p class="text-sm text-muted-foreground">Terima hasil keputusan</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20 px-4">
            <div class="container mx-auto">
                <div class="max-w-4xl mx-auto rounded-lg gradient-primary text-primary-foreground p-8 md:p-12 text-center">
                    <h2 class="text-2xl md:text-3xl font-bold mb-4">
                        Siap untuk Mengajukan Kenaikan Tingkat?
                    </h2>
                    <p class="opacity-90 mb-8 max-w-xl mx-auto">
                        Mulai pengajuan Anda sekarang dan pantau prosesnya secara realtime melalui sistem kami.
                    </p>
                    <a href="{{ route('login') }}" class="inline-block">
                        <button class="px-8 py-3 bg-secondary text-secondary-foreground rounded-lg font-medium hover:opacity-90 transition flex items-center justify-center gap-2 mx-auto">
                            Mulai Sekarang
                            <span class="text-lg">→</span>
                        </button>
                    </a>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="border-t py-8 px-4">
            <div class="container mx-auto flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg gradient-accent flex items-center justify-center text-white">
                        📻
                    </div>
                    <span class="font-semibold">ORARI</span>
                </div>
                <p class="text-sm text-muted-foreground">
                    © 2026 Organisasi Amatir Radio Indonesia. All rights reserved.
                </p>
            </div>
        </footer>
    </div>
</body>
</html>
