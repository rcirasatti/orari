@php
$statusConfig = [
    'draft' => ['label' => 'Draft', 'class' => 'bg-muted text-muted-foreground'],
    'pending' => ['label' => 'Diproses', 'class' => 'bg-warning/10 text-warning border border-warning/20'],
    'verified' => ['label' => 'Diverifikasi', 'class' => 'bg-info/10 text-info border border-info/20'],
    'approved' => ['label' => 'Disetujui', 'class' => 'bg-success/10 text-success border border-success/20'],
    'rejected' => ['label' => 'Ditolak', 'class' => 'bg-destructive/10 text-destructive border border-destructive/20'],
];

$config = $statusConfig[$status] ?? $statusConfig['draft'];
@endphp

<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $config['class'] }}">
    {{ $config['label'] }}
</span>
