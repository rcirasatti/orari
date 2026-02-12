@extends('layouts.dashboard')

@section('title', 'Pengajuan Kenaikan Tingkat')

@section('content')
<div>
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold tracking-tight">Pengajuan Kenaikan Tingkat</h1>
        <p class="text-sm text-muted-foreground mt-2">Lengkapi form pengajuan kenaikan tingkat ORARI</p>
    </div>

    <!-- Step Indicator -->
    <div class="mb-8 bg-card p-6 rounded-xl shadow-card">
        <nav aria-label="Progress" class="w-full">
            <ol class="flex items-center justify-between">
                @foreach([1, 2, 3] as $step)
                    <li class="relative flex-1" data-step="{{ $step }}">
                        <div class="flex flex-col items-center">
                            @if($step > 1)
                                <div class="absolute left-0 right-1/2 top-4 h-0.5 -translate-y-1/2 step-line-{{ $step }}" style="background-color: var(--muted-border);"></div>
                            @endif
                            @if($step < 3)
                                <div class="absolute left-1/2 right-0 top-4 h-0.5 -translate-y-1/2 step-line-{{ $step + 1 }}" style="background-color: var(--muted-border);"></div>
                            @endif
                            
                            <div class="relative z-10 flex h-8 w-8 items-center justify-center rounded-full border-2 font-semibold text-sm transition-all step-circle-{{ $step }}" style="border-color: var(--muted-border); background-color: var(--card-bg); color: var(--muted-text);">
                                <span class="step-number-{{ $step }}">{{ $step }}</span>
                                <span class="step-check-{{ $step }} hidden">✓</span>
                            </div>
                            
                            <div class="mt-2 text-center">
                                <p class="text-xs font-medium step-title-{{ $step }}" style="color: var(--muted-text);">
                                    @if($step === 1) Data Pribadi @elseif($step === 2) Komponen Penilaian @else Hasil & Kirim @endif
                                </p>
                                <p class="text-xs text-muted-foreground mt-0.5 hidden sm:block">
                                    @if($step === 1) Informasi dasar @elseif($step === 2) Dokumen & nilai @else Review pengajuan @endif
                                </p>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ol>
        </nav>
    </div>

    @php
        $formSteps = [
            ['id' => 1, 'title' => 'Data Pribadi', 'description' => 'Informasi dasar'],
            ['id' => 2, 'title' => 'Komponen Penilaian', 'description' => 'Dokumen & nilai'],
            ['id' => 3, 'title' => 'Hasil & Kirim', 'description' => 'Review pengajuan'],
        ];
    @endphp

    <!-- Step 1: Data Pribadi -->
    <div id="step1" class="space-y-6">
        <div class="rounded-lg border border-border bg-card p-6 shadow-card">
            <h3 class="text-lg font-semibold mb-4">Data Pribadi</h3>
            <p class="text-sm text-muted-foreground mb-6">Lengkapi informasi pribadi Anda</p>
            
            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label for="nama" class="text-sm font-medium">Nama Lengkap *</label>
                        <input id="nama" type="text" placeholder="Masukkan nama lengkap"
                               class="w-full px-3 py-2 border border-border rounded-lg bg-background text-foreground placeholder-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                    <div class="space-y-2">
                        <label for="callsign" class="text-sm font-medium">Callsign *</label>
                        <input id="callsign" type="text" placeholder="Contoh: YB1ABC"
                               class="w-full px-3 py-2 border border-border rounded-lg bg-background text-foreground placeholder-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                    <div class="space-y-2 md:col-span-2">
                        <label for="alamat" class="text-sm font-medium">Alamat *</label>
                        <input id="alamat" type="text" placeholder="Masukkan alamat lengkap"
                               class="w-full px-3 py-2 border border-border rounded-lg bg-background text-foreground placeholder-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                    <div class="space-y-2">
                        <label for="nomorIAR" class="text-sm font-medium">Nomor IAR *</label>
                        <input id="nomorIAR" type="text" placeholder="Nomor IAR"
                               class="w-full px-3 py-2 border border-border rounded-lg bg-background text-foreground placeholder-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                    <div class="space-y-2">
                        <label for="nri" class="text-sm font-medium">NRI *</label>
                        <input id="nri" type="text" placeholder="Nomor Registrasi Internasional"
                               class="w-full px-3 py-2 border border-border rounded-lg bg-background text-foreground placeholder-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                    <div class="space-y-2">
                        <label for="masaBerlaku" class="text-sm font-medium">Masa Berlaku *</label>
                        <input id="masaBerlaku" type="date"
                               class="w-full px-3 py-2 border border-border rounded-lg bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                    <div class="space-y-2">
                        <label for="lokal" class="text-sm font-medium">Lokal *</label>
                        <input id="lokal" type="text" placeholder="Nama lokal ORARI"
                               class="w-full px-3 py-2 border border-border rounded-lg bg-background text-foreground placeholder-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                    <div class="space-y-2">
                        <label for="elmer" class="text-sm font-medium">Nama ELMER *</label>
                        <input id="elmer" type="text" placeholder="Nama pembimbing"
                               class="w-full px-3 py-2 border border-border rounded-lg bg-background text-foreground placeholder-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                    <div class="space-y-2">
                        <label for="elmerCallsign" class="text-sm font-medium">Callsign ELMER *</label>
                        <input id="elmerCallsign" type="text" placeholder="Callsign pembimbing"
                               class="w-full px-3 py-2 border border-border rounded-lg bg-background text-foreground placeholder-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                </div>

                <div class="flex justify-end mt-8">
                    <button onclick="goToStep(2)" class="flex items-center gap-2 px-6 py-2 bg-primary text-primary-foreground rounded-lg font-medium hover:opacity-90 transition">
                        Lanjutkan
                        <span>→</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Step 2: Komponen Penilaian -->
    <div id="step2" class="space-y-6 hidden">
        <!-- Jumlah QSO -->
        <div class="rounded-lg border border-border bg-card p-6 shadow-card">
            <h3 class="text-lg font-semibold mb-4">Jumlah QSO</h3>
            <p class="text-sm text-muted-foreground mb-6">Klik untuk mengisi detail portofolio QSO</p>
            
            <div class="flex items-center gap-4">
                <div id="qsoBox" onclick="openQSOModal()" class="flex-1 p-4 border-2 border-dashed border-border rounded-lg cursor-pointer hover:border-accent hover:bg-accent/5 transition-colors">
                    <div class="text-center">
                        <p id="totalQSODisplay" class="text-3xl font-bold text-accent">0</p>
                        <p class="text-sm text-muted-foreground mt-1">Total QSO</p>
                    </div>
                </div>
                <button onclick="openQSOModal()" class="flex items-center gap-2 px-4 py-2 border border-border rounded-lg font-medium hover:bg-muted transition">
                    📤 Input QSO
                </button>
            </div>
        </div>

        <!-- Checklist Penilaian -->
        <div class="rounded-lg border border-border bg-card p-6 shadow-card">
            <h3 class="text-lg font-semibold mb-4">Checklist Penilaian</h3>
            
            <div class="space-y-4">
                <label class="flex items-center gap-3 p-4 bg-muted/30 rounded-lg cursor-pointer">
                    <input id="konsistensi" type="checkbox" class="w-4 h-4 rounded border-border">
                    <div class="flex-1">
                        <span class="font-medium">Konsistensi</span>
                        <p class="text-sm text-muted-foreground">Aktif dalam kegiatan amatir radio minimal 2 tahun</p>
                    </div>
                </label>
                <label class="flex items-center gap-3 p-4 bg-muted/30 rounded-lg cursor-pointer">
                    <input id="kontribusi" type="checkbox" class="w-4 h-4 rounded border-border">
                    <div class="flex-1">
                        <span class="font-medium">Kontribusi</span>
                        <p class="text-sm text-muted-foreground">Berkontribusi dalam kegiatan organisasi ORARI</p>
                    </div>
                </label>
            </div>
        </div>

        <!-- Pengurus ORARI Aktif -->
        <div class="rounded-lg border border-border bg-card p-6 shadow-card">
            <h3 class="text-lg font-semibold mb-4">Pengurus ORARI Aktif</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="space-y-2">
                    <label for="pengurusLokal" class="text-sm font-medium">Pengurus Lokal</label>
                    <select id="pengurusLokal" class="w-full px-3 py-2 border border-border rounded-lg bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                        <option value="">Pilih jabatan</option>
                        <option value="ketua">Ketua</option>
                        <option value="wakil">Wakil Ketua</option>
                        <option value="sekretaris">Sekretaris</option>
                        <option value="bendahara">Bendahara</option>
                        <option value="kabid">Kabid</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label for="pengurusDaerah" class="text-sm font-medium">Pengurus Daerah</label>
                    <select id="pengurusDaerah" class="w-full px-3 py-2 border border-border rounded-lg bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                        <option value="">Pilih jabatan</option>
                        <option value="ketua">Ketua</option>
                        <option value="wakil">Wakil Ketua</option>
                        <option value="sekretaris">Sekretaris</option>
                        <option value="bendahara">Bendahara</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label for="pejabat" class="text-sm font-medium">Pejabat Pemerintah</label>
                    <select id="pejabat" class="w-full px-3 py-2 border border-border rounded-lg bg-background text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                        <option value="">Pilih jabatan</option>
                        <option value="bupati">Bupati / Walikota</option>
                        <option value="wakil-bupati">Wakil Bupati</option>
                        <option value="sekda">Sekretaris Daerah</option>
                        <option value="kadis">Kepala Dinas</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Informasi Ambang Nilai -->
        @include('components.info-box', [
            'variant' => 'info',
            'title' => 'Ambang Nilai',
            'slot' => '<div class="flex flex-wrap gap-6"><div><span class="font-medium">Ambang NA Penggalang:</span><span class="ml-2">3.5</span></div><div><span class="font-medium">Ambang NA Penegak:</span><span class="ml-2">3.5</span></div></div>'
        ])

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4">
            <button onclick="goToStep(1)" class="flex items-center gap-2 px-6 py-2 border border-border rounded-lg font-medium hover:bg-muted transition">
                ← Kembali
            </button>
            <div class="flex-1"></div>
            <button onclick="handleReset()" class="flex items-center gap-2 px-6 py-2 border border-border rounded-lg font-medium hover:bg-muted transition">
                🔄 Reset
            </button>
            <button onclick="handleProcess()" class="flex items-center gap-2 px-6 py-2 bg-accent text-accent-foreground rounded-lg font-medium hover:opacity-90 transition">
                🧮 Proses Penilaian
            </button>
        </div>

        <!-- Hasil Penilaian -->
        <div id="hasilContainer" class="hidden space-y-4">
            <div id="hasilCard" class="rounded-lg border-2 border-border bg-card p-6 shadow-card">
                <h3 class="text-lg font-semibold mb-4">Hasil Penilaian</h3>
                
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
                    <div class="p-4 bg-muted/30 rounded-lg text-center">
                        <p class="text-sm text-muted-foreground">NAk</p>
                        <p id="hasilNak" class="text-2xl font-bold">0</p>
                    </div>
                    <div class="p-4 bg-muted/30 rounded-lg text-center">
                        <p class="text-sm text-muted-foreground">NKn</p>
                        <p id="hasilNkn" class="text-2xl font-bold">0</p>
                    </div>
                    <div class="p-4 bg-muted/30 rounded-lg text-center">
                        <p class="text-sm text-muted-foreground">NKt</p>
                        <p id="hasilNkt" class="text-2xl font-bold">0</p>
                    </div>
                    <div class="p-4 bg-muted/30 rounded-lg text-center">
                        <p class="text-sm text-muted-foreground">Nilai Pengurus</p>
                        <p id="hasilNilaiPengurus" class="text-2xl font-bold">0</p>
                    </div>
                    <div class="p-4 bg-muted/30 rounded-lg text-center">
                        <p class="text-sm text-muted-foreground">Nilai Pejabat</p>
                        <p id="hasilNilaiPejabat" class="text-2xl font-bold">0</p>
                    </div>
                    <div id="nilaiAkhirBox" class="p-4 bg-muted/30 rounded-lg text-center">
                        <p class="text-sm text-muted-foreground">Nilai Akhir</p>
                        <p id="hasilNilaiAkhir" class="text-2xl font-bold">0</p>
                    </div>
                </div>

                <div id="hasilStatus" class="p-6 rounded-lg text-center bg-muted/30">
                    <p class="text-lg font-bold mb-1">Tingkat: <span id="hasilTingkat">-</span></p>
                    <p id="hasilKeterangan" class="text-sm">-</p>
                </div>

                <div id="lanjutButton" class="hidden flex justify-end mt-6">
                    <button onclick="goToStep(3)" class="flex items-center gap-2 px-6 py-2 bg-primary text-primary-foreground rounded-lg font-medium hover:opacity-90 transition">
                        Lanjutkan ke Review
                        <span>→</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Step 3: Review & Submit -->
    <div id="step3" class="space-y-6 hidden">
        @include('components.info-box', [
            'variant' => 'success',
            'title' => 'Pengajuan Siap Dikirim',
            'slot' => 'Data Anda telah lengkap dan memenuhi syarat. Silakan review kembali sebelum mengirim pengajuan.'
        ])

        <div class="rounded-lg border border-border bg-card p-6 shadow-card">
            <h3 class="text-lg font-semibold mb-4">Ringkasan Pengajuan</h3>
            
            <div class="space-y-6">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-muted-foreground">Nama</p>
                        <p id="summaryNama" class="font-medium">-</p>
                    </div>
                    <div>
                        <p class="text-sm text-muted-foreground">Callsign</p>
                        <p id="summaryCallsign" class="font-medium">-</p>
                    </div>
                    <div>
                        <p class="text-sm text-muted-foreground">Total QSO</p>
                        <p id="summaryTotalQSO" class="font-medium">0</p>
                    </div>
                    <div>
                        <p class="text-sm text-muted-foreground">Nilai Akhir</p>
                        <p id="summaryNilaiAkhir" class="font-medium text-success">0</p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-sm text-muted-foreground">Kenaikan ke Tingkat</p>
                        <p id="summaryTingkat" class="font-medium text-lg text-accent">-</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-4">
            <button onclick="goToStep(2)" class="flex items-center gap-2 px-6 py-2 border border-border rounded-lg font-medium hover:bg-muted transition">
                ← Kembali
            </button>
            <div class="flex-1"></div>
            <form method="POST" action="{{ route('pengajuan.store') }}" class="w-full sm:w-auto">
                @csrf
                <input type="hidden" name="totalQSO" id="submitTotalQSO">
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-6 py-2 bg-success text-success-foreground rounded-lg font-medium hover:opacity-90 transition">
                    📤 Kirim Pengajuan
                </button>
            </form>
        </div>
    </div>

    <!-- QSO Modal -->
    <div id="qsoModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center">
        <div class="bg-card rounded-lg p-6 max-w-md w-11/12 shadow-lg border border-border">
            <h3 class="text-lg font-semibold mb-4">Input Jumlah QSO</h3>
            <p class="text-sm text-muted-foreground mb-4">Masukkan total jumlah QSO yang telah dilakukan</p>
            
            <input id="qsoInput" type="number" placeholder="Masukkan jumlah QSO" class="w-full px-3 py-2 border border-border rounded-lg bg-background text-foreground placeholder-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent mb-4">
            
            <div class="flex gap-4">
                <button onclick="closeQSOModal()" class="flex-1 px-4 py-2 border border-border rounded-lg font-medium hover:bg-muted transition">
                    Batal
                </button>
                <button onclick="saveQSO()" class="flex-1 px-4 py-2 bg-primary text-primary-foreground rounded-lg font-medium hover:opacity-90 transition">
                    Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let currentStep = 1;
