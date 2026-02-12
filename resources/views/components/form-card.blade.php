@php
  $className = $className ?? '';
  $title = $title ?? null;
  $description = $description ?? null;
@endphp

<div class="rounded-lg border border-border bg-card p-6 shadow-card {{ $className }}">
    @if($title || $description || isset($headerAction))
        <div class="mb-6 flex flex-row items-start justify-between space-y-0">
            <div>
                @if($title)
                    <h3 class="text-lg font-semibold text-foreground">{{ $title }}</h3>
                @endif
                @if($description)
                    <p class="mt-1 text-sm text-muted-foreground">{{ $description }}</p>
                @endif
            </div>
            @isset($headerAction)
                <div>{{ $headerAction }}</div>
            @endisset
        </div>
    @endif
    {{ $slot }}
</div>
