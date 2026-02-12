@extends('layouts.dashboard')

@section('title', 'Dashboard Super Admin')

@section('content')
<div>
    <div class="mb-8">
        <h1 class="text-3xl font-bold tracking-tight">Dashboard Super Admin</h1>
        <p class="text-sm text-muted-foreground mt-2">Monitoring dan manajemen keseluruhan sistem ORARI</p>
    </div>

    @php
        $stats = [
            ['title' => 'Total User', 'value' => '1,234', 'icon' => '👥', 'color' => 'text-primary', 'change' => '+12%'],
            ['title' => 'Pengajuan Bulan Ini', 'value' => '89', 'icon' => '📄', 'color' => 'text-info', 'change' => '+8%'],
            ['title' => 'Disetujui', 'value' => '67', 'icon' => '✓', 'color' => 'text-success', 'change' => '+15%'],
            ['title' => 'Menunggu Review', 'value' => '12', 'icon' => '🕐', 'color' => 'text-warning', 'change' => '-5%'],
        ];
        
        $recentUsers = [
            ['id' => 1, 'nama' => 'Ahmad Surya', 'email' => 'ahmad@email.com', 'role' => 'User', 'callsign' => 'YB1ABC', 'status' => 'active'],
            ['id' => 2, 'nama' => 'Pak Darmawan', 'email' => 'darmawan@email.com', 'role' => 'ORLOK', 'callsign' => 'YB0KDA', 'status' => 'active'],
            ['id' => 3, 'nama' => 'Dr. Hendro', 'email' => 'hendro@email.com', 'role' => 'Verifikator', 'callsign' => 'YB0VER', 'status' => 'active'],
            ['id' => 4, 'nama' => 'Siti Nurhaliza', 'email' => 'siti@email.com', 'role' => 'User', 'callsign' => 'YB4JKL', 'status' => 'active'],
            ['id' => 5, 'nama' => 'Bambang Irawan', 'email' => 'bambang@email.com', 'role' => 'ORLOK', 'callsign' => 'YB0IRA', 'status' => 'inactive'],
        ];
        
        $recentPengajuan = [
            ['id' => 'PG-2024-001', 'nama' => 'Ahmad Surya', 'callsign' => 'YB1ABC', 'tingkat' => 'Penggalang', 'orlok' => 'Jakarta Selatan', 'tanggal' => '15 Jan 2024', 'nilai' => 3.75, 'status' => 'pending'],
            ['id' => 'PG-2024-002', 'nama' => 'Budi Santoso', 'callsign' => 'YB2DEF', 'tingkat' => 'Penegak', 'orlok' => 'Jakarta Pusat', 'tanggal' => '14 Jan 2024', 'nilai' => 4.2, 'status' => 'verified'],
            ['id' => 'PG-2024-003', 'nama' => 'Citra Dewi', 'callsign' => 'YB3GHI', 'tingkat' => 'Penggalang', 'orlok' => 'Bogor', 'tanggal' => '12 Jan 2024', 'nilai' => 3.5, 'status' => 'rejected'],
            ['id' => 'PG-2024-004', 'nama' => 'Dedi Prasetyo', 'callsign' => 'YB6PQR', 'tingkat' => 'Penegak', 'orlok' => 'Depok', 'tanggal' => '10 Jan 2024', 'nilai' => 3.9, 'status' => 'pending'],
        ];
    @endphp

    <!-- Stats Grid -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        @foreach($stats as $stat)
            <div class="rounded-lg border border-border bg-card p-6 shadow-card hover:shadow-lg transition">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm text-muted-foreground">{{ $stat['title'] }}</p>
                        <p class="text-2xl font-bold mt-1">{{ $stat['value'] }}</p>
                        <p class="text-xs mt-1 flex items-center gap-1 {{ str_contains($stat['change'], '+') ? 'text-success' : 'text-destructive' }}">
                            <span>{{ str_contains($stat['change'], '+') ? '📈' : '📉' }}</span>
                            {{ $stat['change'] }} dari bulan lalu
                        </p>
                    </div>
                    <div class="p-3 rounded-xl bg-muted {{ $stat['color'] }} text-xl">
                        {{ $stat['icon'] }}
                    </div>
                </div>
            </div>
        @endforeach
            </div>
        </div>
    </div>

    <!-- Recent Registrations -->
    <!-- Pending Applications Alert -->
    <div class="rounded-lg border border-warning/30 bg-warning/5 p-4 mb-8">
        <div class="flex items-center gap-3">
            <span class="text-warning text-lg">⚠️</span>
            <div>
                <p class="font-semibold text-warning">Ada 12 pengajuan menunggu review</p>
                <p class="text-sm text-muted-foreground">Pastikan semua pengajuan ditinjau oleh ORLOK dan Verifikator</p>
            </div>
            <button class="ml-auto px-4 py-2 border border-border rounded-lg font-medium hover:bg-muted transition">
                Lihat Semua
            </button>
        </div>
    </div>

    <!-- User Management & Recent Pengajuan Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- User Management -->
        <div class="rounded-lg border border-border bg-card p-6 shadow-card">
            <div class="flex flex-row items-center justify-between mb-6">
                <h3 class="text-lg font-semibold">Manajemen User (Terakhir)</h3>
                <button class="flex items-center gap-1 px-3 py-2 bg-primary text-primary-foreground rounded-lg font-medium hover:opacity-90 transition text-sm">
                    ➕ Tambah User
                </button>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-border">
                            <th class="text-left py-3 px-4 font-semibold">Nama</th>
                            <th class="text-left py-3 px-4 font-semibold">Role</th>
                            <th class="text-left py-3 px-4 font-semibold">Status</th>
                            <th class="text-left py-3 px-4 font-semibold"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(array_slice($recentUsers, 0, 4) as $user)
                            <tr class="border-b border-border hover:bg-muted/30">
                                <td class="py-4 px-4">
                                    <div>
                                        <p class="font-medium text-xs">{{ $user['nama'] }}</p>
                                        <p class="text-xs text-muted-foreground">{{ $user['callsign'] }}</p>
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    <span class="px-2 py-1 bg-primary/10 text-primary rounded text-xs font-medium">
                                        {{ $user['role'] }}
                                    </span>
                                </td>
                                <td class="py-4 px-4">
                                    <span class="text-xs font-medium px-2 py-1 rounded {{ $user['status'] === 'active' ? 'bg-success/10 text-success' : 'bg-destructive/10 text-destructive' }}">
                                        {{ $user['status'] === 'active' ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                <td class="py-4 px-4">
                                    <button onclick="openUserMenu(this)" class="p-2 hover:bg-muted rounded-lg transition">⋮</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <button class="w-full mt-2 text-primary font-medium hover:underline text-sm">
                Kelola Semua User →
            </button>
        </div>

        <!-- Recent Pengajuan -->
        <div class="rounded-lg border border-border bg-card p-6 shadow-card">
            <div class="flex flex-row items-center justify-between mb-6">
                <h3 class="text-lg font-semibold">Pengajuan Terbaru</h3>
                <button class="p-2 hover:bg-muted rounded-lg transition">
                    Lihat Semua →
                </button>
            </div>
            
            <div class="space-y-3">
                @foreach(array_slice($recentPengajuan, 0, 4) as $item)
                    <div class="flex items-center justify-between p-3 bg-muted/30 rounded-lg hover:bg-muted/50 transition-colors">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2">
                                <p class="font-medium text-sm">{{ $item['nama'] }}</p>
                                <span class="text-xs text-muted-foreground">({{ $item['callsign'] }})</span>
                            </div>
                            <p class="text-xs text-muted-foreground">
                                {{ $item['id'] }} • {{ $item['tingkat'] }} • {{ $item['orlok'] }}
                            </p>
                        </div>
                        <div class="flex items-center gap-2 ml-2">
                            @include('components.status-badge', ['status' => $item['status']])
                            <button onclick="openApprovalMenu(this)" class="p-2 hover:bg-muted rounded-lg transition">⋮</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- System Activity Log -->
    <div class="rounded-lg border border-border bg-card p-6 shadow-card">
        <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
            📊 Log Aktivitas Sistem
        </h3>
        
        <div class="space-y-3 max-h-64 overflow-y-auto">
            <div class="flex items-start gap-3 pb-3 border-b border-border">
                <div class="text-xs font-medium text-muted-foreground min-w-12">14:35</div>
                <div>
                    <p class="text-sm font-medium">Pak Darmawan</p>
                    <p class="text-xs text-muted-foreground">Mensetujui pengajuan PG-2024-002</p>
                </div>
            </div>
            <div class="flex items-start gap-3 pb-3 border-b border-border">
                <div class="text-xs font-medium text-muted-foreground min-w-12">13:20</div>
                <div>
                    <p class="text-sm font-medium">Dr. Hendro</p>
                    <p class="text-xs text-muted-foreground">Meverifikasi pengajuan PG-2024-001</p>
                </div>
            </div>
            <div class="flex items-start gap-3 pb-3 border-b border-border">
                <div class="text-xs font-medium text-muted-foreground min-w-12">12:15</div>
                <div>
                    <p class="text-sm font-medium">Ahmad Surya</p>
                    <p class="text-xs text-muted-foreground">Mengajukan pengajuan kenaikan tingkat</p>
                </div>
            </div>
            <div class="flex items-start gap-3 pb-3 border-b border-border">
                <div class="text-xs font-medium text-muted-foreground min-w-12">11:45</div>
                <div>
                    <p class="text-sm font-medium">Admin ORARI</p>
                    <p class="text-xs text-muted-foreground">Menambahkan user baru: Siti Nurhaliza</p>
                </div>
            </div>
            <div class="flex items-start gap-3">
                <div class="text-xs font-medium text-muted-foreground min-w-12">10:30</div>
                <div>
                    <p class="text-sm font-medium">Pak Darmawan</p>
                    <p class="text-xs text-muted-foreground">Menolak pengajuan PG-2024-003</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Modal -->
    <div id="detailModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center">
        <div class="bg-card rounded-lg p-6 max-w-2xl w-11/12 shadow-lg border border-border relative max-h-96 overflow-y-auto">
            <h3 class="text-lg font-semibold mb-4">Detail Pengajuan</h3>
            
            <div id="detailContent" class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs text-muted-foreground">ID Pengajuan</p>
                        <p id="detailId" class="font-semibold">-</p>
                    </div>
                    <div>
                        <p class="text-xs text-muted-foreground">Nama</p>
                        <p id="detailNama" class="font-semibold">-</p>
                    </div>
                    <div>
                        <p class="text-xs text-muted-foreground">Callsign</p>
                        <p id="detailCallsign" class="font-semibold">-</p>
                    </div>
                    <div>
                        <p class="text-xs text-muted-foreground">Tingkat</p>
                        <p id="detailTingkat" class="font-semibold">-</p>
                    </div>
                    <div>
                        <p class="text-xs text-muted-foreground">ORLOK</p>
                        <p id="detailOrlok" class="font-semibold">-</p>
                    </div>
                    <div>
                        <p class="text-xs text-muted-foreground">Nilai</p>
                        <p id="detailNilai" class="font-semibold">-</p>
                    </div>
                </div>
                <div>
                    <p class="text-xs text-muted-foreground mb-2">Status</p>
                    <div id="detailStatus">-</div>
                </div>
            </div>
            
            <button onclick="closeDetailModal()" class="absolute top-4 right-4 text-muted-foreground hover:text-foreground">✕</button>
        </div>
    </div>

    <!-- Approval Modal -->
    <div id="approvalModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center">
        <div class="bg-card rounded-lg p-6 max-w-lg w-11/12 shadow-lg border border-border relative">
            <h3 id="approvalTitle" class="text-lg font-semibold mb-4">Setujui Pengajuan</h3>
            
            <div id="approvalContent" class="space-y-4">
                <div class="p-3 bg-muted/50 rounded-lg">
                    <p id="approvalName" class="text-sm font-medium">-</p>
                    <p id="approvalkId" class="text-xs text-muted-foreground">-</p>
                </div>
                <div>
                    <label for="catatanApproval" class="text-sm font-medium block mb-2">Catatan</label>
                    <textarea id="catatanApproval" placeholder="Tambahkan catatan..." rows="4"
                              class="w-full px-3 py-2 border border-border rounded-lg bg-background text-foreground placeholder-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"></textarea>
                </div>
                <div class="flex gap-4">
                    <button onclick="closeApprovalModal()" class="flex-1 px-4 py-2 border border-border rounded-lg font-medium hover:bg-muted transition">
                        Batal
                    </button>
                    <button id="approvalBtn" onclick="submitApproval()" class="flex-1 px-4 py-2 bg-success text-success-foreground rounded-lg font-medium hover:opacity-90 transition">
                        Setujui Pengajuan
                    </button>
                </div>
            </div>
            
            <button onclick="closeApprovalModal()" class="absolute top-4 right-4 text-muted-foreground hover:text-foreground">✕</button>
        </div>
    </div>
</div>

<script>
let selectedApprovalId = null;
let approvalMode = 'approve';

function openDetailModal(id, nama, callsign, tingkat, orlok, nilai, status) {
    document.getElementById('detailModal').classList.remove('hidden');
    document.getElementById('detailId').textContent = id;
    document.getElementById('detailNama').textContent = nama;
    document.getElementById('detailCallsign').textContent = callsign;
    document.getElementById('detailTingkat').textContent = tingkat;
    document.getElementById('detailOrlok').textContent = orlok;
    document.getElementById('detailNilai').textContent = nilai;
    document.getElementById('detailStatus').innerHTML = '<span class="px-2 py-1 bg-primary/10 text-primary rounded text-xs font-medium">' + status + '</span>';
}

function closeDetailModal() {
    document.getElementById('detailModal').classList.add('hidden');
}

function openApprovalModal(id, nama, mode) {
    selectedApprovalId = id;
    approvalMode = mode;
    const title = mode === 'approve' ? 'Setujui Pengajuan' : 'Tolak Pengajuan';
    document.getElementById('approvalModal').classList.remove('hidden');
    document.getElementById('approvalTitle').textContent = title;
    document.getElementById('approvalName').textContent = nama + ' (' + id + ')';
    document.getElementById('catatanApproval').placeholder = mode === 'approve' ? 'Catatan persetujuan...' : 'Alasan penolakan...';
    document.getElementById('approvalBtn').textContent = mode === 'approve' ? 'Setujui Pengajuan' : 'Tolak Pengajuan';
    document.getElementById('approvalBtn').className = mode === 'approve' ? 'flex-1 px-4 py-2 bg-success text-success-foreground rounded-lg font-medium hover:opacity-90 transition' : 'flex-1 px-4 py-2 bg-destructive text-destructive-foreground rounded-lg font-medium hover:opacity-90 transition';
}

function closeApprovalModal() {
    document.getElementById('approvalModal').classList.add('hidden');
    document.getElementById('catatanApproval').value = '';
    selectedApprovalId = null;
}

function submitApproval() {
    const catatan = document.getElementById('catatanApproval').value;
    const message = approvalMode === 'approve' ? 'disetujui' : 'ditolak';
    alert('Pengajuan ' + message);
    closeApprovalModal();
}

function openUserMenu(element) {
    alert('Menu user options');
}

function openApprovalMenu(element) {
    alert('Menu approval options');
}

// Close modals on background click
document.getElementById('detailModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeDetailModal();
});

document.getElementById('approvalModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeApprovalModal();
});
</script>
    </div>
</div>
@endsection
