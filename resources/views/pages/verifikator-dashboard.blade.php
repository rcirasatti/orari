@extends('layouts.dashboard')

@section('title', 'Dashboard Verifikator')

@section('content')
<div>
    <div class="mb-8">
        <h1 class="text-3xl font-bold tracking-tight">Dashboard Verifikator</h1>
        <p class="text-sm text-muted-foreground mt-2">Verifikasi pengajuan kenaikan tingkat</p>
    </div>

    @php
        $stats = [
            ['title' => 'Menunggu Verifikasi', 'value' => '8', 'icon' => '🕐', 'color' => 'text-warning'],
            ['title' => 'Disetujui', 'value' => '45', 'icon' => '✓', 'color' => 'text-success'],
            ['title' => 'Ditolak', 'value' => '3', 'icon' => '✕', 'color' => 'text-destructive'],
        ];
        
        $pengajuanList = [
            ['id' => 'PG-2024-001', 'nama' => 'Ahmad Surya', 'callsign' => 'YB1ABC', 'tingkat' => 'Penggalang', 'nilai' => 3.75, 'orlok' => 'ORLOK Jakarta Selatan', 'tanggalKirim' => '16 Jan 2024', 'status' => 'verified'],
            ['id' => 'PG-2024-002', 'nama' => 'Budi Santoso', 'callsign' => 'YB2DEF', 'tingkat' => 'Penegak', 'nilai' => 4.2, 'orlok' => 'ORLOK Jakarta Pusat', 'tanggalKirim' => '15 Jan 2024', 'status' => 'verified'],
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
            <h3 class="text-lg font-semibold">Daftar Pengajuan untuk Diverifikasi</h3>
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
                        <th class="text-left py-3 px-4 font-semibold">ORLOK</th>
                        <th class="text-left py-3 px-4 font-semibold">Tanggal</th>
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
                            <td class="py-4 px-4 text-sm">{{ $item['orlok'] }}</td>
                            <td class="py-4 px-4">{{ $item['tanggalKirim'] }}</td>
                            <td class="py-4 px-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button onclick="openDetailModal('{{ $item['id'] }}', '{{ $item['nama'] }}', '{{ $item['callsign'] }}', '{{ $item['tingkat'] }}', '{{ $item['nilai'] }}')" 
                                            class="p-2 hover:bg-muted rounded-lg transition" title="Lihat detail">
                                        👁️
                                    </button>
                                    <button onclick="openDecisionModal('{{ $item['id'] }}', '{{ $item['nama'] }}', '{{ $item['callsign'] }}', '{{ $item['tingkat'] }}')" 
                                            class="px-3 py-1 text-sm border border-border rounded-lg font-medium hover:bg-muted transition">
                                        Verifikasi
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Detail Modal -->
    <div id="detailModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center">
        <div class="bg-card rounded-lg p-6 max-w-2xl w-11/12 shadow-lg border border-border relative max-h-96 overflow-y-auto">
            <h3 class="text-lg font-semibold mb-4">Detail Pengajuan</h3>
            
            <div id="detailContent" class="space-y-6">
                <div class="grid grid-cols-2 gap-4">
                    <div class="p-4 bg-muted/30 rounded-lg">
                        <p class="text-sm text-muted-foreground">Nama</p>
                        <p id="detailNama" class="font-medium">-</p>
                    </div>
                    <div class="p-4 bg-muted/30 rounded-lg">
                        <p class="text-sm text-muted-foreground">Callsign</p>
                        <p id="detailCallsign" class="font-medium">-</p>
                    </div>
                    <div class="p-4 bg-muted/30 rounded-lg">
                        <p class="text-sm text-muted-foreground">Kenaikan ke</p>
                        <p id="detailTingkat" class="font-medium">-</p>
                    </div>
                    <div class="p-4 bg-muted/30 rounded-lg">
                        <p class="text-sm text-muted-foreground">Nilai Akhir</p>
                        <p id="detailNilai" class="font-medium text-accent">-</p>
                    </div>
                </div>

                <div>
                    <h4 class="font-medium mb-3">Dokumen Pendukung</h4>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between p-3 bg-muted/30 rounded-lg">
                            <div class="flex items-center gap-3">
                                <span>📄</span>
                                <span class="text-sm">Bukti QSO</span>
                            </div>
                            <button class="p-2 hover:bg-muted rounded-lg transition">📥</button>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-muted/30 rounded-lg">
                            <div class="flex items-center gap-3">
                                <span>📄</span>
                                <span class="text-sm">Surat Rekomendasi ORLOK</span>
                            </div>
                            <button class="p-2 hover:bg-muted rounded-lg transition">📥</button>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-muted/30 rounded-lg">
                            <div class="flex items-center gap-3">
                                <span>📄</span>
                                <span class="text-sm">Portofolio QSL Card</span>
                            </div>
                            <button class="p-2 hover:bg-muted rounded-lg transition">📥</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex gap-4 mt-6">
                <button onclick="closeDetailModal()" class="flex-1 px-4 py-2 border border-border rounded-lg font-medium hover:bg-muted transition">
                    Tutup
                </button>
            </div>
            
            <button onclick="closeDetailModal()" class="absolute top-4 right-4 text-muted-foreground hover:text-foreground">✕</button>
        </div>
    </div>

    <!-- Decision Modal -->
    <div id="decisionModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center">
        <div class="bg-card rounded-lg p-6 max-w-lg w-11/12 shadow-lg border border-border relative">
            <h3 class="text-lg font-semibold mb-4">Keputusan Verifikasi</h3>
            
            <div id="decisionContent" class="space-y-4">
                <div class="p-4 bg-info/10 rounded-lg border border-info/20">
                    <p class="text-sm text-info">
                        Anda akan memberikan keputusan untuk pengajuan <strong id="decisionNama">-</strong> (<span id="decisionCallsign">-</span>) - Kenaikan ke <strong id="decisionTingkat">-</strong>
                    </p>
                </div>

                <div class="space-y-2">
                    <label for="catatanVerifikasi" class="text-sm font-medium">Catatan Verifikasi (Opsional)</label>
                    <textarea id="catatanVerifikasi" placeholder="Tambahkan catatan jika diperlukan..." rows="4"
                              class="w-full px-3 py-2 border border-border rounded-lg bg-background text-foreground placeholder-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"></textarea>
                </div>
            </div>

            <div class="flex gap-4 mt-6">
                <button onclick="declineVerifikasi()" class="flex-1 flex items-center justify-center gap-2 px-4 py-2 border border-destructive text-destructive rounded-lg font-medium hover:bg-destructive/5 transition">
                    ✕ Tidak Layak
                </button>
                <button onclick="approveVerifikasi()" class="flex-1 flex items-center justify-center gap-2 px-4 py-2 bg-success text-success-foreground rounded-lg font-medium hover:opacity-90 transition">
                    ✓ Layak Naik Tingkat
                </button>
            </div>
            
            <button onclick="closeDecisionModal()" class="absolute top-4 right-4 text-muted-foreground hover:text-foreground">✕</button>
        </div>
    </div>
</div>

<script>
let selectedId = null;

function openDetailModal(id, nama, callsign, tingkat, nilai) {
    document.getElementById('detailModal').classList.remove('hidden');
    document.getElementById('detailNama').textContent = nama;
    document.getElementById('detailCallsign').textContent = callsign;
    document.getElementById('detailTingkat').textContent = tingkat;
    document.getElementById('detailNilai').textContent = nilai;
}

function closeDetailModal() {
    document.getElementById('detailModal').classList.add('hidden');
}

function openDecisionModal(id, nama, callsign, tingkat) {
    selectedId = id;
    document.getElementById('decisionModal').classList.remove('hidden');
    document.getElementById('decisionNama').textContent = nama;
    document.getElementById('decisionCallsign').textContent = callsign;
    document.getElementById('decisionTingkat').textContent = tingkat;
}

function closeDecisionModal() {
    document.getElementById('decisionModal').classList.add('hidden');
    document.getElementById('catatanVerifikasi').value = '';
    selectedId = null;
}

function approveVerifikasi() {
    const catatan = document.getElementById('catatanVerifikasi').value;
    alert('Pengajuan disetujui!');
    closeDecisionModal();
}

function declineVerifikasi() {
    const catatan = document.getElementById('catatanVerifikasi').value;
    alert('Pengajuan ditolak!');
    closeDecisionModal();
}

// Search functionality
document.getElementById('searchInput')?.addEventListener('keyup', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    document.querySelectorAll('[data-row]').forEach(row => {
        const text = (row.textContent || '').toLowerCase();
        row.style.display = text.includes(searchTerm) ? '' : 'none';
    });
});

// Close modals on background click
document.getElementById('detailModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeDetailModal();
});

document.getElementById('decisionModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeDecisionModal();
});
</script>
</div>
@endsection
