@php
// Exact role labels from React AppSidebar.tsx
$roleLabels = [
    'user' => 'Member ORARI',
    'orlok' => 'ORLOK Kabupaten',
    'verifikator' => 'Verifikator',
    'superadmin' => 'Super Admin',
];

// Exact navItems array from React AppSidebar.tsx
$allNavItems = [
    ['title' => 'Dashboard', 'href' => '/dashboard', 'roles' => ['user', 'orlok', 'verifikator', 'superadmin']],
    ['title' => 'Pengajuan Baru', 'href' => '/pengajuan', 'roles' => ['user']],
    ['title' => 'Riwayat Pengajuan', 'href' => '/riwayat', 'roles' => ['user']],
    ['title' => 'Daftar Pengajuan', 'href' => '/daftar-pengajuan', 'roles' => ['orlok', 'verifikator']],
    ['title' => 'Manajemen User', 'href' => '/users', 'roles' => ['superadmin']],
    ['title' => 'Semua Pengajuan', 'href' => '/semua-pengajuan', 'roles' => ['superadmin']],
    ['title' => 'Pengaturan', 'href' => '/pengaturan', 'roles' => ['superadmin']],
];

$userRole = $role ?? session('user_role') ?? 'user';
$userName = $userName ?? session('user_name') ?? 'User';
$userCallsign = $userCallsign ?? session('user_callsign') ?? null;
$roleLabel = $roleLabels[$userRole] ?? 'Member ORARI';

// Filter nav items by role (exact React logic)
$filteredNavItems = array_filter($allNavItems, fn($item) => in_array($userRole, $item['roles']));

$currentPath = request()->path();
@endphp

