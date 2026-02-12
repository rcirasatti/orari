<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'ORARI') }} - Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-background text-foreground">
    <div class="min-h-screen flex items-center justify-center p-4 gradient-hero">
        <div class="w-full max-w-md">
            <div class="rounded-lg border bg-card shadow-xl p-6">
                <div class="text-center pb-2 mb-6">
                    <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-xl gradient-accent">
                        <span class="text-2xl">📻</span>
                    </div>
                    <h2 class="text-2xl font-bold">Selamat Datang</h2>
                    <p class="text-sm text-muted-foreground mt-1">
                        Sistem Pengajuan Kenaikan Tingkat ORARI
                    </p>
                </div>

                <div class="space-y-6">
                    <div class="space-y-4">
                        <div class="space-y-2">
                            <label for="email" class="text-sm font-medium">Email</label>
                            <input id="email" type="email" placeholder="nama@email.com" required
                                   class="w-full px-3 py-2 border border-border rounded-lg bg-background text-foreground placeholder-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>
                        <div class="space-y-2">
                            <label for="password" class="text-sm font-medium">Password</label>
                            <div class="relative">
                                <input id="password" type="password" placeholder="Masukkan password" required
                                       class="w-full px-3 py-2 border border-border rounded-lg bg-background text-foreground placeholder-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                <button type="button" class="absolute right-3 top-2.5 text-muted-foreground hover:text-foreground"
                                        onclick="togglePassword()">
                                    <span id="eyeIcon">👁️</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="w-full px-4 py-2 bg-primary text-primary-foreground rounded-lg font-medium hover:opacity-90 transition"
                            onclick="loginAsRole('user')">
                        Masuk
                    </button>

                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <span class="w-full border-t border-border"></span>
                        </div>
                        <div class="relative flex justify-center text-xs uppercase">
                            <span class="bg-card px-2 text-muted-foreground">Demo Login</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <button type="button" class="px-4 py-2 border border-border rounded-lg hover:bg-muted transition text-sm font-medium"
                                onclick="loginAsRole('user')">
                            User
                        </button>
                        <button type="button" class="px-4 py-2 border border-border rounded-lg hover:bg-muted transition text-sm font-medium"
                                onclick="loginAsRole('orlok')">
                            ORLOK
                        </button>
                        <button type="button" class="px-4 py-2 border border-border rounded-lg hover:bg-muted transition text-sm font-medium"
                                onclick="loginAsRole('verifikator')">
                            Verifikator
                        </button>
                        <button type="button" class="px-4 py-2 border border-border rounded-lg hover:bg-muted transition text-sm font-medium"
                                onclick="loginAsRole('superadmin')">
                            Super Admin
                        </button>
                    </div>

                    <p class="text-center text-sm text-muted-foreground">
                        Belum punya akun?
                        <a href="#" class="font-medium text-accent hover:underline">Daftar di sini</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eyeIcon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.textContent = '🙈';
            } else {
                input.type = 'password';
                icon.textContent = '👁️';
            }
        }

        function loginAsRole(role) {
            // For demo purposes, set session data
            localStorage.setItem('demo_role', role);
            window.location.href = '/demo-login?role=' + role;
        }
    </script>
</body>
</html>
