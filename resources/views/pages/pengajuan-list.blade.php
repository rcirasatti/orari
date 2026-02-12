@extends('layouts.dashboard')

@section('title', 'Daftar Pengajuan')

@section('content')
<div>
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold tracking-tight">Daftar Pengajuan</h1>
        <p class="text-sm text-muted-foreground mt-2">Kelola pengajuan untuk ORLOK</p>
    </div>

    <div class="rounded-lg border border-border bg-card p-6 shadow-card">
        <div class="flex flex-row items-center justify-between mb-6">
            <h3 class="text-lg font-semibold">Daftar Pengajuan</h3>
            <div class="relative w-64">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-muted-foreground">🔍</span>
                <input type="text" id="searchInput" placeholder="Cari pengajuan..." class="pl-10 w-full px-3 py-2 border border-border rounded-lg bg-background text-foreground placeholder-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary">
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-border">
                        <th class="text-left py-3 px-4 font-semibold">ID</th>
                        <th class="text-left py-3 px-4 font-semibold">Nama</th>
                        <th class="text-left py-3 px-4 font-semibold">Callsign</th>
                        <th class="text-left py-3 px-4 font-semibold">Tingkat</th>
                        <th class="text-left py-3 px-4 font-semibold">Nilai</th>
                        <th class="text-left py-3 px-4 font-semibold">Tanggal</th>
                        <th class="text-left py-3 px-4 font-semibold">Status</th>
                        <th class="text-right py-3 px-4 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $pengajuanItems = [
                            ['id' => 'PG-2024-005', 'nama' => 'Dedi Prasetyo', 'callsign' => 'YB6PQR', 'tingkat' => 'Penggalang', 'nilai' => '3.8', 'tanggal' => '20 Jan 2024', 'status' => 'pending'],
                            ['id' => 'PG-2024-006', 'nama' => 'Melati Putri', 'callsign' => 'YB7STU', 'tingkat' => 'Penegak', 'nilai' => '4.0', 'tanggal' => '18 Jan 2024', 'status' => 'verified'],
                        ];
                    @endphp
                    @foreach($pengajuanItems as $item)
                        <tr class="border-b border-border hover:bg-muted/30 transition-colors">
                            <td class="py-4 px-4 font-medium">{{ $item['id'] }}</td>
                            <td class="py-4 px-4">{{ $item['nama'] }}</td>
                            <td class="py-4 px-4">{{ $item['callsign'] }}</td>
                            <td class="py-4 px-4">{{ $item['tingkat'] }}</td>
                            <td class="py-4 px-4"><span class="font-semibold text-accent">{{ $item['nilai'] }}</span></td>
                            <td class="py-4 px-4">{{ $item['tanggal'] }}</td>
                            <td class="py-4 px-4">
                                @include('components.status-badge', ['status' => $item['status']])
                            </td>
                            <td class="py-4 px-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button type="button" class="p-2 hover:bg-muted rounded-lg transition" title="Lihat">
                                        👁️
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.getElementById('searchInput').addEventListener('keyup', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const rows = document.querySelectorAll('tbody tr');
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchTerm) ? '' : 'none';
    });
});
</script>
@endsection