<aside id="sidebarAside" class="fixed left-0 top-0 z-40 h-screen transition-all duration-300 ease-in-out w-64 bg-sidebar text-sidebar-foreground">
    <div class="flex h-full flex-col">
        <!-- Header -->
        <div class="flex h-16 items-center justify-between px-4 border-b border-sidebar-border">
            <div id="logoSection" class="flex items-center gap-2">
                <div class="flex h-8 w-8 items-center justify-center rounded-lg gradient-accent">
                    <span class="h-4 w-4 text-accent-foreground">📻</span>
                </div>
                <span class="font-bold text-lg">ORARI</span>
            </div>
            <button 
                id="collapseBtn"
                onclick="toggleSidebar()" 
                class="h-8 w-8 flex items-center justify-center text-sidebar-foreground hover:bg-sidebar-accent rounded-lg transition-colors"
                aria-label="Toggle sidebar">
                <span id="chevronIcon" class="transition-transform">←</span>
            </button>
        </div>

        <!-- User Info (Exact React conditional rendering) -->
        <div id="userInfoSection" class="border-b border-sidebar-border p-4">
            <div class="space-y-2">
                <!-- Expanded view -->
                <div id="userInfoExpanded" class="space-y-2">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-sidebar-accent flex-shrink-0">
                            <span class="text-sm font-semibold">{{ strtoupper(substr($userName, 0, 1)) }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium truncate">{{ $userName }}</p>
                            @if($userCallsign)
                                <p class="text-xs opacity-70">{{ $userCallsign }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="flex items-center gap-1.5 text-xs opacity-70">
                        <span>📌</span>
                        <span>{{ $roleLabel }}</span>
                    </div>
                </div>

                <!-- Collapsed view (avatar only with tooltip) -->
                <div id="userInfoCollapsed" class="hidden mx-auto text-center">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-sidebar-accent mx-auto" title="{{ $userName }}{{ $userCallsign ? ' (' . $userCallsign . ')' : '' }}">
                        <span class="text-sm font-semibold">{{ strtoupper(substr($userName, 0, 1)) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation (Exact React conditional rendering) -->
        <nav class="flex-1 overflow-y-auto p-2">
            <ul class="space-y-1">
                @foreach($filteredNavItems as $item)
                    @php
                    // Exact dynamic href logic from React AppSidebar
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
                    
                    $isActive = str_starts_with($currentPath, ltrim($linkHref, '/'));
                    @endphp
                    <li>
                        <!-- Expanded view -->
                        <a href="{{ $linkHref }}" 
                           class="nav-link-expanded flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors
                                  @if($isActive) bg-sidebar-primary text-sidebar-primary-foreground @else hover:bg-sidebar-accent text-sidebar-foreground @endif">
                            <span class="h-5 w-5 flex items-center justify-center flex-shrink-0">📌</span>
                            <span class="nav-label">{{ $displayTitle }}</span>
                        </a>

                        <!-- Collapsed view -->
                        <a href="{{ $linkHref }}" 
                           class="nav-link-collapsed hidden flex h-10 w-10 mx-auto items-center justify-center rounded-lg transition-colors
                                  @if($isActive) bg-sidebar-primary text-sidebar-primary-foreground @else hover:bg-sidebar-accent text-sidebar-foreground @endif"
                           title="{{ $displayTitle }}">
                            <span class="h-5 w-5 flex items-center justify-center">📌</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>

        <!-- Footer -->
        <div class="border-t border-sidebar-border p-2">
            <!-- Expanded logout button -->
            <form method="POST" action="{{ route('logout') }}" id="logoutFormExpanded" class="logout-expanded w-full">
                @csrf
                <button type="submit" class="w-full flex items-center justify-start gap-3 px-3 py-2 rounded-lg text-sm font-medium text-sidebar-foreground hover:bg-sidebar-accent hover:text-destructive transition-colors">
                    <span class="h-5 w-5 flex items-center justify-center flex-shrink-0">🚪</span>
                    <span class="nav-label">Keluar</span>
                </button>
            </form>

            <!-- Collapsed logout button -->
            <form method="POST" action="{{ route('logout') }}" id="logoutFormCollapsed" class="logout-collapsed hidden w-full">
                @csrf
                <button type="submit" class="w-10 h-10 mx-auto flex items-center justify-center rounded-lg text-sidebar-foreground hover:bg-sidebar-accent hover:text-destructive transition-colors" title="Keluar">
                    <span class="h-5 w-5 flex items-center justify-center">🚪</span>
                </button>
            </form>
        </div>
    </div>
</aside>

<script>
let sidebarCollapsed = false;

function toggleSidebar() {
    const aside = document.getElementById('sidebarAside');
    const logoSection = document.getElementById('logoSection');
    const chevronIcon = document.getElementById('chevronIcon');
    
    // User info
    const userInfoExpanded = document.getElementById('userInfoExpanded');
    const userInfoCollapsed = document.getElementById('userInfoCollapsed');
    
    // Nav items
    const navLinksExpanded = document.querySelectorAll('.nav-link-expanded');
    const navLinksCollapsed = document.querySelectorAll('.nav-link-collapsed');
    
    // Logout buttons
    const logoutFormExpanded = document.getElementById('logoutFormExpanded');
    const logoutFormCollapsed = document.getElementById('logoutFormCollapsed');
    
    sidebarCollapsed = !sidebarCollapsed;
    
    if (sidebarCollapsed) {
        // Collapse sidebar
        aside.classList.remove('w-64');
        aside.classList.add('w-16');
        logoSection.classList.add('hidden');
        
        // User info
        userInfoExpanded.classList.add('hidden');
        userInfoCollapsed.classList.remove('hidden');
        
        // Nav items
        navLinksExpanded.forEach(el => el.classList.add('hidden'));
        navLinksCollapsed.forEach(el => el.classList.remove('hidden'));
        
        // Logout buttons
        logoutFormExpanded.classList.add('hidden');
        logoutFormCollapsed.classList.remove('hidden');
        
        // Chevron rotate
        chevronIcon.style.transform = 'rotate(180deg)';
    } else {
        // Expand sidebar
        aside.classList.remove('w-16');
        aside.classList.add('w-64');
        logoSection.classList.remove('hidden');
        
        // User info
        userInfoExpanded.classList.remove('hidden');
        userInfoCollapsed.classList.add('hidden');
        
        // Nav items
        navLinksExpanded.forEach(el => el.classList.remove('hidden'));
        navLinksCollapsed.forEach(el => el.classList.add('hidden'));
        
        // Logout buttons
        logoutFormExpanded.classList.remove('hidden');
        logoutFormCollapsed.classList.add('hidden');
        
        // Chevron reset
        chevronIcon.style.transform = 'rotate(0deg)';
    }
}
</script>
