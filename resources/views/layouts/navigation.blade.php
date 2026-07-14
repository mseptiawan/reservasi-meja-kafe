@php
    // Kumpulkan role dan status user aktif
    $userRole = Auth::user()->role;
    $userStatus = Auth::user()->status_verifikasi;

    $menus = [];

    // --- MENU UTAMA (DASHBOARD) ---
    $menus['Menu Utama'] = [
        [
            'type' => 'single',
            'title' => 'Dashboard',
            'route' => 'dashboard',
            'icon' => 'fa-solid fa-chart-pie',
        ]
    ];

    // --- LAYANAN KHUSUS PELANGGAN AKTIF ---
    if ($userRole === 'pelanggan' && $userStatus === 'active') {
        $menus['Layanan'] = [
            [
                'type' => 'dropdown',
                'title' => 'Reservasi Meja',
                'icon' => 'fa-solid fa-calendar-check',
                'active_pattern' => 'reservasi.*',
                'submenu' => [
                    ['title' => 'Pesan Meja Baru', 'url' => '#', 'icon' => 'fa-solid fa-circle-plus'],
                    ['title' => 'Denah Area Kafe', 'url' => '#', 'icon' => 'fa-solid fa-map'],
                ]
            ],
            [
                'type' => 'dropdown',
                'title' => 'Booking-ku',
                'icon' => 'fa-solid fa-receipt',
                'active_pattern' => 'booking.*',
                'submenu' => [
                    ['title' => 'Daftar Reservasi', 'url' => '#', 'icon' => 'fa-solid fa-list-ul'],
                    ['title' => 'Konfirmasi Pembayaran', 'url' => '#', 'icon' => 'fa-solid fa-wallet'],
                ]
            ],
            [
                'type' => 'dropdown',
                'title' => 'Profil Saya',
                'icon' => 'fa-solid fa-user-gear',
                'active_pattern' => 'profile.*',
                'submenu' => [
                    ['title' => 'Edit Profil', 'url' => route('profile.edit'), 'icon' => 'fa-solid fa-user-pen'],
                    ['title' => 'Ganti Password', 'url' => route('profile.edit') . '#change-password', 'icon' => 'fa-solid fa-key'],
                ]
            ],
        ];
    }

    // --- PANEL KHUSUS ADMINISTRATOR ---
    if ($userRole === 'admin') {
        $menus['Admin Panel'] = [
            [
                'type' => 'single',
                'title' => 'Data Meja dan Kursi',
                'route' => 'admin.tables.index',
                'active_pattern' => 'admin.tables.*',
                'icon' => 'fa-solid fa-chair',
            ],
            [
                'type' => 'dropdown',
                'title' => 'Manajemen Anggota',
                'icon' => 'fa-solid fa-users-gear',
                'active_pattern' => 'admin.anggota.*',
                'submenu' => [
                    ['title' => 'Persetujuan Akun', 'url' => '#', 'icon' => 'fa-solid fa-user-check'],
                    ['title' => 'Daftar Pelanggan', 'url' => '#', 'icon' => 'fa-solid fa-users'],
                ]
            ],
            [
                'type' => 'dropdown',
                'title' => 'Permohonan Booking',
                'icon' => 'fa-solid fa-folder-open',
                'active_pattern' => 'admin.booking.*',
                'submenu' => [
                    ['title' => 'Persetujuan Reservasi', 'url' => '#', 'icon' => 'fa-solid fa-calendar-check'],
                    ['title' => 'Verifikasi Pembayaran', 'url' => '#', 'icon' => 'fa-solid fa-file-invoice-dollar'],
                    ['title' => 'Semua Transaksi', 'url' => '#', 'icon' => 'fa-solid fa-history'],
                ]
            ],
            [
                'type' => 'single',
                'title' => 'Pusat Informasi',
                'route' => 'admin.announcements.index',
                'active_pattern' => 'admin.announcements.*',
                'icon' => 'fa-solid fa-bullhorn',
            ],
        ];
    }
