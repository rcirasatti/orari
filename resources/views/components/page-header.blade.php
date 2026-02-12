<!-- Page Header Component -->
<div class="flex flex-col justify-between gap-4 mb-8 sm:flex-row sm:items-center">
    <div>
        <h1 class="text-3xl font-bold tracking-tight">{{ $title }}</h1>
        @isset($description)
            <p class="text-sm text-muted-foreground mt-2">{{ $description }}</p>
        @endisset
    </div>
    @isset($action)
        <div>{{ $action }}</div>
    @endisset
</div>