let totalQSO = 0;
let hasilData = {
    nak: 0,
    nkn: 0,
    nkt: 0,
    nilaiPengurus: 0,
    nilaiPejabat: 0,
    nilaiAkhir: 0,
    tingkat: '',
    layak: false
};

function goToStep(step) {
    // Update step visibility
    document.getElementById('step1').classList.toggle('hidden', step !== 1);
    document.getElementById('step2').classList.toggle('hidden', step !== 2);
    document.getElementById('step3').classList.toggle('hidden', step !== 3);
    
    // Update step indicator
    updateStepIndicator(step);
    
    if (step === 3) updateSummary();
    currentStep = step;
    window.scrollTo(0, 0);
}

function updateStepIndicator(step) {
    for (let i = 1; i <= 3; i++) {
        const isCompleted = i < step;
        const isCurrent = i === step;
        
        const circle = document.querySelector(`.step-circle-${i}`);
        const number = document.querySelector(`.step-number-${i}`);
        const check = document.querySelector(`.step-check-${i}`);
        const title = document.querySelector(`.step-title-${i}`);
        
        if (isCompleted) {
            circle.style.borderColor = 'var(--accent)';
            circle.style.backgroundColor = 'var(--accent)';
            circle.style.color = 'var(--accent-foreground)';
            number.classList.add('hidden');
            check.classList.remove('hidden');
            title.style.color = 'var(--foreground)';
        } else if (isCurrent) {
            circle.style.borderColor = 'var(--accent)';
            circle.style.backgroundColor = 'var(--card-bg)';
            circle.style.color = 'var(--accent)';
            number.classList.remove('hidden');
            check.classList.add('hidden');
            title.style.color = 'var(--accent)';
        } else {
            circle.style.borderColor = 'var(--muted-border)';
            circle.style.backgroundColor = 'var(--card-bg)';
            circle.style.color = 'var(--muted-text)';
            number.classList.remove('hidden');
            check.classList.add('hidden');
            title.style.color = 'var(--muted-text)';
        }
        
        // Update connector lines
        if (i > 1) {
            const line = document.querySelector(`.step-line-${i}`);
            if (line) {
                line.style.backgroundColor = i <= step ? 'var(--accent)' : 'var(--muted-border)';
            }
        }
    }
}

