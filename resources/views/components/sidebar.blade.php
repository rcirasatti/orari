@php
// Role labels mapping from React AppSidebar
$roleLabels = [
    'user' => ['label' => 'Member ORARI', 'icon' => '📻'],
    'orlok' => ['label' => 'ORLOK Kabupaten', 'icon' => '🛡️'],
    'verifikator' => ['label' => 'Tim Verifikator', 'icon' => '✅'],
    'superadmin' => ['label' => 'Super Admin', 'icon' => '⚙️'],
];

// All navigation items from React AppSidebar
$allNavItems = [
    ['title' => 'Dashboard', 'href' => '/dashboard', 'icon' => '📊', 'roles' => ['user', 'orlok', 'verifikator', 'superadmin']],
    ['title' => 'Pengajuan Baru', 'href' => '/pengajuan', 'icon' => '📄', 'roles' => ['user']],
    ['title' => 'Riwayat Pengajuan', 'href' => '/riwayat', 'icon' => '📋', 'roles' => ['user']],
    ['title' => 'Daftar Pengajuan', 'href' => '/daftar-pengajuan', 'icon' => '📄', 'roles' => ['orlok', 'verifikator']],
    ['title' => 'Manajemen User', 'href' => '/users', 'icon' => '👥', 'roles' => ['superadmin']],
    ['title' => 'Semua Pengajuan', 'href' => '/semua-pengajuan', 'icon' => '📋', 'roles' => ['superadmin']],
    ['title' => 'Pengaturan', 'href' => '/pengaturan', 'icon' => '⚙️', 'roles' => ['superadmin']],
];

$userRole = $role ?? session('user_role') ?? 'user';
$userName = $userName ?? session('user_name') ?? 'User';
$userCallsign = $userCallsign ?? session('user_callsign') ?? null;
$roleInfo = $roleLabels[$userRole] ?? $roleLabels['user'];

// Filter nav items by role from React AppSidebar logic
$filteredNavItems = array_filter($allNavItems, fn($item) => in_array($userRole, $item['roles']));

$currentPath = request()->path();
@endphp

<aside class=\"fixed left-0 top-0 z-40 h-screen transition-all duration-300 ease-in-out w-64 bg-sidebar text-sidebar-foreground border-r border-sidebar-border\">
    <div class=\"flex h-full flex-col\">
        <!-- Header -->
        <div class=\"flex h-16 items-center justify-between px-4 border-b border-sidebar-border\">
            <div class=\"flex items-center gap-2\">
                <div class=\"flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-r from-accent to-accent\">
                    <span class=\"h-4 w-4\">📻</span>
                </div>
                <span class=\"font-bold text-lg\">ORARI</span>
            </div>
        </div>

        <!-- User Info -->
        <div class=\"border-b border-sidebar-border p-4\">
            <div class=\"space-y-2\">
                <div class=\"flex items-center gap-3\">
                    <div class=\"flex h-10 w-10 items-center justify-center rounded-full bg-sidebar-accent\">
                        <span class=\"text-sm font-semibold\">
                            {{ strtoupper(substr($userName, 0, 1)) }}
                        </span>
                    </div>
                    <div class=\"flex-1 min-w-0\">
                        <p class=\"text-sm font-medium truncate\">{{ $userName }}</p>
                        @if($userCallsign)
                            <p class=\"text-xs opacity-70\">{{ $userCallsign }}</p>
                        @endif
                    </div>
                </div>
                <div class=\"flex items-center gap-1.5 text-xs opacity-70\">
                    <span>{{ $roleInfo['icon'] }}</span>
                    <span>{{ $roleInfo['label'] }}</span>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class=\"flex-1 overflow-y-auto p-2\">
            <ul class=\"space-y-1\">
                @foreach($filteredNavItems as $item)
                    @php
                    // Dynamic href logic from React AppSidebar
                    $linkHref = $item['href'];
                    $displayTitle = $item['title'];
                    
                    if ($item['title'] === 'Dashboard') {
                        $linkHref = match($userRole) {
                            'user' => '/dashboard',
                            'orlok' => '/orlok',
                            'verifikator' => '/verifikator',
                            'superadmin' => '/superadmin',
                            default => '/dashboard',
                        };
                    } elseif ($item['title'] === 'Daftar Pengajuan') {
                        $linkHref = $userRole === 'verifikator' 
                            ? '/daftar-pengajuan/verifikator' 
                            : '/daftar-pengajuan';
                        $displayTitle = $userRole === 'verifikator' ? 'Riwayat Pengajuan' : 'Daftar Pengajuan';
                    }
                    @endphp
                    <li>
                        <a href=\"{{ $linkHref }}\"
                           class=\"flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors 
                                  {{ str_contains($currentPath, ltrim($linkHref, '/')) ? 'bg-sidebar-primary text-sidebar-primary-foreground' : 'hover:bg-sidebar-accent text-sidebar-foreground' }}\">
                            <span class=\"h-5 w-5 flex items-center justify-center\">{{ $item['icon'] }}</span>
                            <span>{{ $displayTitle }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>

        <!-- Footer -->
        <div class=\"border-t border-sidebar-border p-2\">
            <form method=\"POST\" action=\"{{ route('logout') }}\" class=\"w-full\">
                @csrf
                <button type=\"submit\"
                   class=\"w-full flex items-center justify-start gap-3 px-3 py-2 rounded-lg text-sm font-medium text-sidebar-foreground hover:bg-sidebar-accent hover:text-destructive transition-colors\">
                    <span class=\"h-5 w-5 flex items-center justify-center\">🚪</span>
                    <span>Keluar</span>
                </button>
            </form>
        </div>
    </div>
</aside>
