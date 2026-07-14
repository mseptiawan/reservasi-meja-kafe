<nav x-data="{ openMobile: false }" class="w-80 bg-white rounded-3xl border border-slate-100 shadow-sm flex flex-col justify-between p-6 shrink-0">
    <div class="flex flex-col h-full">
        <!-- LOGO & BRAND -->
        <div class="flex items-center gap-3 px-2 mb-8">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-500 to-purple-500 flex items-center justify-center text-white shadow-md shadow-indigo-100">
                <i class="fa-solid fa-mug-hot text-lg"></i>
            </div>
            <div>
                <h2 class="font-bold text-slate-800 text-base leading-tight">Senja Space</h2>
                <span class="text-xs text-slate-400 font-medium">Reservasi Meja</span>
            </div>
        </div>

        <!-- LIST MENU UTAMA -->
        <div class="flex-1 overflow-y-auto space-y-2 pr-1 custom-scrollbar">

            <!-- ================= ALL ROLES ================= -->
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}"
                class="flex items-center justify-between px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-slate-50 text-indigo-600 font-semibold' : 'text-slate-500 hover:bg-slate-50/50 hover:text-slate-800' }}">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-chart-pie text-base w-5 text-center"></i>
                    <span>Dashboard</span>
                </div>
            </a>

            <!-- ================= KHUSUS PELANGGAN AKTIF ================= -->
            @if(Auth::user()->role === 'pelanggan' && Auth::user()->status_verifikasi === 'active')

            <!-- Reservasi Meja Group -->
            <div x-data="{ open: {{ request()->routeIs('reservasi.*') ? 'true' : 'false' }} }" class="space-y-1">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 text-slate-500 hover:bg-slate-50/50 hover:text-slate-800">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-calendar-check text-base w-5 text-center"></i>
                        <span>Reservasi Meja</span>
                    </div>
                    <i :class="open ? 'rotate-180' : ''" class="fa-solid fa-chevron-down text-xs transition-transform duration-200"></i>
                </button>
                <!-- Submenu -->
                <div x-show="open" x-collapse class="pl-12 space-y-1">
                    <a href="#" class="block py-2 text-xs font-medium text-slate-500 hover:text-indigo-600 transition-colors">Pesan Meja Baru</a>
                    <a href="#" class="block py-2 text-xs font-medium text-slate-500 hover:text-indigo-600 transition-colors">Denah Area Kafe</a>
                </div>
            </div>

            <!-- Booking-ku Group -->
            <div x-data="{ open: {{ request()->routeIs('booking.*') ? 'true' : 'false' }} }" class="space-y-1">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 text-slate-500 hover:bg-slate-50/50 hover:text-slate-800">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-receipt text-base w-5 text-center"></i>
                        <span>Booking-ku</span>
                    </div>
                    <i :class="open ? 'rotate-180' : ''" class="fa-solid fa-chevron-down text-xs transition-transform duration-200"></i>
                </button>
                <!-- Submenu -->
                <div x-show="open" x-collapse class="pl-12 space-y-1">
                    <a href="#" class="block py-2 text-xs font-medium text-slate-500 hover:text-indigo-600 transition-colors">Daftar Reservasi</a>
                    <a href="#" class="block py-2 text-xs font-medium text-slate-500 hover:text-indigo-600 transition-colors">Konfirmasi Pembayaran</a>
                </div>
            </div>

            <!-- Profil Saya Group -->
            <div x-data="{ open: {{ request()->routeIs('profile.*') ? 'true' : 'false' }} }" class="space-y-1">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 text-slate-500 hover:bg-slate-50/50 hover:text-slate-800">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-user-gear text-base w-5 text-center"></i>
                        <span>Profil Saya</span>
                    </div>
                    <i :class="open ? 'rotate-180' : ''" class="fa-solid fa-chevron-down text-xs transition-transform duration-200"></i>
                </button>
                <!-- Submenu -->
                <div x-show="open" x-collapse class="pl-12 space-y-1">
                    <a href="{{ route('profile.edit') }}" class="block py-2 text-xs font-medium text-slate-500 hover:text-indigo-600 transition-colors">Edit Profil</a>
                    <a href="{{ route('profile.edit') }}#change-password" class="block py-2 text-xs font-medium text-slate-500 hover:text-indigo-600 transition-colors">Ganti Password</a>
                </div>
            </div>

            @endif

            <!-- ================= KHUSUS ADMINISTRATOR ================= -->
            @if(Auth::user()->role === 'admin')

            <!-- Manajemen Anggota Group -->
            <div x-data="{ open: {{ request()->routeIs('admin.anggota.*') ? 'true' : 'false' }} }" class="space-y-1">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 text-slate-500 hover:bg-slate-50/50 hover:text-slate-800">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-users-gear text-base w-5 text-center"></i>
                        <span>Manajemen Anggota</span>
                    </div>
                    <i :class="open ? 'rotate-180' : ''" class="fa-solid fa-chevron-down text-xs transition-transform duration-200"></i>
                </button>
                <!-- Submenu -->
                <div x-show="open" x-collapse class="pl-12 space-y-1">
                    <a href="#" class="block py-2 text-xs font-medium text-slate-500 hover:text-indigo-600 transition-colors">Persetujuan Akun</a>
                    <a href="#" class="block py-2 text-xs font-medium text-slate-500 hover:text-indigo-600 transition-colors">Daftar Pelanggan</a>
                </div>
            </div>

            <!-- Permohonan Booking Group -->
            <div x-data="{ open: {{ request()->routeIs('admin.booking.*') ? 'true' : 'false' }} }" class="space-y-1">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 text-slate-500 hover:bg-slate-50/50 hover:text-slate-800">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-folder-open text-base w-5 text-center"></i>
                        <span>Permohonan Booking</span>
                    </div>
                    <i :class="open ? 'rotate-180' : ''" class="fa-solid fa-chevron-down text-xs transition-transform duration-200"></i>
                </button>
                <!-- Submenu -->
                <div x-show="open" x-collapse class="pl-12 space-y-1">
                    <a href="#" class="block py-2 text-xs font-medium text-slate-500 hover:text-indigo-600 transition-colors">Persetujuan Reservasi</a>
                    <a href="#" class="block py-2 text-xs font-medium text-slate-500 hover:text-indigo-600 transition-colors">Verifikasi Pembayaran</a>
                    <a href="#" class="block py-2 text-xs font-medium text-slate-500 hover:text-indigo-600 transition-colors">Semua Transaksi</a>
                </div>
            </div>

            <!-- Data Meja dan Kursi -->
            <a href="{{ route('admin.tables.index') }}"
                class="flex items-center justify-between px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.tables.*') ? 'bg-indigo-50/55 text-indigo-600 font-semibold' : 'text-slate-500 hover:bg-slate-50/50 hover:text-slate-800' }}">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-chair text-base w-5 text-center"></i>
                    <span>Data Meja dan Kursi</span>
                </div>
            </a>

            <!-- Pusat Informasi -->
            <a href="#"
                class="flex items-center justify-between px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.announcements.*') ? 'bg-slate-50 text-indigo-600 font-semibold' : 'text-slate-500 hover:bg-slate-50/50 hover:text-slate-800' }}">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-bullhorn text-base w-5 text-center"></i>
                    <span>Pusat Informasi</span>
                </div>
            </a>

            @endif

        </div>
    </div>

    <!-- USER PROFILE SECTION (BAGIAN BAWAH SIDEBAR) -->
    <div class="border-t border-slate-100 pt-6 mt-6">
        <div class="flex items-center justify-between bg-slate-50 p-3 rounded-2xl">
            <!-- Info Singkat User -->
            <div class="flex items-center gap-3 min-w-0">
                <div class="w-9 h-9 rounded-xl bg-slate-200 flex items-center justify-center font-bold text-slate-600 shrink-0 text-sm">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
                <div class="truncate">
                    <h4 class="text-xs font-semibold text-slate-800 truncate">{{ Auth::user()->name }}</h4>
                    <p class="text-[10px] text-slate-400 font-medium capitalize truncate">
                        {{ Auth::user()->role }} • {{ Auth::user()->status_verifikasi }}
                    </p>
                </div>
            </div>

            <!-- Tombol Log Out -->
            <form method="POST" action="{{ route('logout') }}" class="m-0">
                @csrf
                <button type="submit"
                    class="w-8 h-8 rounded-lg bg-white hover:bg-red-50 text-slate-400 hover:text-red-500 border border-slate-100 transition-colors flex items-center justify-center"
                    title="Keluar Aplikasi">
                    <i class="fa-solid fa-arrow-right-from-bracket text-xs"></i>
                </button>
            </form>
        </div>
    </div>
</nav>

<style>
    /* Styling scrollbar tipis agar tetap elegan */
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>