function openQSOModal() {
    document.getElementById('qsoModal').classList.remove('hidden');
}

function closeQSOModal() {
    document.getElementById('qsoModal').classList.add('hidden');
    document.getElementById('qsoInput').value = '';
}

function saveQSO() {
    const value = parseInt(document.getElementById('qsoInput').value);
    if (!isNaN(value) && value >= 0) {
        totalQSO = value;
        document.getElementById('totalQSODisplay').textContent = value;
        closeQSOModal();
    }
}

function handleProcess() {
    const nak = Math.min(totalQSO / 100, 4);
    const nkn = document.getElementById('konsistensi').checked ? 1 : 0;
    const nkt = document.getElementById('kontribusi').checked ? 1 : 0;
    const nilaiPengurus = document.getElementById('pengurusLokal').value ? 0.5 : 0;
    const nilaiPejabat = document.getElementById('pejabat').value ? 0.3 : 0;
    const nilaiAkhir = nak + nkn + nkt + nilaiPengurus + nilaiPejabat;
    
    hasilData = {
        nak: parseFloat(nak.toFixed(2)),
        nkn,
        nkt,
        nilaiPengurus,
        nilaiPejabat,
        nilaiAkhir: parseFloat(nilaiAkhir.toFixed(2)),
        tingkat: nilaiAkhir >= 3.5 ? 'PENGGALANG' : 'BELUM MEMENUHI',
        layak: nilaiAkhir >= 3.5
    };
    
    // Update hasil display
    document.getElementById('hasilNak').textContent = hasilData.nak;
    document.getElementById('hasilNkn').textContent = hasilData.nkn;
    document.getElementById('hasilNkt').textContent = hasilData.nkt;
    document.getElementById('hasilNilaiPengurus').textContent = hasilData.nilaiPengurus;
    document.getElementById('hasilNilaiPejabat').textContent = hasilData.nilaiPejabat;
    document.getElementById('hasilNilaiAkhir').textContent = hasilData.nilaiAkhir;
    document.getElementById('hasilTingkat').textContent = hasilData.tingkat;
    
    const statusBox = document.getElementById('hasilStatus');
    const nilaiAkhirBox = document.getElementById('nilaiAkhirBox');
    
    if (hasilData.layak) {
        statusBox.className = 'p-6 rounded-lg text-center bg-success/10';
        document.getElementById('hasilKeterangan').className = 'text-sm text-success';
        document.getElementById('hasilKeterangan').textContent = 'LAYAK mendapatkan rekomendasi kenaikan tingkat';
        document.getElementById('nilaiAkhirBox').className = 'p-4 bg-success/10 rounded-lg text-center';
        document.getElementById('hasilNilaiAkhir').className = 'text-2xl font-bold text-success';
        document.getElementById('lanjutButton').classList.remove('hidden');
    } else {
        statusBox.className = 'p-6 rounded-lg text-center bg-destructive/10';
        document.getElementById('hasilKeterangan').className = 'text-sm text-destructive';
        document.getElementById('hasilKeterangan').textContent = 'BELUM MEMENUHI syarat kenaikan tingkat';
        document.getElementById('nilaiAkhirBox').className = 'p-4 bg-destructive/10 rounded-lg text-center';
        document.getElementById('hasilNilaiAkhir').className = 'text-2xl font-bold text-destructive';
        document.getElementById('lanjutButton').classList.add('hidden');
    }
    
    document.getElementById('hasilContainer').classList.remove('hidden');
}

function handleReset() {
    totalQSO = 0;
    document.getElementById('totalQSODisplay').textContent = '0';
    document.getElementById('konsistensi').checked = false;
    document.getElementById('kontribusi').checked = false;
    document.getElementById('pengurusLokal').value = '';
    document.getElementById('pengurusDaerah').value = '';
    document.getElementById('pejabat').value = '';
    document.getElementById('hasilContainer').classList.add('hidden');
}

function updateSummary() {
    document.getElementById('summaryNama').textContent = document.getElementById('nama').value || '-';
    document.getElementById('summaryCallsign').textContent = document.getElementById('callsign').value || '-';
    document.getElementById('summaryTotalQSO').textContent = totalQSO;
    document.getElementById('summaryNilaiAkhir').textContent = hasilData.nilaiAkhir;
    document.getElementById('summaryTingkat').textContent = hasilData.tingkat;
    document.getElementById('submitTotalQSO').value = totalQSO;
}

// Close QSO modal on background click
document.getElementById('qsoModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeQSOModal();
});
</script>
@endsection