@endphp

<!-- STYLE INLINE UNTUK MENCEGAH FLASHING & LONCATAN VISUAL -->
<style>
    [x-cloak] {
        display: none !important;
    }
    #sidebarNav {
        overflow-y: hidden; /* Dikunci dulu agar tidak memicu bar scroll bawaan saat melompat */
    }
    #sidebarNav.ready {
        overflow-y: auto; /* Dikembalikan menjadi scrollable setelah posisi pas */
    }
</style>

<aside id="sidebar" 
       :class="$store.sidebar.open ? 'translate-x-0' : '-translate-x-full md:translate-x-0'"
       class="fixed inset-y-0 left-0 w-64 md:w-16 xl:w-64 bg-white text-black flex flex-col z-[100] border-r border-slate-100 transition-transform duration-300 xl:transition-all shrink-0">

    <!-- LOGO & BRAND -->
    <div class="h-20 flex items-center px-6 md:px-0 xl:px-8 border-b border-slate-100 relative shrink-0 justify-between md:justify-center xl:justify-start">
        <div class="flex items-center gap-3 relative z-10">
            <div class="leading-tight md:hidden xl:block">
                <h2 class="font-bold text-slate-800 text-sm">Lsp Proyek</h2>
                <span class="text-[10px] text-slate-400 font-semibold tracking-wider uppercase">Reservasi Meja</span>
            </div>
        </div>
        <button @click="$store.sidebar.open = false" class="flex h-9 w-9 items-center justify-center rounded-xl border border-slate-100 bg-slate-50 text-slate-500 md:hidden active:scale-95">
            <i class="fa-solid fa-xmark text-sm"></i>
        </button>
    </div>

    <!-- LIST MENU UTAMA -->
    <nav id="sidebarNav" class="flex-1 px-4 md:px-2 xl:px-4 py-6 space-y-7 pb-10 custom-scrollbar">
        @foreach($menus as $sectionLabel => $items)
            <section class="space-y-1.5">
                <p class="text-[8px] text-slate-400 font-bold px-4 mb-2 uppercase tracking-[0.2em] md:hidden xl:block">
                    {{ $sectionLabel }}
                </p>
                
                @foreach($items as $menu)
                    @if($menu['type'] === 'single')
                        @php
                            $isRouteActive = isset($menu['active_pattern']) 
                                ? request()->routeIs($menu['active_pattern']) 
                                : request()->routeIs($menu['route']);
                        @endphp
                        <a href="{{ isset($menu['route']) ? route($menu['route']) : $menu['url'] }}"
                            class="flex items-center justify-start md:justify-center xl:justify-start gap-3 px-4 md:px-0 xl:px-2 py-2 rounded-xl text-xs font-medium transition-all duration-200 {{ $isRouteActive ? 'bg-slate-50/50 text-indigo-600 font-semibold border border-indigo-100/50' : 'text-slate-500 hover:bg-slate-50/50 hover:text-slate-800' }}"
                            title="{{ $menu['title'] }}">
                            <i class="{{ $menu['icon'] }} text-base w-5 text-center shrink-0"></i>
                            <span class="md:hidden xl:block">{{ $menu['title'] }}</span>
                        </a>

                    @elseif($menu['type'] === 'dropdown')
                        @php
                            $isDropdownActive = request()->routeIs($menu['active_pattern']);
                        @endphp
                        <div x-data="{ open: {{ $isDropdownActive ? 'true' : 'false' }} }" class="space-y-1">
                            <button @click="open = !open"
                                class="w-full flex items-center justify-between md:justify-center xl:justify-between px-4 md:px-0 xl:px-4 py-3 rounded-xl text-xs font-medium transition-all duration-200 text-slate-500 hover:bg-slate-50/50 hover:text-slate-800">
                                <div class="flex items-center gap-3">
                                    <i class="{{ $menu['icon'] }} text-base w-5 text-center shrink-0"></i>
                                    <span class="md:hidden xl:block">{{ $menu['title'] }}</span>
                                </div>
                                <i :class="open ? 'rotate-180' : ''" class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200 md:hidden xl:block"></i>
                            </button>
                            
                            <!-- Submenu dengan x-cloak -->
                            <div x-cloak x-show="open" x-collapse class="flex flex-col space-y-1">
                                @foreach($menu['submenu'] as $sub)
                                    @php
                                        $isSubActive = request()->url() == $sub['url'];
                                    @endphp
                                    <a href="{{ $sub['url'] }}" 
                                    class="flex items-center gap-3 px-4 md:px-2 xl:px-4 py-2 text-[11px] font-medium rounded-lg transition-all md:justify-center xl:justify-start
                                            {{ $isSubActive ? 'bg-indigo-50/50 text-indigo-600 font-semibold border border-indigo-100/30' : 'text-slate-500 hover:text-indigo-600 hover:bg-slate-50/70' }}">
                                        <i class="{{ $sub['icon'] }} text-xs w-5 text-center shrink-0"></i>
                                        <span class="md:hidden xl:block">{{ $sub['title'] }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </section>
        @endforeach
    </nav>

    <!-- USER PROFILE SECTION -->
    <div class="p-4 md:p-2 xl:p-4 border-t border-slate-100 bg-white">
        <div class="flex flex-row md:flex-col xl:flex-row items-center justify-between p-3 md:p-1 xl:p-3 rounded-2xl bg-slate-50/70 border border-slate-200/50 hover:bg-slate-100/60 hover:border-slate-300/80 cursor-pointer transition-all duration-200 active:scale-[0.99] group/card gap-3 xl:gap-0">
            <div class="flex flex-row md:flex-col xl:flex-row items-center gap-3 min-w-0 flex-1 w-full justify-start md:justify-center xl:justify-start">
                <div class="w-8 h-8 xl:w-10 xl:h-10 rounded-xl bg-slate-200 border border-slate-300 overflow-hidden shrink-0 transition-transform duration-200 group-hover/card:scale-105 flex items-center justify-center font-bold text-slate-600 text-xs">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
            <div class="min-w-0 flex-1 leading-normal pr-1 md:hidden xl:block">
                    <p class="text-xs font-bold text-slate-800 truncate group-hover/card:text-indigo-600 transition-colors">
                        {{ Auth::user()->name }}
                    </p>
                    <p class="text-[8px] font-semibold uppercase tracking-[0.15em] text-slate-400 truncate mt-0.5">
                        {{ Auth::user()->role }}
                    </p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="ml-0 xl:ml-1.5 shrink-0 md:mt-2 xl:mt-0">
                @csrf
                <button type="submit" title="Keluar Aplikasi" class="p-1.5 text-slate-400 hover:text-rose-600 rounded-xl hover:bg-rose-50 transition-all duration-150 cursor-pointer">
                    <i class="fa-solid fa-arrow-right-from-bracket text-sm"></i>
                </button>
            </form>
        </div>
    </div>
</aside>

<!-- SCRIPT PENGUNCI SCROLL INSTAN (Dieksekusi langsung tanpa menunggu DOMContentLoaded) -->
<script>
    (function() {
        const sidebarNav = document.getElementById("sidebarNav");
        if (sidebarNav) {
            // 1. Pulihkan posisi secepat mungkin sewaktu HTML diparsing browser
            const saved = localStorage.getItem("sidebar_scroll_pos");
            if (saved) {
                sidebarNav.scrollTop = Number(saved);
            }

            // 2. Lepas penguncian overflow-y lewat frame animasi berikutnya (mencegah kedipan)
            requestAnimationFrame(() => {
                sidebarNav.classList.add("ready");
            });

            // 3. Rekam perubahan scroll baru
            sidebarNav.addEventListener("scroll", () => {
                localStorage.setItem("sidebar_scroll_pos", sidebarNav.scrollTop);
            });
        }
    })();
</script>