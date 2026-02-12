@extends('layouts.dashboard')

@section('title', 'Dashboard ORLOK')

@section('content')
<div>
    <div class="mb-8">
        <h1 class="text-3xl font-bold tracking-tight">Dashboard ORLOK</h1>
        <p class="text-sm text-muted-foreground mt-2">Kelola pengajuan kenaikan tingkat dari member</p>
    </div>

    @php
        $stats = [
            ['title' => 'Menunggu Review', 'value' => '5', 'icon' => '🕐', 'color' => 'text-warning'],
            ['title' => 'Diproses', 'value' => '3', 'icon' => '📄', 'color' => 'text-info'],
            ['title' => 'Dikirim ke Verifikator', 'value' => '12', 'icon' => '✓', 'color' => 'text-success'],
        ];
        
        $pengajuanList = [
            ['id' => 'PG-2024-001', 'nama' => 'Ahmad Surya', 'callsign' => 'YB1ABC', 'tingkat' => 'Penggalang', 'tanggal' => '15 Jan 2024', 'nilai' => 3.75, 'status' => 'pending'],
            ['id' => 'PG-2024-002', 'nama' => 'Budi Santoso', 'callsign' => 'YB2DEF', 'tingkat' => 'Penegak', 'tanggal' => '14 Jan 2024', 'nilai' => 4.2, 'status' => 'pending'],
            ['id' => 'PG-2024-003', 'nama' => 'Citra Dewi', 'callsign' => 'YB3GHI', 'tingkat' => 'Penggalang', 'tanggal' => '12 Jan 2024', 'nilai' => 3.5, 'status' => 'verified'],
        ];
    @endphp

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        @foreach($stats as $stat)
            <div class="rounded-lg border border-border bg-card p-6 shadow-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-muted-foreground">{{ $stat['title'] }}</p>
                        <p class="text-3xl font-bold mt-1">{{ $stat['value'] }}</p>
                    </div>
                    <div class="p-3 rounded-xl bg-muted {{ $stat['color'] }} text-xl">
                        {{ $stat['icon'] }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pengajuan Table -->
    <div class="rounded-lg border border-border bg-card p-6 shadow-card">
        <div class="flex flex-row items-center justify-between mb-6">
            <h3 class="text-lg font-semibold">Daftar Pengajuan</h3>
            <div class="relative">
                <input id="searchInput" type="text" placeholder="Cari pengajuan..." 
                       class="pl-10 pr-4 py-2 w-64 border border-border rounded-lg bg-background text-foreground placeholder-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                <span class="absolute left-3 top-1/2 -translate-y-1/2">🔍</span>
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
                <tbody id="tableBody">
                    @foreach($pengajuanList as $item)
                        <tr class="border-b border-border hover:bg-muted/30 data-row" 
                            data-id="{{ strtolower($item['id']) }}"
                            data-nama="{{ strtolower($item['nama']) }}"
                            data-callsign="{{ strtolower($item['callsign']) }}">
                            <td class="py-4 px-4 font-medium">{{ $item['id'] }}</td>
                            <td class="py-4 px-4">{{ $item['nama'] }}</td>
                            <td class="py-4 px-4">{{ $item['callsign'] }}</td>
                            <td class="py-4 px-4">{{ $item['tingkat'] }}</td>
                            <td class="py-4 px-4">
                                <span class="font-semibold text-accent">{{ $item['nilai'] }}</span>
                            </td>
                            <td class="py-4 px-4">{{ $item['tanggal'] }}</td>
                            <td class="py-4 px-4">
                                @include('components.status-badge', ['status' => $item['status']])
                            </td>
                            <td class="py-4 px-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button class="p-2 hover:bg-muted rounded-lg transition" title="Lihat detail">
                                        👁️
                                    </button>
                                    @if($item['status'] === 'pending')
                                        <button onclick="openAccModal('{{ $item['id'] }}', '{{ $item['nama'] }}', '{{ $item['callsign'] }}', '{{ $item['tingkat'] }}')" 
                                                class="px-3 py-1 text-sm bg-accent text-accent-foreground rounded-lg font-medium hover:opacity-90 transition">
                                            ACC
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- ACC Modal -->
    <div id="accModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center">
        <div class="bg-card rounded-lg p-6 max-w-md w-11/12 shadow-lg border border-border relative">
            <h3 class="text-lg font-semibold mb-4">Proses Rekomendasi</h3>
            
            <div id="accModalContent" class="space-y-4">
                <div class="p-4 bg-muted/30 rounded-lg">
                    <p class="text-sm text-muted-foreground">Pengajuan</p>
                    <p id="modalNama" class="font-medium">-</p>
                    <p id="modalTingkat" class="text-sm">-</p>
                </div>

                <div class="space-y-4">
                    <div class="space-y-2">
                        <label for="tanggalRek" class="text-sm font-medium">Tanggal Rekomendasi *</label>
                        <input id="tanggalRek" type="date" class="w-full px-3 py-2 border border-border rounded-lg bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                    <div class="space-y-2">
                        <label for="nomorSurat" class="text-sm font-medium">Nomor Surat Rekomendasi *</label>
                        <input id="nomorSurat" type="text" placeholder="Contoh: 001/ORLOK-JKT/I/2024" 
                               class="w-full px-3 py-2 border border-border rounded-lg bg-background text-foreground placeholder-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                    <div class="space-y-2">
                        <label for="kepadaYth" class="text-sm font-medium">Kepada Yth *</label>
                        <input id="kepadaYth" type="text" placeholder="Nama penerima surat"
                               class="w-full px-3 py-2 border border-border rounded-lg bg-background text-foreground placeholder-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                    <div class="space-y-2">
                        <label for="namaVerifikator" class="text-sm font-medium">Nama Verifikator *</label>
                        <input id="namaVerifikator" type="text" placeholder="Nama verifikator yang dituju"
                               class="w-full px-3 py-2 border border-border rounded-lg bg-background text-foreground placeholder-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                </div>
            </div>

            <div class="flex gap-4 mt-6">
                <button onclick="printSurat()" class="flex-1 flex items-center justify-center gap-2 px-4 py-2 border border-border rounded-lg font-medium hover:bg-muted transition">
                    🖨️ Print Surat
                </button>
                <button onclick="kirimVerifikator()" class="flex-1 flex items-center justify-center gap-2 px-4 py-2 bg-success text-success-foreground rounded-lg font-medium hover:opacity-90 transition">
                    📤 Kirim ke Verifikator
                </button>
            </div>
            
            <button onclick="closeAccModal()" class="absolute top-4 right-4 text-muted-foreground hover:text-foreground">✕</button>
        </div>
    </div>
</div>

<script>
function openAccModal(id, nama, callsign, tingkat) {
    document.getElementById('accModal').classList.remove('hidden');
    document.getElementById('modalNama').textContent = nama + ' (' + callsign + ')';
    document.getElementById('modalTingkat').textContent = 'Kenaikan ke ' + tingkat;
}

function closeAccModal() {
    document.getElementById('accModal').classList.add('hidden');
}

function printSurat() {
    alert('Fitur print sedang diproses...');
}

function kirimVerifikator() {
    const tanggal = document.getElementById('tanggalRek').value;
    const nomorSurat = document.getElementById('nomorSurat').value;
    const kepadaYth = document.getElementById('kepadaYth').value;
    const namaVerifikator = document.getElementById('namaVerifikator').value;
    
    if (!tanggal || !nomorSurat || !kepadaYth || !namaVerifikator) {
        alert('Semua kolom harus diisi!');
        return;
    }
    
    alert('Pengajuan berhasil dikirim ke verifikator');
    closeAccModal();
}

// Search functionality
document.getElementById('searchInput')?.addEventListener('keyup', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    document.querySelectorAll('[data-row]').forEach(row => {
        const text = (row.textContent || '').toLowerCase();
        row.style.display = text.includes(searchTerm) ? '' : 'none';
    });
});

// Close modal on background click
document.getElementById('accModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeAccModal();
});
</script>
