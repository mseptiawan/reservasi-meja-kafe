<x-app-layout>
    <div class="w-full max-w-none mx-auto space-y-5 md:space-y-8">

        <!-- PAGE HEADER -->
        <x-slot name="headerTitle">Persetujuan Akun</x-slot>

        <!-- 2. Pengiriman Komponen Page Header ke Layout Utama -->
        <x-slot name="header">
            <x-page-header title="Persetujuan Akun Pelanggan"
                subtitle="Verifikasi pendaftaran pelanggan baru untuk memberikan akses pemesanan meja di Senja Space">
                {{-- Slot untuk Badge Kustom di Bagian Atas Judul --}}
                <span class="text-[10px] font-medium uppercase tracking-wider text-indigo-500 block">
                    Area Kerja / Keamanan
                </span>
            </x-page-header>
        </x-slot>

        <div
            class="grid grid-cols-2 lg:grid-cols-3 gap-2.5 sm:gap-4 md:gap-5 w-full max-w-full select-none box-border overflow-hidden">
            <!-- Total Registrasi -->
            <div
                class="bg-white rounded-xl md:rounded-2xl p-3 md:p-5 flex flex-row items-start justify-between border border-slate-200/75 w-full min-w-0 box-border break-words gap-2">
                <div class="space-y-0.5 md:space-y-1 min-w-0 flex-1">
                    <span
                        class="text-[9px] sm:text-[11px] md:text-[12px] font-medium text-slate-400 uppercase tracking-wider block whitespace-normal break-words leading-tight">
                        Total Pendaftar
                    </span>
                    <span
                        class="text-sm sm:text-lg md:text-2xl font-medium text-slate-900 tracking-tight tabular-nums block break-all sm:truncate leading-none pt-0.5">
                        {{ $stats['total'] }} <span
                            class="text-[8.5px] sm:text-[10px] md:text-xs font-semibold text-slate-500 inline-block ml-0.5">Akun</span>
                    </span>
                </div>
                <div
                    class="flex w-7 h-7 sm:w-11 sm:h-11 rounded-lg sm:rounded-xl items-center justify-center bg-slate-50 text-slate-400 border border-slate-200/50 shrink-0 ml-1">
                    <i class="fa-solid fa-users text-[11px] sm:text-base"></i>
                </div>
            </div>

            <!-- Menunggu Verifikasi -->
            <div
                class="bg-white rounded-xl md:rounded-2xl p-3 md:p-5 flex flex-row items-start justify-between border border-slate-200/75 w-full min-w-0 box-border break-words gap-2">
                <div class="space-y-0.5 md:space-y-1 min-w-0 flex-1">
                    <span
                        class="text-[9px] sm:text-[11px] md:text-[12px] font-medium text-amber-600 uppercase tracking-wider block whitespace-normal break-words leading-tight">
                        Pending Approval
                    </span>
                    <span
                        class="text-sm sm:text-lg md:text-2xl font-medium text-amber-700 tracking-tight tabular-nums block break-all sm:truncate leading-none pt-0.5">
                        {{ $stats['pending'] }} <span
                            class="text-[8.5px] sm:text-[10px] md:text-xs font-semibold text-amber-500 inline-block ml-0.5">Berkas</span>
                    </span>
                </div>
                <div
                    class="flex w-7 h-7 sm:w-11 sm:h-11 rounded-lg sm:rounded-xl items-center justify-center bg-amber-50 text-amber-500 border border-amber-200/50 shrink-0 ml-1">
                    <i class="fa-solid fa-hourglass-half text-[11px] sm:text-base"></i>
                </div>
            </div>

            <!-- Total Ditolak -->
            <div
                class="bg-white rounded-xl md:rounded-2xl p-3 md:p-5 flex flex-row items-start justify-between border border-slate-200/75 w-full min-w-0 box-border break-words gap-2 col-span-2 lg:col-span-1">
                <div class="space-y-0.5 md:space-y-1 min-w-0 flex-1">
                    <span
                        class="text-[9px] sm:text-[11px] md:text-[12px] font-medium text-slate-500 uppercase tracking-wider block whitespace-normal break-words leading-tight">
                        Registrasi Ditolak
                    </span>
                    <span
                        class="text-sm sm:text-lg md:text-2xl font-medium text-slate-900 tracking-tight tabular-nums block break-all sm:truncate leading-none pt-0.5">
                        {{ $stats['rejected'] }} <span
                            class="text-[8.5px] sm:text-[10px] md:text-xs font-semibold text-slate-500 inline-block ml-0.5">Akun</span>
                    </span>
                </div>
                <div
                    class="flex w-7 h-7 sm:w-11 sm:h-11 rounded-lg sm:rounded-xl items-center justify-center bg-slate-100 text-slate-500 border border-slate-200/50 shrink-0 ml-1">
                    <i class="fa-solid fa-user-xmark text-[11px] sm:text-base"></i>
                </div>
            </div>
        </div>

        <!-- TAB NAVIGATION (Mengikuti Style Proyek EJS) -->
        <div
            class="flex flex-col md:flex-row md:items-center md:justify-between gap-3.5 w-full bg-white md:bg-transparent border border-slate-200/50 md:border-none p-4 md:p-0 rounded-2xl md:rounded-none md:shadow-none select-none">
            <div class="w-full overflow-x-auto scrollbar-none pb-1 select-none">
                <div class="inline-flex w-auto items-center gap-1 rounded-xl bg-slate-100 p-1">
                    <button type="button" id="tab-btn-pending" onclick="switchTab('pending')"
                        class="tab-btn flex-none whitespace-nowrap rounded-lg px-3.5 py-1.5 text-center text-[11px] transition-all duration-200 outline-none cursor-pointer {{ $status === 'pending' ? 'bg-white font-medium text-slate-900 shadow-xs' : 'font-medium text-slate-500 hover:text-slate-800' }}">
                        Menunggu Verifikasi ({{ $stats['pending'] }})
                    </button>
                    <button type="button" id="tab-btn-rejected" onclick="switchTab('rejected')"
                        class="tab-btn flex-none whitespace-nowrap rounded-lg px-3.5 py-1.5 text-center text-[11px] transition-all duration-200 outline-none cursor-pointer {{ $status === 'rejected' ? 'bg-white font-medium text-slate-900 shadow-xs' : 'font-medium text-slate-500 hover:text-slate-800' }}">
                        Riwayat ({{ $stats['rejected'] }})
                    </button>
                </div>
            </div>
        </div>

        <!-- Notifikasi Sukses -->
        @if (session('success'))
            <div
                class="p-3.5 bg-emerald-50 border border-emerald-100 text-emerald-600 text-xs rounded-xl flex items-center gap-3">
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-2xl overflow-hidden w-full border border-slate-200/50">

            <!-- DESKTOP TABLE VIEW -->
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-left border-collapse text-[13px]">
                    <thead>
                        <tr
                            class="bg-slate-50/70 border-b border-slate-200/50 text-[11px] font-semibold text-slate-400 uppercase tracking-wider select-none">
                            <th class="py-4 px-6">Pelanggan</th>
                            <th class="py-4 px-6">Kontak WhatsApp</th>
                            <th class="py-4 px-6">Kode Customer</th>
                            <th class="py-4 px-6">Tanggal Daftar</th>
                            <th class="py-4 px-6 text-center">Status</th>
                            <!-- KOLOM AKSI HANYA DIRENDER JIKA DI TAB PENDING -->
                            @if ($status === 'pending')
                                <th class="py-4 px-6 text-center">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white font-medium text-slate-600">
                        @forelse($users as $user)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="py-4 px-6">
                                    <span
                                        class="font-semibold text-slate-800 block text-[13px]">{{ $user->name }}</span>
                                    <span
                                        class="text-[10px] font-medium text-slate-400 inline-block mt-0.5">{{ $user->email }}</span>
                                </td>
                                <td class="py-4 px-6 font-medium text-slate-500">
                                    <div class="flex items-center gap-1.5">
                                        <i class="fa-solid fa-phone text-slate-400 text-[10px]"></i>
                                        {{ $user->phone_number ?? '-' }}
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <span
                                        class="text-[10px] font-mono font-semibold bg-slate-100 border border-slate-200 text-slate-500 px-1.5 py-0.5 rounded-md inline-block">
                                        {{ $user->customer_code ?? '-' }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 font-medium text-slate-500">
                                    {{ $user->created_at->translatedFormat('d M Y, H:i') }}
                                </td>
                                <td class="py-4 px-6 text-center select-none">
                                    @if ($user->status_verifikasi === 'pending')
                                        <div
                                            class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-medium tracking-wide border bg-amber-50 text-amber-600 border-amber-200/50">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                            <span>PENDING</span>
                                        </div>
                                    @elseif($user->status_verifikasi === 'active')
                                        <div
                                            class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-medium tracking-wide border bg-emerald-50 text-emerald-600 border-emerald-200/50">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            <span>APPROVED</span>
                                        </div>
                                    @else
                                        <div
                                            class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-medium tracking-wide border bg-rose-50 text-rose-600 border-rose-200/50">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                            <span>REJECTED</span>
                                        </div>
                                    @endif
                                </td>

                                <!-- TOMBOL AKSI HANYA DIRENDER PADA TAB PENDING -->
                                @if ($status === 'pending')
                                    <td class="py-4 px-6">
                                        <div class="flex items-center justify-center gap-2">
                                            <form action="{{ route('admin.approvals.verify', $user->id) }}"
                                                method="POST" class="inline m-0">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="action" value="active">
                                                <button type="submit"
                                                    class="w-8 h-8 rounded-lg bg-white border border-slate-200/80 text-slate-400 hover:text-emerald-600 inline-flex items-center justify-center transition-all active:scale-[0.95]"
                                                    title="Setujui Akun">
                                                    <i class="fa-solid fa-user-check text-[11px]"></i>
                                                </button>
                                            </form>

                                            <form action="{{ route('admin.approvals.verify', $user->id) }}"
                                                method="POST" class="inline m-0">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="action" value="rejected">
                                                <button type="submit"
                                                    class="w-8 h-8 rounded-lg border border-rose-200 bg-rose-50/40 text-rose-600 inline-flex items-center justify-center transition-all active:scale-[0.95] hover:bg-rose-50 cursor-pointer"
                                                    title="Tolak Akun">
                                                    <i class="fa-solid fa-user-xmark text-[11px]"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <!-- Sesuaikan jumlah colspan berdasarkan tab -->
                                <td colspan="{{ $status === 'pending' ? '6' : '5' }}"
                                    class="py-12 text-center text-slate-400 font-medium">
                                    Belum ada dokumen permohonan pendaftaran.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- MOBILE RESPONSIVE CARD VIEW -->
            <!-- MOBILE RESPONSIVE CARD VIEW -->
            <!-- MOBILE RESPONSIVE CARD VIEW -->
            <div class="block md:hidden divide-y divide-slate-100 w-full">
                @forelse($users as $user)
                    <div class="p-4 space-y-3.5 bg-white">
                        <div class="flex items-center justify-between gap-2">
                            <div>
                                <h4 class="text-[13px] font-semibold text-slate-800 tracking-tight">{{ $user->name }}
                                </h4>
                                <p class="text-[11px] text-slate-400 font-medium mt-0.5">{{ $user->email }}</p>
                            </div>
                            @if ($user->status_verifikasi === 'pending')
                                <div
                                    class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[9.5px] font-medium tracking-wider border shrink-0 bg-amber-50 text-amber-600 border-amber-200/50">
                                    <span class="w-1 h-1 rounded-full bg-amber-500"></span>
                                    <span>PENDING</span>
                                </div>
                            @elseif($user->status_verifikasi === 'active')
                                <div
                                    class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[9.5px] font-medium tracking-wider border shrink-0 bg-emerald-50 text-emerald-600 border-emerald-200/50">
                                    <span class="w-1 h-1 rounded-full bg-emerald-500"></span>
                                    <span>APPROVED</span>
                                </div>
                            @else
                                <div
                                    class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[9.5px] font-medium tracking-wider border shrink-0 bg-rose-50 text-rose-600 border-rose-200/50">
                                    <span class="w-1 h-1 rounded-full bg-rose-500"></span>
                                    <span>REJECTED</span>
                                </div>
                            @endif
                        </div>

                        <div
                            class="bg-slate-50/60 rounded-xl px-3.5 py-2.5 border border-slate-200/30 grid grid-cols-2 gap-2 text-xs">
                            <div>
                                <p class="text-[10px] font-medium text-slate-400 uppercase tracking-wide">Nomor Kontak
                                </p>
                                <p class="text-[12px] font-semibold text-slate-700 mt-0.5 truncate">
                                    {{ $user->phone_number ?? '-' }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-[10px] font-medium text-slate-400 uppercase tracking-wide">Kode Customer
                                </p>
                                <p class="text-[11px] font-mono font-semibold text-indigo-600 mt-0.5">
                                    {{ $user->customer_code ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between gap-2 pt-0.5">
                            <span class="text-[11px] font-medium text-slate-400">
                                <i class="fa-solid fa-calendar mr-1"></i>{{ $user->created_at->format('d/m/Y') }}
                            </span>

                            <!-- AKSI HANYA UNTUK MOBILE DI TAB PENDING -->
                            @if ($status === 'pending')
                                <div class="flex items-center gap-1.5">
                                    <form action="{{ route('admin.approvals.verify', $user->id) }}" method="POST"
                                        class="inline m-0">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="action" value="active">
                                        <button type="submit"
                                            class="h-8 px-3 bg-emerald-600 text-white text-[11px] font-semibold rounded-lg flex items-center justify-center tracking-wide active:scale-95">
                                            SETUJUI
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.approvals.verify', $user->id) }}" method="POST"
                                        class="inline m-0">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="action" value="rejected">
                                        <button type="submit"
                                            class="h-8 w-8 rounded-lg bg-rose-50 border border-rose-200 text-rose-600 flex items-center justify-center text-xs active:scale-95">
                                            <i class="fa-solid fa-user-xmark"></i>
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="bg-white border-t border-slate-100 py-10 text-center px-4">
                        <p class="text-[12px] font-medium text-slate-400">Tidak ada pengajuan berkas pendaftaran.</p>
                    </div>
                @endforelse
            </div>

        </div>

        <!-- Pagination -->
        @if ($users->hasPages())
            <div class="p-2">
                {{ $users->appends(['status' => $status])->links() }}
            </div>
        @endif

    </div>

    <script>
        function switchTab(tabName) {
            const url = new URL(window.location.href);
            url.searchParams.set('status', tabName);
            url.searchParams.delete('page');
            window.location.href = url.toString();
        }
    </script>
</x-app-layout>
