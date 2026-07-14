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
        <!-- Tombol Tutup Mobile -->
        <button @click="$store.sidebar.open = false" class="flex h-9 w-9 items-center justify-center rounded-xl border border-slate-100 bg-slate-50 text-slate-500 md:hidden active:scale-95">
            <i class="fa-solid fa-xmark text-sm"></i>
        </button>
    </div>

    <!-- LIST MENU UTAMA -->
    <nav id="sidebarNav" class="flex-1 overflow-y-auto scrollbar-hide px-4 md:px-2 xl:px-4 py-6 space-y-7 pb-10 custom-scrollbar">
        
        <!-- SECTION: UTAMA -->
        <section class="space-y-1.5">
            <p class="text-[8px] text-slate-400 font-bold px-4 mb-2 uppercase tracking-[0.2em] md:hidden xl:block">Menu Utama</p>
            
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}"
                class="flex items-center justify-start md:justify-center xl:justify-start gap-3 px-4 md:px-0 xl:px-4 py-3 rounded-xl text-xs font-medium transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-600 font-semibold border border-indigo-100/50' : 'text-slate-500 hover:bg-slate-50/50 hover:text-slate-800' }}"
                title="Dashboard">
                <i class="fa-solid fa-chart-pie text-base w-5 text-center shrink-0"></i>
                <span class="md:hidden xl:block">Dashboard</span>
            </a>
        </section>

        <!-- ================= KHUSUS PELANGGAN AKTIF ================= -->
        @if(Auth::user()->role === 'pelanggan' && Auth::user()->status_verifikasi === 'active')
        <section class="space-y-1.5">
            <p class="text-[8px] text-slate-400 font-bold px-4 mb-2 uppercase tracking-[0.2em] md:hidden xl:block">Layanan</p>
            
            <!-- Reservasi Meja Group -->
            <div x-data="{ open: {{ request()->routeIs('reservasi.*') ? 'true' : 'false' }} }" class="space-y-1">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between md:justify-center xl:justify-between px-4 md:px-0 xl:px-4 py-3 rounded-xl text-xs font-medium transition-all duration-200 text-slate-500 hover:bg-slate-50/50 hover:text-slate-800">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-calendar-check text-base w-5 text-center shrink-0"></i>
                        <span class="md:hidden xl:block">Reservasi Meja</span>
                    </div>
                    <i :class="open ? 'rotate-180' : ''" class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200 md:hidden xl:block"></i>
                </button>
                <!-- Submenu (Indentasi Dihapus) -->
                <div x-show="open" x-collapse class="flex flex-col space-y-1">
                    <a href="#" class="flex items-center gap-3 px-4 md:px-0 xl:px-4 py-2 text-[11px] font-medium text-slate-500 hover:text-indigo-600 transition-colors md:justify-center xl:justify-start">
                        <i class="fa-solid fa-circle-plus text-xs w-5 text-center shrink-0"></i>
                        <span class="md:hidden xl:block">Pesan Meja Baru</span>
                    </a>
                    <a href="#" class="flex items-center gap-3 px-4 md:px-0 xl:px-4 py-2 text-[11px] font-medium text-slate-500 hover:text-indigo-600 transition-colors md:justify-center xl:justify-start">
                        <i class="fa-solid fa-map text-xs w-5 text-center shrink-0"></i>
                        <span class="md:hidden xl:block">Denah Area Kafe</span>
                    </a>
                </div>
            </div>

            <!-- Booking-ku Group -->
            <div x-data="{ open: {{ request()->routeIs('booking.*') ? 'true' : 'false' }} }" class="space-y-1">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between md:justify-center xl:justify-between px-4 md:px-0 xl:px-4 py-3 rounded-xl text-xs font-medium transition-all duration-200 text-slate-500 hover:bg-slate-50/50 hover:text-slate-800">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-receipt text-base w-5 text-center shrink-0"></i>
                        <span class="md:hidden xl:block">Booking-ku</span>
                    </div>
                    <i :class="open ? 'rotate-180' : ''" class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200 md:hidden xl:block"></i>
                </button>
                <!-- Submenu (Indentasi Dihapus) -->
                <div x-show="open" x-collapse class="flex flex-col space-y-1">
                    <a href="#" class="flex items-center gap-3 px-4 md:px-0 xl:px-4 py-2 text-[11px] font-medium text-slate-500 hover:text-indigo-600 transition-colors md:justify-center xl:justify-start">
                        <i class="fa-solid fa-list-ul text-xs w-5 text-center shrink-0"></i>
                        <span class="md:hidden xl:block">Daftar Reservasi</span>
                    </a>
                    <a href="#" class="flex items-center gap-3 px-4 md:px-0 xl:px-4 py-2 text-[11px] font-medium text-slate-500 hover:text-indigo-600 transition-colors md:justify-center xl:justify-start">
                        <i class="fa-solid fa-wallet text-xs w-5 text-center shrink-0"></i>
                        <span class="md:hidden xl:block">Konfirmasi Pembayaran</span>
                    </a>
                </div>
            </div>

            <!-- Profil Saya Group -->
            <div x-data="{ open: {{ request()->routeIs('profile.*') ? 'true' : 'false' }} }" class="space-y-1">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between md:justify-center xl:justify-between px-4 md:px-0 xl:px-4 py-3 rounded-xl text-xs font-medium transition-all duration-200 text-slate-500 hover:bg-slate-50/50 hover:text-slate-800">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-user-gear text-base w-5 text-center shrink-0"></i>
                        <span class="md:hidden xl:block">Profil Saya</span>
                    </div>
                    <i :class="open ? 'rotate-180' : ''" class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200 md:hidden xl:block"></i>
                </button>
                <!-- Submenu (Indentasi Dihapus) -->
                <div x-show="open" x-collapse class="flex flex-col space-y-1">
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 md:px-0 xl:px-4 py-2 text-[11px] font-medium text-slate-500 hover:text-indigo-600 transition-colors md:justify-center xl:justify-start">
                        <i class="fa-solid fa-user-pen text-xs w-5 text-center shrink-0"></i>
                        <span class="md:hidden xl:block">Edit Profil</span>
                    </a>
                    <a href="{{ route('profile.edit') }}#change-password" class="flex items-center gap-3 px-4 md:px-0 xl:px-4 py-2 text-[11px] font-medium text-slate-500 hover:text-indigo-600 transition-colors md:justify-center xl:justify-start">
                        <i class="fa-solid fa-key text-xs w-5 text-center shrink-0"></i>
                        <span class="md:hidden xl:block">Ganti Password</span>
                    </a>
                </div>
            </div>
        </section>
        @endif

        <!-- ================= KHUSUS ADMINISTRATOR ================= -->
        @if(Auth::user()->role === 'admin')
        <section class="space-y-1.5">
            <p class="text-[8px] text-slate-400 font-bold px-4 mb-2 uppercase tracking-[0.2em] md:hidden xl:block">Admin Panel</p>

            <!-- Data Meja dan Kursi -->
            <a href="{{ route('admin.tables.index') }}"
                class="flex items-center justify-start md:justify-center xl:justify-start gap-3 px-4 md:px-0 xl:px-4 py-3 rounded-xl text-xs font-medium transition-all duration-200 {{ request()->routeIs('admin.tables.*') ? 'bg-indigo-50 text-indigo-600 font-semibold border border-indigo-100/50' : 'text-slate-500 hover:bg-slate-50/50 hover:text-slate-800' }}"
                title="Data Meja dan Kursi">
                <i class="fa-solid fa-chair text-base w-5 text-center shrink-0"></i>
                <span class="md:hidden xl:block">Data Meja dan Kursi</span>
            </a>

            <!-- Manajemen Anggota Group -->
            <div x-data="{ open: {{ request()->routeIs('admin.anggota.*') ? 'true' : 'false' }} }" class="space-y-1">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between md:justify-center xl:justify-between px-4 md:px-0 xl:px-4 py-3 rounded-xl text-xs font-medium transition-all duration-200 text-slate-500 hover:bg-slate-50/50 hover:text-slate-800">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-users-gear text-base w-5 text-center shrink-0"></i>
                        <span class="md:hidden xl:block">Manajemen Anggota</span>
                    </div>
                    <i :class="open ? 'rotate-180' : ''" class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200 md:hidden xl:block"></i>
                </button>
                <!-- Submenu (Indentasi Dihapus) -->
                <div x-show="open" x-collapse class="flex flex-col space-y-1">
                    <a href="#" class="flex items-center gap-3 px-4 md:px-0 xl:px-4 py-2 text-[11px] font-medium text-slate-500 hover:text-indigo-600 transition-colors md:justify-center xl:justify-start">
                        <i class="fa-solid fa-user-check text-xs w-5 text-center shrink-0"></i>
                        <span class="md:hidden xl:block">Persetujuan Akun</span>
                    </a>
                    <a href="#" class="flex items-center gap-3 px-4 md:px-0 xl:px-4 py-2 text-[11px] font-medium text-slate-500 hover:text-indigo-600 transition-colors md:justify-center xl:justify-start">
                        <i class="fa-solid fa-users text-xs w-5 text-center shrink-0"></i>
                        <span class="md:hidden xl:block">Daftar Pelanggan</span>
                    </a>
                </div>
            </div>

            <!-- Permohonan Booking Group -->
            <div x-data="{ open: {{ request()->routeIs('admin.booking.*') ? 'true' : 'false' }} }" class="space-y-1">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between md:justify-center xl:justify-between px-4 md:px-0 xl:px-4 py-3 rounded-xl text-xs font-medium transition-all duration-200 text-slate-500 hover:bg-slate-50/50 hover:text-slate-800">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-folder-open text-base w-5 text-center shrink-0"></i>
                        <span class="md:hidden xl:block">Permohonan Booking</span>
                    </div>
                    <i :class="open ? 'rotate-180' : ''" class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200 md:hidden xl:block"></i>
                </button>
                <!-- Submenu (Indentasi Dihapus) -->
                <div x-show="open" x-collapse class="flex flex-col space-y-1">
                    <a href="#" class="flex items-center gap-3 px-4 md:px-0 xl:px-4 py-2 text-[11px] font-medium text-slate-500 hover:text-indigo-600 transition-colors md:justify-center xl:justify-start">
                        <i class="fa-solid fa-calendar-check text-xs w-5 text-center shrink-0"></i>
                        <span class="md:hidden xl:block">Persetujuan Reservasi</span>
                    </a>
                    <a href="#" class="flex items-center gap-3 px-4 md:px-0 xl:px-4 py-2 text-[11px] font-medium text-slate-500 hover:text-indigo-600 transition-colors md:justify-center xl:justify-start">
                        <i class="fa-solid fa-file-invoice-dollar text-xs w-5 text-center shrink-0"></i>
                        <span class="md:hidden xl:block">Verifikasi Pembayaran</span>
                    </a>
                    <a href="#" class="flex items-center gap-3 px-4 md:px-0 xl:px-4 py-2 text-[11px] font-medium text-slate-500 hover:text-indigo-600 transition-colors md:justify-center xl:justify-start">
                        <i class="fa-solid fa-history text-xs w-5 text-center shrink-0"></i>
                        <span class="md:hidden xl:block">Semua Transaksi</span>
                    </a>
                </div>
            </div>

            <!-- Pusat Informasi -->
            <a href="#"
                class="flex items-center justify-start md:justify-center xl:justify-start gap-3 px-4 md:px-0 xl:px-4 py-3 rounded-xl text-xs font-medium transition-all duration-200 {{ request()->routeIs('admin.announcements.*') ? 'bg-indigo-50 text-indigo-600 font-semibold border border-indigo-100/50' : 'text-slate-500 hover:bg-slate-50/50 hover:text-slate-800' }}"
                title="Pusat Informasi">
                <i class="fa-solid fa-bullhorn text-base w-5 text-center shrink-0"></i>
                <span class="md:hidden xl:block">Pusat Informasi</span>
            </a>
        </section>
        @endif

    </nav>

    <!-- USER PROFILE SECTION (BAGIAN BAWAH SIDEBAR) -->
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