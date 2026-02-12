@extends('layouts.dashboard')

@section('title', 'Pengaturan')

@section('content')
<div>
    <div class="mb-8">
        <h1 class="text-3xl font-bold tracking-tight">Pengaturan</h1>
        <p class="text-sm text-muted-foreground mt-2">Pengaturan dan pengelolaan untuk Super Admin</p>
    </div>

    <div class="grid grid-cols-1 gap-6">
        <!-- General Settings Card -->
        <div class="rounded-lg border border-border bg-card p-6 shadow-card">
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-2">General</h3>
            </div>
            <div class="grid grid-cols-1 gap-4 max-w-2xl">
                <div>
                    <label class="text-sm font-medium">Nama Aplikasi</label>
                    <input type="text" value="ORARI ASCEND" class="w-full mt-2 px-3 py-2 border border-border rounded-lg bg-background text-foreground">
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <div>
                            <label class="text-sm font-medium">Pendaftaran Pengguna Baru</label>
                            <p class="text-sm text-muted-foreground mt-1">Izinkan pendaftaran akun baru</p>
                        </div>
                        <input type="checkbox" checked class="w-5 h-5 accent-accent">
                    </div>
                </div>

                <div>
                    <label class="text-sm font-medium">Role Default Untuk Registrasi</label>
                    <select class="w-60 mt-2 px-3 py-2 border border-border rounded-lg bg-background text-foreground">
                        <option selected>User</option>
                        <option>ORLOK</option>
                        <option>Verifikator</option>
                    </select>
                </div>

                <div class="flex gap-2 pt-2">
                    <button type="button" class="px-6 py-2 bg-primary text-primary-foreground rounded-lg font-medium text-sm hover:opacity-90 transition">
                        Simpan
                    </button>
                    <button type="button" class="px-6 py-2 border border-border rounded-lg font-medium text-sm hover:bg-muted transition">
                        Reset
                    </button>
                </div>
            </div>
        </div>

        <!-- Role & Authorization Card -->
        <div class="rounded-lg border border-border bg-card p-6 shadow-card">
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-2">Role & Otorisasi</h3>
            </div>
            <div class="grid grid-cols-1 gap-4 max-w-2xl">
                <div>
                    <div class="flex items-center justify-between">
                        <div>
                            <label class="text-sm font-medium">Wajib Persetujuan ORLOK</label>
                            <p class="text-sm text-muted-foreground mt-1">
                                Jika aktif, pengajuan akan menunggu persetujuan ORLOK sebelum diverifikasi
                            </p>
                        </div>
                        <input type="checkbox" checked class="w-5 h-5 accent-accent">
                    </div>
                </div>

                <div>
                    <label class="text-sm font-medium">Catatan</label>
                    <p class="text-sm text-muted-foreground mt-1">
                        Pengaturan peran dan otorisasi dapat diperluas sesuai kebutuhan (demo)
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
