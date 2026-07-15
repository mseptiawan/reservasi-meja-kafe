<x-app-layout>
    <div class="w-full max-w-none mx-auto space-y-5 md:space-y-8">

        <!-- PAGE HEADER -->
        <div class="border border-slate-200/60 md:border-none md:shadow-none mt-8">
            <div class="flex flex-col gap-1">
                <span class="text-[10px] font-medium uppercase tracking-wider text-indigo-500">Area Kerja /
                    Operasional</span>
                <h2 class="font-medium text-xl text-slate-800 leading-tight">
                    {{ __('Permohonan Reservasi') }}
                </h2>
                <p class="text-[11px] text-slate-400 mt-0.5">Verifikasi ketersediaan meja fisik dan tentukan persetujuan
                    pemesanan pelanggan di Senja Space</p>
            </div>
        </div>

        <!-- STATS CARDS -->
        <div
            class="grid grid-cols-2 lg:grid-cols-4 gap-2.5 sm:gap-4 md:gap-5 w-full max-w-full select-none box-border overflow-hidden">
            <!-- Menunggu Verifikasi -->
            <div
                class="bg-white rounded-xl md:rounded-2xl p-3 md:p-5 flex flex-row items-start justify-between border border-slate-200/75 w-full min-w-0 box-border break-words gap-2">
                <div class="space-y-0.5 md:space-y-1 min-w-0 flex-1">
                    <span
                        class="text-[9px] sm:text-[11px] md:text-[12px] font-medium text-slate-400 uppercase tracking-wider block whitespace-normal break-words leading-tight">
                        Pending Verification
                    </span>
                    <span
                        class="text-sm sm:text-lg md:text-2xl font-medium text-slate-700 tracking-tight tabular-nums block break-all sm:truncate leading-none pt-0.5">
                        {{ $stats['pending'] }} <span
                            class="text-[8.5px] sm:text-[10px] md:text-xs font-medium text-slate-400 inline-block ml-0.5">Data</span>
                    </span>
                </div>
                <!-- Perubahan: Background amber lembut dan icon amber hangat -->
                <div
                    class="flex w-7 h-7 sm:w-11 sm:h-11 rounded-lg sm:rounded-xl items-center justify-center bg-amber-50 text-amber-500 border border-amber-100 shrink-0 ml-1">
                    <i class="fa-solid fa-hourglass-half text-[11px] sm:text-base"></i>
                </div>
            </div>

            <!-- Disetujui -->
            <div
                class="bg-white rounded-xl md:rounded-2xl p-3 md:p-5 flex flex-row items-start justify-between border border-slate-200/75 w-full min-w-0 box-border break-words gap-2">
                <div class="space-y-0.5 md:space-y-1 min-w-0 flex-1">
                    <span
                        class="text-[9px] sm:text-[11px] md:text-[12px] font-medium text-slate-400 uppercase tracking-wider block whitespace-normal break-words leading-tight">
                        Reservasi Disetujui
                    </span>
                    <span
                        class="text-sm sm:text-lg md:text-2xl font-medium text-slate-700 tracking-tight tabular-nums block break-all sm:truncate leading-none pt-0.5">
                        {{ $stats['approved'] }} <span
                            class="text-[8.5px] sm:text-[10px] md:text-xs font-medium text-slate-400 inline-block ml-0.5">Sesi</span>
                    </span>
                </div>
                <!-- Perubahan: Background emerald lembut dan icon emerald segar -->
                <div
                    class="flex w-7 h-7 sm:w-11 sm:h-11 rounded-lg sm:rounded-xl items-center justify-center bg-emerald-50 text-emerald-500 border border-emerald-100 shrink-0 ml-1">
                    <i class="fa-solid fa-circle-check text-[11px] sm:text-base"></i>
                </div>
            </div>

            <!-- Ditolak -->
            <div
                class="bg-white rounded-xl md:rounded-2xl p-3 md:p-5 flex flex-row items-start justify-between border border-slate-200/75 w-full min-w-0 box-border break-words gap-2">
                <div class="space-y-0.5 md:space-y-1 min-w-0 flex-1">
                    <span
                        class="text-[9px] sm:text-[11px] md:text-[12px] font-medium text-slate-400 uppercase tracking-wider block whitespace-normal break-words leading-tight">
                        Reservasi Ditolak
                    </span>
                    <span
                        class="text-sm sm:text-lg md:text-2xl font-medium text-slate-700 tracking-tight tabular-nums block break-all sm:truncate leading-none pt-0.5">
                        {{ $stats['rejected'] }} <span
                            class="text-[8.5px] sm:text-[10px] md:text-xs font-medium text-slate-400 inline-block ml-0.5">Sesi</span>
                    </span>
                </div>
                <!-- Perubahan: Background rose lembut dan icon rose tegas -->
                <div
                    class="flex w-7 h-7 sm:w-11 sm:h-11 rounded-lg sm:rounded-xl items-center justify-center bg-rose-50 text-rose-500 border border-rose-100 shrink-0 ml-1">
                    <i class="fa-solid fa-calendar-xmark text-[11px] sm:text-base"></i>
                </div>
            </div>

            <!-- Total Reservasi -->
            <div
                class="bg-white rounded-xl md:rounded-2xl p-3 md:p-5 flex flex-row items-start justify-between border border-slate-200/75 w-full min-w-0 box-border break-words gap-2">
                <div class="space-y-0.5 md:space-y-1 min-w-0 flex-1">
                    <span
                        class="text-[9px] sm:text-[11px] md:text-[12px] font-medium text-slate-400 uppercase tracking-wider block whitespace-normal break-words leading-tight">
                        Total Reservasi
                    </span>
                    <span
                        class="text-sm sm:text-lg md:text-2xl font-medium text-slate-900 tracking-tight tabular-nums block break-all sm:truncate leading-none pt-0.5">
                        {{ $stats['total'] }} <span
                            class="text-[8.5px] sm:text-[10px] md:text-xs font-medium text-slate-500 inline-block ml-0.5">Data</span>
                    </span>
                </div>
                <!-- Perubahan: Background indigo khas Senja Space dan icon indigo profesional -->
                <div
                    class="flex w-7 h-7 sm:w-11 sm:h-11 rounded-lg sm:rounded-xl items-center justify-center bg-indigo-50 text-indigo-500 border border-indigo-100 shrink-0 ml-1">
                    <i class="fa-solid fa-calendar-days text-[11px] sm:text-base"></i>
                </div>
            </div>
        </div>
        <!-- TAB NAVIGATION -->
        <div
            class="flex flex-col md:flex-row md:items-center md:justify-between gap-3.5 w-full bg-white md:bg-transparent border border-slate-200/50 md:border-none p-4 md:p-0 rounded-2xl md:rounded-none md:shadow-none select-none">
            <div class="w-full overflow-x-auto scrollbar-none pb-1 select-none">
                <div class="inline-flex w-auto items-center gap-1 rounded-xl bg-slate-100 p-1">
                    <button type="button" onclick="switchTab('pending')"
                        class="flex-none whitespace-nowrap rounded-lg px-3.5 py-1.5 text-center text-[11px] transition-all duration-200 outline-none cursor-pointer {{ $status === 'pending' ? 'bg-white font-medium text-slate-900 shadow-xs' : 'font-medium text-slate-500 hover:text-slate-800' }}">
                        Menunggu Verifikasi ({{ $stats['pending'] }})
                    </button>
                    <button type="button" onclick="switchTab('history')"
                        class="flex-none whitespace-nowrap rounded-lg px-3.5 py-1.5 text-center text-[11px] transition-all duration-200 outline-none cursor-pointer {{ $status === 'history' ? 'bg-white font-medium text-slate-900 shadow-xs' : 'font-medium text-slate-500 hover:text-slate-800' }}">
                        Riwayat Verifikasi ({{ $stats['approved'] + $stats['rejected'] }})
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
                            class="bg-slate-50/70 border-b border-slate-200/50 text-[11px] font-medium text-slate-400 uppercase tracking-wider select-none">
                            <th class="py-4 px-6">Pelanggan</th>
                            <th class="py-4 px-6">Kode & Meja</th>
                            <th class="py-4 px-6">Tamu & Waktu</th>
                            <th class="py-4 px-6 text-center">Nota</th>
                            <th class="py-4 px-6 text-center">Status</th>
                            <!-- KOLOM AKSI HANYA MUNCUL DI TAB PENDING -->
                            @if ($status === 'pending')
                                <th class="py-4 px-6 text-center">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white font-medium text-slate-600">
                        @forelse($reservations as $res)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="py-4 px-6">
                                    <span
                                        class="font-medium text-slate-800 block text-[13px]">{{ $res->user->name }}</span>
                                    <span
                                        class="text-[10px] font-medium text-slate-400 inline-block mt-0.5">{{ $res->user->email }}</span>
                                </td>
                                <td class="py-4 px-6">
                                    <span
                                        class="text-[10px] font-mono font-medium bg-slate-100 border border-slate-200 text-slate-500 px-1.5 py-0.5 rounded-md inline-block">
                                        {{ $res->reservation_code }}
                                    </span>
                                    <span class="block mt-1 text-slate-500 font-medium text-[12px]">Meja
                                        {{ $res->table->table_number }} ({{ $res->table->area }})</span>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="font-medium text-slate-700">
                                        {{ \Carbon\Carbon::parse($res->reservation_date)->translatedFormat('d M Y') }}
                                        <span
                                            class="text-[11px] text-slate-400 font-normal ml-1">({{ substr($res->start_time, 0, 5) }}
                                            - {{ substr($res->end_time, 0, 5) }})</span>
                                    </div>
                                    <div class="text-[11px] text-indigo-500 mt-1 font-medium">
                                        {{ $res->guests_count }} Kursi Dipesan
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <a href="{{ route('reservasi.show', $res->id) }}"
                                        class="text-blue-500 italic hover:underline text-[12px]">
                                        Lampiran
                                    </a>
                                </td>
                                <td class="py-4 px-6 text-center select-none">
                                    @if ($res->status === 'pending')
                                        <div
                                            class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-medium tracking-wide border bg-amber-50 text-amber-600 border-amber-200/50">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                            <span>PENDING</span>
                                        </div>
                                    @elseif($res->status === 'approved')
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

                                <!-- TOMBOL AKSI HANYA DIRENDER DI TAB PENDING -->
                                @if ($status === 'pending')
                                    <td class="py-4 px-6">
                                        <div class="flex items-center justify-center gap-4 text-xs font-medium">
                                            <form action="{{ route('admin.reservations.update_status', $res->id) }}"
                                                method="POST" class="inline m-0">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="approved">
                                                <button type="submit"
                                                    class="text-emerald-600 hover:text-emerald-700 transition-colors cursor-pointer bg-transparent border-none p-0 font-semibold">
                                                    Setujui
                                                </button>
                                            </form>

                                            <form action="{{ route('admin.reservations.update_status', $res->id) }}"
                                                method="POST" class="inline m-0">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit"
                                                    class="text-rose-600 hover:text-rose-700 transition-colors cursor-pointer bg-transparent border-none p-0 font-semibold">
                                                    Tolak
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <!-- Ubah colspan dinamis menyesuaikan tab yang aktif -->
                                <td colspan="{{ $status === 'pending' ? '6' : '5' }}"
                                    class="py-12 text-center text-slate-400 font-medium">
                                    Tidak ada data reservasi dengan status saat ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- MOBILE RESPONSIVE CARD VIEW -->
            <!-- MOBILE RESPONSIVE CARD VIEW -->
            <div class="block md:hidden divide-y divide-slate-100 w-full">
                @forelse($reservations as $res)
                    <div class="p-4 space-y-3.5 bg-white">
                        <div class="flex items-center justify-between gap-2">
                            <div>
                                <h4 class="text-[13px] font-medium text-slate-800 tracking-tight">
                                    {{ $res->user->name }}</h4>
                                <p class="text-[11px] text-slate-400 font-medium mt-0.5">Meja
                                    {{ $res->table->table_number }} ({{ $res->table->area }})</p>
                            </div>
                            @if ($res->status === 'pending')
                                <div
                                    class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[9.5px] font-medium tracking-wider border shrink-0 bg-amber-50 text-amber-600 border-amber-200/50">
                                    <span class="w-1 h-1 rounded-full bg-amber-500"></span>
                                    <span>PENDING</span>
                                </div>
                            @elseif($res->status === 'approved')
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
                                <p class="text-[10px] font-medium text-slate-400 uppercase tracking-wide">Tamu & Waktu
                                </p>
                                <p class="text-[12px] font-medium text-slate-700 mt-0.5 truncate">
                                    {{ \Carbon\Carbon::parse($res->reservation_date)->format('d/m/Y') }}</p>
                                <p class="text-[10px] text-slate-400 mt-px">{{ substr($res->start_time, 0, 5) }} -
                                    {{ substr($res->end_time, 0, 5) }} WIB</p>
                                <p class="text-[11px] text-indigo-500 font-medium mt-1">{{ $res->guests_count }} Kursi
                                    Dipesan</p>
                            </div>
                            <div class="text-right flex flex-col justify-between items-end">
                                <div>
                                    <p class="text-[10px] font-medium text-slate-400 uppercase tracking-wide">Kode
                                        Reservasi</p>
                                    <p class="text-[11px] font-mono font-medium text-slate-600 mt-0.5">
                                        {{ $res->reservation_code }}</p>
                                </div>
                                <div class="mt-2">
                                    <a href="{{ route('reservasi.show', $res->id) }}"
                                        class="text-blue-500 italic hover:underline text-[11px]">
                                        Lampiran Nota
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between gap-2 pt-0.5">
                            <span class="text-[10px] font-medium text-slate-400 truncate max-w-[150px]">
                                <i class="fa-solid fa-envelope mr-1"></i>{{ $res->user->email }}
                            </span>

                            <!-- TOMBOL AKSI MOBILE HANYA MUNCUL DI TAB PENDING -->
                            @if ($status === 'pending')
                                <div class="flex items-center gap-4 text-xs font-medium">
                                    <form action="{{ route('admin.reservations.update_status', $res->id) }}"
                                        method="POST" class="inline m-0">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="approved">
                                        <button type="submit"
                                            class="text-emerald-600 hover:text-emerald-700 transition-colors cursor-pointer bg-transparent border-none p-0 font-semibold">
                                            Setujui
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.reservations.update_status', $res->id) }}"
                                        method="POST" class="inline m-0">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit"
                                            class="text-rose-600 hover:text-rose-700 transition-colors cursor-pointer bg-transparent border-none p-0 font-semibold">
                                            Tolak
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="bg-white border-t border-slate-100 py-10 text-center px-4">
                        <p class="text-[12px] font-medium text-slate-400">Tidak ada data reservasi dengan status saat
                            ini.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Pagination -->
        @if ($reservations->hasPages())
            <div class="p-2">
                {{ $reservations->appends(['status' => $status])->links() }}
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
