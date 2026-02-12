@php
  $variantConfig = [
      'info' => ['icon' => 'ℹ️', 'class' => 'bg-info/5 border-info/20 text-info'],
      'warning' => ['icon' => '⚠️', 'class' => 'bg-warning/5 border-warning/20 text-warning'],
      'success' => ['icon' => '✅', 'class' => 'bg-success/5 border-success/20 text-success'],
      'error' => ['icon' => '❌', 'class' => 'bg-destructive/5 border-destructive/20 text-destructive'],
  ];

  $variant = $variant ?? 'info';
  $config = $variantConfig[$variant] ?? $variantConfig['info'];
  $title = $title ?? null;
@endphp

<div class="rounded-lg border p-4 {{ $config['class'] }}">
    <div class="flex gap-3">
        <div class="h-5 w-5 flex-shrink-0 mt-0.5 text-lg">{{ $config['icon'] }}</div>
        <div class="flex-1">
            @if($title)
                <h4 class="font-medium mb-1">{{ $title }}</h4>
            @endif
            <div class="text-sm opacity-90">{{ $slot }}</div>
        </div>
    </div>
</div>
