@extends('layouts.dashboard')

@section('title', 'Riwayat Pengajuan')

@section('content')
<div>
    <div class="mb-8">
        <h1 class="text-3xl font-bold tracking-tight">Riwayat Pengajuan</h1>
        <p class="text-sm text-muted-foreground mt-2">Daftar pengajuan Anda beserta statusnya</p>
    </div>

    <div class="rounded-lg border border-border bg-card p-6 shadow-card">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-border">
                        <th class="text-left py-3 px-4 font-semibold">No</th>
                        <th class="text-left py-3 px-4 font-semibold">ID</th>
                        <th class="text-left py-3 px-4 font-semibold">Tanggal</th>
                        <th class="text-left py-3 px-4 font-semibold">Jenis</th>
                        <th class="text-left py-3 px-4 font-semibold">Status</th>
                        <th class="text-left py-3 px-4 font-semibold">Jumlah QSO</th>
                        <th class="text-left py-3 px-4 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $submissions = [
                            ['id' => 'PG-001', 'date' => '2026-01-15', 'jenis' => 'Piagam', 'status' => 'pending', 'totalQSO' => 24, 'notes' => 'Menunggu verifikasi'],
                            ['id' => 'PG-002', 'date' => '2026-01-20', 'jenis' => 'QSL', 'status' => 'approved', 'totalQSO' => 19, 'notes' => 'Selesai'],
                            ['id' => 'PG-003', 'date' => '2026-01-25', 'jenis' => 'Piagam', 'status' => 'rejected', 'totalQSO' => 5, 'notes' => 'Dokumen tidak lengkap'],
                        ];
                    @endphp
                    @foreach($submissions as $index => $submission)
                        <tr class="border-b border-border hover:bg-muted/30 transition-colors">
                            <td class="py-4 px-4">{{ $index + 1 }}</td>
                            <td class="py-4 px-4 font-medium">{{ $submission['id'] }}</td>
                            <td class="py-4 px-4">{{ $submission['date'] }}</td>
                            <td class="py-4 px-4">{{ $submission['jenis'] }}</td>
                            <td class="py-4 px-4">
                                @include('components.status-badge', ['status' => $submission['status']])
                            </td>
                            <td class="py-4 px-4">{{ $submission['totalQSO'] }}</td>
                            <td class="py-4 px-4">
                                <button type="button" class="text-accent hover:text-accent/80 text-xs font-medium" onclick="openDetailModal('{{ $submission['id'] }}', '{{ $submission['date'] }}', '{{ $submission['jenis'] }}', '{{ $submission['status'] }}', '{{ $submission['notes'] }}')">
                                    📄 Lihat
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Detail Modal -->
<div id="detailModal" class="hidden fixed inset-0 z-50 bg-black/50 flex items-center justify-center p-4">
    <div class="bg-card rounded-lg border border-border p-6 max-w-md w-full shadow-lg">
        <h3 class="text-lg font-semibold mb-4">Detail Pengajuan</h3>
        
        <div class="space-y-4 mb-6">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <h4 class="text-sm font-medium text-muted-foreground">ID</h4>
                    <p class="text-sm font-medium" id="modalId">-</p>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-muted-foreground">Tanggal</h4>
                    <p class="text-sm font-medium" id="modalDate">-</p>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-muted-foreground">Jenis</h4>
                    <p class="text-sm font-medium" id="modalJenis">-</p>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-muted-foreground">Status</h4>
                    <p class="text-sm font-medium" id="modalStatus">-</p>
                </div>
                <div class="col-span-2">
                    <h4 class="text-sm font-medium text-muted-foreground">Catatan</h4>
                    <p class="text-sm font-medium" id="modalNotes">-</p>
                </div>
            </div>
        </div>

        <button type="button" onclick="closeDetailModal()" class="w-full px-4 py-2 border border-border rounded-lg font-medium text-sm hover:bg-muted transition">
            Tutup
        </button>
    </div>
</div>

<script>
function openDetailModal(id, date, jenis, status, notes) {
    document.getElementById('modalId').textContent = id;
    document.getElementById('modalDate').textContent = date;
    document.getElementById('modalJenis').textContent = jenis;
    document.getElementById('modalStatus').textContent = status.charAt(0).toUpperCase() + status.slice(1);
    document.getElementById('modalNotes').textContent = notes;
    document.getElementById('detailModal').classList.remove('hidden');
}

function closeDetailModal() {
    document.getElementById('detailModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('detailModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeDetailModal();
});
</script>
@endsection
