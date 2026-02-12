@extends('layouts.dashboard')

@section('title', 'Semua Pengajuan')

@section('content')
<div>
    <div class="mb-8">
        <h1 class="text-3xl font-bold tracking-tight">Semua Pengajuan</h1>
        <p class="text-sm text-muted-foreground mt-2">Kelola semua pengajuan dari seluruh sistem</p>
    </div>

    <div class="rounded-lg border bg-card p-6 shadow-sm">
        <div class="mb-4 flex gap-2">
            <input type="text" placeholder="Cari berdasarkan ID atau nama..." class="flex-1 px-3 py-2 border rounded-lg bg-background text-foreground">
            <select class="px-3 py-2 border rounded-lg bg-background text-foreground">
                <option value="">-- Filter Status --</option>
                <option value="pending">Pending</option>
                <option value="verified">Verified</option>
                <option value="approved">Approved</option>
                <option value="rejected">Rejected</option>
            </select>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b">
                        <th class="text-left py-2 px-4 font-semibold">ID</th>
                        <th class="text-left py-2 px-4 font-semibold">Anggota</th>
                        <th class="text-left py-2 px-4 font-semibold">ORLOK</th>
                        <th class="text-left py-2 px-4 font-semibold">Kenaikan Ke</th>
                        <th class="text-left py-2 px-4 font-semibold">Status</th>
                        <th class="text-left py-2 px-4 font-semibold">Tanggal</th>
                        <th class="text-left py-2 px-4 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b hover:bg-muted/50">
                        <td class="py-4 px-4">PG-2024-050</td>
                        <td class="py-4 px-4">Ahmad Surya</td>
                        <td class="py-4 px-4">ORLOK Jakarta</td>
                        <td class="py-4 px-4">Penggalang</td>
                        <td class="py-4 px-4">
                            @include('components.status-badge', ['status' => 'pending'])
                        </td>
                        <td class="py-4 px-4">16 Jan 2024</td>
                        <td class="py-4 px-4">
                            <a href="#" class="text-accent hover:underline text-xs font-medium">Lihat</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
