@extends('layouts.dashboard')

@section('title', 'Manajemen User')

@section('content')
<div>
    <div class="flex flex-col justify-between gap-4 mb-8 sm:flex-row sm:items-center">
        <div>
            <h1 class="text-3xl font-bold tracking-tight">Manajemen User</h1>
            <p class="text-sm text-muted-foreground mt-2">Kelola semua pengguna sistem</p>
        </div>
        <button type="button" class="flex items-center gap-2 px-4 py-2 bg-primary text-primary-foreground rounded-lg font-medium hover:opacity-90 transition">
            <span>➕</span>
            Tambah User
        </button>
    </div>

    <!-- Role Statistics -->
    @php
        $roleStats = [
            ['role' => 'User', 'count' => 3, 'icon' => '📻', 'color' => 'text-primary'],
            ['role' => 'ORLOK', 'count' => 2, 'icon' => '🛡️', 'color' => 'text-blue-500'],
            ['role' => 'Verifikator', 'count' => 1, 'icon' => '✅', 'color' => 'text-green-500'],
        ];
    @endphp
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        @foreach($roleStats as $stat)
            <div class="rounded-lg border border-border bg-card p-4 shadow-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-muted-foreground">{{ $stat['role'] }}</p>
                        <p class="text-3xl font-bold mt-1">{{ $stat['count'] }}</p>
                    </div>
                    <div class="text-4xl {{ $stat['color'] }}">{{ $stat['icon'] }}</div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="rounded-lg border border-border bg-card p-6 shadow-card">
        <div class="mb-4 flex gap-3">
            <input type="text" id="searchInput" placeholder="Cari berdasarkan nama atau email..." class="flex-1 px-3 py-2 border border-border rounded-lg bg-background text-foreground placeholder-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary">
            <select id="roleFilter" class="px-3 py-2 border border-border rounded-lg bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary">
                <option value="">-- Filter Role --</option>
                <option value="User">User</option>
                <option value="ORLOK">ORLOK</option>
                <option value="Verifikator">Verifikator</option>
                <option value="Super Admin">Super Admin</option>
            </select>
            <select id="statusFilter" class="px-3 py-2 border border-border rounded-lg bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary">
                <option value="">-- Filter Status --</option>
                <option value="active">Aktif</option>
                <option value="inactive">Nonaktif</option>
            </select>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-border">
                        <th class="text-left py-3 px-4 font-semibold">Nama</th>
                        <th class="text-left py-3 px-4 font-semibold">Email</th>
                        <th class="text-left py-3 px-4 font-semibold">Role</th>
                        <th class="text-left py-3 px-4 font-semibold">Callsign</th>
                        <th class="text-left py-3 px-4 font-semibold">Status</th>
                        <th class="text-left py-3 px-4 font-semibold">Tanggal Daftar</th>
                        <th class="text-right py-3 px-4 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $users = [
                            ['id' => 1, 'nama' => 'Ahmad Surya', 'email' => 'ahmad@email.com', 'role' => 'User', 'callsign' => 'YB1ABC', 'status' => 'active', 'createdAt' => '15 Jan 2024'],
                            ['id' => 2, 'nama' => 'Pak Darmawan', 'email' => 'darmawan@email.com', 'role' => 'ORLOK', 'callsign' => 'YB0KDA', 'status' => 'active', 'createdAt' => '10 Jan 2024'],
                            ['id' => 3, 'nama' => 'Dr. Hendro', 'email' => 'hendro@email.com', 'role' => 'Verifikator', 'callsign' => 'YB0VER', 'status' => 'active', 'createdAt' => '05 Jan 2024'],
                            ['id' => 4, 'nama' => 'Siti Nurhaliza', 'email' => 'siti@email.com', 'role' => 'User', 'callsign' => 'YB4JKL', 'status' => 'active', 'createdAt' => '01 Jan 2024'],
                            ['id' => 5, 'nama' => 'Bambang Irawan', 'email' => 'bambang@email.com', 'role' => 'ORLOK', 'callsign' => 'YB0IRA', 'status' => 'inactive', 'createdAt' => '20 Dec 2023'],
                        ];
                    @endphp
                    @foreach($users as $user)
                        <tr class="border-b border-border hover:bg-muted/30 transition-colors user-row" data-role="{{ $user['role'] }}" data-status="{{ $user['status'] }}" data-search="{{ strtolower($user['nama'] . ' ' . $user['email']) }}">
                            <td class="py-4 px-4 font-medium">{{ $user['nama'] }}</td>
                            <td class="py-4 px-4">{{ $user['email'] }}</td>
                            <td class="py-4 px-4">{{ $user['role'] }}</td>
                            <td class="py-4 px-4 text-xs font-mono">{{ $user['callsign'] }}</td>
                            <td class="py-4 px-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user['status'] === 'active' ? 'bg-success/10 text-success' : 'bg-destructive/10 text-destructive' }}">
                                    {{ $user['status'] === 'active' ? '🟢 Aktif' : '🔴 Nonaktif' }}
                                </span>
                            </td>
                            <td class="py-4 px-4 text-xs text-muted-foreground">{{ $user['createdAt'] }}</td>
                            <td class="py-4 px-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button type="button" class="p-2 hover:bg-muted rounded-lg transition" title="Edit">
                                        ✏️
                                    </button>
                                    <button type="button" class="p-2 hover:bg-muted rounded-lg transition text-destructive" title="Hapus">
                                        🗑️
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
document.getElementById('searchInput')?.addEventListener('keyup', filterTable);
document.getElementById('roleFilter')?.addEventListener('change', filterTable);
document.getElementById('statusFilter')?.addEventListener('change', filterTable);

function filterTable() {
    const searchTerm = document.getElementById('searchInput')?.value.toLowerCase() || '';
    const roleFilter = document.getElementById('roleFilter')?.value || '';
    const statusFilter = document.getElementById('statusFilter')?.value || '';

    document.querySelectorAll('.user-row').forEach(row => {
        const searchMatch = searchTerm === '' || row.getAttribute('data-search').includes(searchTerm);
        const roleMatch = roleFilter === '' || row.getAttribute('data-role') === roleFilter;
        const statusMatch = statusFilter === '' || row.getAttribute('data-status') === statusFilter;

        row.style.display = searchMatch && roleMatch && statusMatch ? '' : 'none';
    });
}
</script>
@endsection
