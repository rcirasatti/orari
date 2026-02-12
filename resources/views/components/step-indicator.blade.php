<nav aria-label="Progress" class="w-full {{ $className ?? '' }}">
    <ol class="flex items-center justify-between">
        @foreach($steps as $step)
            @php
                $isCompleted = ($step['id'] ?? 0) < $currentStep;
                $isCurrent = ($step['id'] ?? 0) === $currentStep;
                $index = $loop->index;
            @endphp
            <li class="relative flex-1">
                <div class="flex flex-col items-center">
                    <!-- Line connector before -->
                    @if($index !== 0)
                        <div class="absolute left-0 right-1/2 top-4 h-0.5 -translate-y-1/2 {{ $isCompleted || $isCurrent ? 'bg-accent' : 'bg-border' }}"></div>
                    @endif
                    @if($index !== count($steps) - 1)
                        <div class="absolute left-1/2 right-0 top-4 h-0.5 -translate-y-1/2 {{ $isCompleted ? 'bg-accent' : 'bg-border' }}"></div>
                    @endif
                    
                    <!-- Step circle -->
                    <div class="relative z-10 flex h-8 w-8 items-center justify-center rounded-full border-2 font-semibold text-sm transition-all duration-200
                        @if($isCompleted)
                            border-accent bg-accent text-accent-foreground
                        @elseif($isCurrent)
                            border-accent bg-card text-accent
                        @else
                            border-border bg-card text-muted-foreground
                        @endif">
                        @if($isCompleted)
                            ✓
                        @else
                            {{ $step['id'] ?? ($loop->index + 1) }}
                        @endif
                    </div>
                    
                    <!-- Step title -->
                    <div class="mt-2 text-center">
                        <p class="text-xs font-medium
                            @if($isCurrent)
                                text-accent
                            @elseif($isCompleted)
                                text-foreground
                            @else
                                text-muted-foreground
                            @endif">
                            {{ $step['title'] }}
                        </p>
                        @isset($step['description'])
                            <p class="text-xs text-muted-foreground mt-0.5 hidden sm:block">
                                {{ $step['description'] }}
                            </p>
                        @endisset
                    </div>
                </div>
            </li>
        @endforeach
    </ol>
</nav>
