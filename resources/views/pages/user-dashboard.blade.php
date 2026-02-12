@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
<div>
    <!-- Page Header -->
    <div class="flex flex-col justify-between gap-4 mb-8 sm:flex-row sm:items-center">
        <div>
            <h1 class="text-3xl font-bold tracking-tight">Dashboard</h1>
            <p class="text-sm text-muted-foreground mt-2">Selamat datang kembali, Ahmad Surya</p>
        </div>
        <a href="{{ route('pengajuan.create') }}" class="inline-block">
            <button class="flex items-center gap-2 px-4 py-2 bg-primary text-primary-foreground rounded-lg font-medium hover:opacity-90 transition">
                <span>➕</span>
                Pengajuan Baru
            </button>
        </a>
    </div>

    <!-- Stats Grid -->
    @php
        $stats = [
            ['title' => 'Total Pengajuan', 'value' => '3', 'icon' => '📄', 'color' => 'text-primary'],
            ['title' => 'Sedang Diproses', 'value' => '1', 'icon' => '🕐', 'color' => 'text-warning'],
            ['title' => 'Disetujui', 'value' => '2', 'icon' => '✓', 'color' => 'text-success'],
            ['title' => 'Ditolak', 'value' => '0', 'icon' => '✕', 'color' => 'text-destructive'],
        ];
    @endphp
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        @foreach($stats as $stat)
            <div class="rounded-lg border border-border bg-card p-6 shadow-card hover:shadow-card-hover transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-muted-foreground">{{ $stat['title'] }}</p>
                        <p class="text-3xl font-bold mt-1">{{ $stat['value'] }}</p>
                    </div>
                    <div class="p-3 rounded-xl bg-muted {{ $stat['color'] }} text-2xl">
                        {{ $stat['icon'] }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Active Application Tracking -->
    <div class="rounded-lg border border-border bg-card p-6 shadow-card mb-8">
        <div class="flex flex-row items-center justify-between mb-6">
            <div>
                <h3 class="text-lg font-semibold">Pengajuan Aktif</h3>
                <p class="text-sm text-muted-foreground mt-1">
                    ID: PG-2024-001 • Kenaikan ke Penggalang
                </p>
            </div>
            @include('components.status-badge', ['status' => 'pending'])
        </div>
        
        <!-- Step Indicator -->
        <div class="mb-6">
            @include('components.step-indicator', [
                'steps' => [
                    ['id' => 1, 'title' => 'Pengajuan'],
                    ['id' => 2, 'title' => 'Review ORLOK'],
                    ['id' => 3, 'title' => 'Verifikasi'],
                    ['id' => 4, 'title' => 'Selesai'],
                ],
                'currentStep' => 2
            ])
        </div>

        <div class="mt-6 p-4 bg-muted/50 rounded-lg">
            <p class="text-sm">
                <span class="font-medium">Status saat ini:</span> Berkas sedang direview oleh ORLOK Kabupaten
            </p>
            <p class="text-xs text-muted-foreground mt-1">
                Terakhir diperbarui: 15 Januari 2024, 14:30 WIB
            </p>
        </div>
    </div>

    <!-- Recent Submissions -->
    <div class="rounded-lg border border-border bg-card p-6 shadow-card">
        <div class="flex flex-row items-center justify-between mb-6">
            <h3 class="text-lg font-semibold">Riwayat Pengajuan</h3>
            <a href="{{ route('pengajuan.history') }}" class="text-sm text-muted-foreground hover:text-foreground transition flex items-center gap-1">
                Lihat Semua
                <span>→</span>
            </a>
        </div>
        
        <div class="space-y-4">
            @php
                $submissions = [
                    [
                        'id' => 'PG-2024-001',
                        'date' => '15 Jan 2024',
                        'type' => 'Kenaikan ke Penggalang',
                        'status' => 'pending',
                    ],
                    [
                        'id' => 'PG-2023-042',
                        'date' => '10 Dec 2023',
                        'type' => 'Kenaikan ke Penegak',
                        'status' => 'approved',
                    ],
                ];
            @endphp
            @foreach($submissions as $submission)
                <div class="flex items-center justify-between p-4 bg-muted/30 rounded-lg hover:bg-muted/50 transition-colors">
                    <div class="flex items-center gap-4">
                        <div class="p-2 bg-primary/10 rounded-lg">
                            <span class="text-xl">📻</span>
                        </div>
                        <div>
                            <p class="font-medium">{{ $submission['type'] }}</p>
                            <p class="text-sm text-muted-foreground">
                                {{ $submission['id'] }} • {{ $submission['date'] }}
                            </p>
                        </div>
                    </div>
                    @include('components.status-badge', ['status' => $submission['status']])
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
