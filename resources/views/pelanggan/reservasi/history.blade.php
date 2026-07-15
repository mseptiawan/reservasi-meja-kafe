<x-app-layout>
    <div class="w-full max-w-none mx-auto space-y-5 md:space-y-8">

        <!-- PAGE HEADER -->
        <div class="border border-slate-200/60 md:border-none md:shadow-none mt-8">
            <div class="flex flex-col gap-1">
                <span class="text-[10px] font-medium uppercase tracking-wider text-indigo-500">Aktivitas Saya /
                    Reservasi</span>
                <h2 class="font-medium text-xl text-slate-800 leading-tight">
                    {{ __('Riwayat Reservasi Meja') }}
                </h2>
                <p class="text-[11px] text-slate-400 mt-0.5">Pantau status persetujuan kunjungan dan nomor meja makan
                    Anda di Senja Space</p>
            </div>
        </div>

        <!-- STATS GRID -->
        <div
            class="grid grid-cols-2 lg:grid-cols-3 gap-2.5 sm:gap-4 md:gap-5 w-full max-w-full select-none box-border overflow-hidden">
            <!-- Total Reservasi -->
            <div
                class="bg-white rounded-xl md:rounded-2xl p-3 md:p-5 flex flex-row items-start justify-between border border-slate-200/75 w-full min-w-0 box-border break-words gap-2">
                <div class="space-y-0.5 md:space-y-1 min-w-0 flex-1">
                    <span
                        class="text-[9px] sm:text-[11px] md:text-[12px] font-medium text-slate-400 uppercase tracking-wider block whitespace-normal break-words leading-tight">
                        Total Pemesanan
                    </span>
                    <span
                        class="text-sm sm:text-lg md:text-2xl font-medium text-slate-900 tracking-tight tabular-nums block break-all sm:truncate leading-none pt-0.5">
                        {{ $stats['total'] }} <span
                            class="text-[8.5px] sm:text-[10px] md:text-xs font-semibold text-slate-500 inline-block ml-0.5">Kali</span>
                    </span>
                </div>
                <div
                    class="flex w-7 h-7 sm:w-11 sm:h-11 rounded-lg sm:rounded-xl items-center justify-center bg-slate-50 text-slate-400 border border-slate-200/50 shrink-0 ml-1">
                    <i class="fa-solid fa-utensils text-[11px] sm:text-base"></i>
                </div>
            </div>

            <!-- Menunggu Persetujuan -->
            <div
                class="bg-white rounded-xl md:rounded-2xl p-3 md:p-5 flex flex-row items-start justify-between border border-slate-200/75 w-full min-w-0 box-border break-words gap-2">
                <div class="space-y-0.5 md:space-y-1 min-w-0 flex-1">
                    <span
                        class="text-[9px] sm:text-[11px] md:text-[12px] font-medium text-amber-600 uppercase tracking-wider block whitespace-normal break-words leading-tight">
                        Menunggu Konfirmasi
                    </span>
                    <span
                        class="text-sm sm:text-lg md:text-2xl font-medium text-amber-700 tracking-tight tabular-nums block break-all sm:truncate leading-none pt-0.5">
                        {{ $stats['pending'] }} <span
                            class="text-[8.5px] sm:text-[10px] md:text-xs font-semibold text-amber-500 inline-block ml-0.5">Meja</span>
                    </span>
                </div>
                <div
                    class="flex w-7 h-7 sm:w-11 sm:h-11 rounded-lg sm:rounded-xl items-center justify-center bg-amber-50 text-amber-500 border border-amber-200/50 shrink-0 ml-1">
                    <i class="fa-solid fa-hourglass-half text-[11px] sm:text-base"></i>
                </div>
            </div>

            <!-- Disetujui Admin -->
            <div
                class="bg-white rounded-xl md:rounded-2xl p-3 md:p-5 flex flex-row items-start justify-between border border-slate-200/75 w-full min-w-0 box-border break-words gap-2 col-span-2 lg:col-span-1">
                <div class="space-y-0.5 md:space-y-1 min-w-0 flex-1">
                    <span
                        class="text-[9px] sm:text-[11px] md:text-[12px] font-medium text-emerald-600 uppercase tracking-wider block whitespace-normal break-words leading-tight">
                        Booking Disetujui
                    </span>
                    <span
                        class="text-sm sm:text-lg md:text-2xl font-medium text-emerald-700 tracking-tight tabular-nums block break-all sm:truncate leading-none pt-0.5">
                        {{ $stats['approved'] }} <span
                            class="text-[8.5px] sm:text-[10px] md:text-xs font-semibold text-emerald-500 inline-block ml-0.5">Sukses</span>
                    </span>
                </div>
                <div
                    class="flex w-7 h-7 sm:w-11 sm:h-11 rounded-lg sm:rounded-xl items-center justify-center bg-emerald-50 text-emerald-500 border border-emerald-200/50 shrink-0 ml-1">
                    <i class="fa-solid fa-circle-check text-[11px] sm:text-base"></i>
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
                        Menunggu Persetujuan ({{ $stats['pending'] }})
                    </button>
                    <button type="button" onclick="switchTab('history')"
                        class="flex-none whitespace-nowrap rounded-lg px-3.5 py-1.5 text-center text-[11px] transition-all duration-200 outline-none cursor-pointer {{ $status === 'history' ? 'bg-white font-medium text-slate-900 shadow-xs' : 'font-medium text-slate-500 hover:text-slate-800' }}">
                        Riwayat Transaksi ({{ $stats['total'] - $stats['pending'] }})
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

        <!-- CONTENT AREA: LIST TABLES -->
        <div class="bg-white rounded-2xl overflow-hidden w-full border border-slate-200/50">

            <!-- DESKTOP TABLE VIEW -->
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-left border-collapse text-[13px]">
                    <thead>
                        <tr
                            class="bg-slate-50/70 border-b border-slate-200/50 text-[11px] font-semibold text-slate-400 uppercase tracking-wider select-none">
                            <th class="py-4 px-6">Kode Booking</th>
                            <th class="py-4 px-6">Informasi Meja</th>
                            <th class="py-4 px-6">Tanggal Kunjungan</th>
                            <th class="py-4 px-6">Durasi & Tamu</th>
                            <th class="py-4 px-6 text-center">Status</th>
                            <th class="py-4 px-6 text-center">Nota</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white font-medium text-slate-600">
                        @forelse($reservations as $res)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="py-4 px-6">
                                    <span
                                        class="font-mono font-medium text-slate-800 block text-[13px]">{{ $res->reservation_code }}</span>
                                    <span class="text-[10px] font-medium text-slate-400 inline-block mt-0.5">Diajukan:
                                        {{ $res->created_at->format('d/m H:i') }}</span>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="font-semibold text-slate-800 block text-[13px]">Meja
                                        {{ $res->table->table_number }}</span>
                                    <span
                                        class="text-[10px] font-medium text-slate-400 inline-block uppercase mt-0.5">{{ $res->table->area }}</span>
                                </td>
                                <td class="py-4 px-6 font-semibold text-slate-700">
                                    {{ \Carbon\Carbon::parse($res->reservation_date)->translatedFormat('d F Y') }}
                                </td>
                                <td class="py-4 px-6 font-medium text-slate-500">
                                    <div class="text-slate-700 font-semibold">{{ substr($res->start_time, 0, 5) }} -
                                        {{ substr($res->end_time, 0, 5) }}</div>
                                    <div class="text-[10px] text-slate-400 mt-0.5">{{ $res->guests_count }} Kursi
                                        Dipesan</div>
                                </td>
                                <td class="py-4 px-6 text-center select-none">
                                    @if ($res->status === 'pending')
                                        <div
                                            class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-medium tracking-wide border bg-amber-50 text-amber-600 border-amber-200/50">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                            <span>MENUNGGU</span>
                                        </div>
                                    @elseif($res->status === 'approved')
                                        <div
                                            class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-medium tracking-wide border bg-emerald-50 text-emerald-600 border-emerald-200/50">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            <span>DISETUJUI</span>
                                        </div>
                                    @else
                                        <div
                                            class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-medium tracking-wide border bg-rose-50 text-rose-600 border-rose-200/50">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                            <span>DITOLAK</span>
                                        </div>
                                    @endif
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center justify-center">
                                        <a href="{{ route('reservasi.show', $res->id) }}"
                                            class="w-8 h-8 rounded-lg bg-white border border-slate-200/80 text-slate-400 hover:text-indigo-600 inline-flex items-center justify-center transition-all active:scale-[0.95]"
                                            title="Lihat Struk Nota">
                                            <i class="fa-solid fa-receipt text-[11px]"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-12 text-center text-slate-400 font-medium">Tidak ada data
                                    reservasi pada kategori ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- MOBILE RESPONSIVE CARD VIEW -->
            <div class="block md:hidden divide-y divide-slate-100 w-full">
                @forelse($reservations as $res)
                    <div class="p-4 space-y-3.5 bg-white">
                        <div class="flex items-center justify-between gap-2">
                            <div>
                                <h4 class="text-[13px] font-mono font-medium text-slate-800 tracking-tight">
                                    {{ $res->reservation_code }}</h4>
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
                                <p class="text-[10px] font-medium text-slate-400 uppercase tracking-wide">Tanggal Datang
                                </p>
                                <p class="text-[11px] font-semibold text-slate-700 mt-0.5">
                                    {{ \Carbon\Carbon::parse($res->reservation_date)->format('d/m/Y') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-[10px] font-medium text-slate-400 uppercase tracking-wide">Jam Kunjungan
                                </p>
                                <p class="text-[11px] font-semibold text-slate-700 mt-0.5">
                                    {{ substr($res->start_time, 0, 5) }}-{{ substr($res->end_time, 0, 5) }}</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between gap-2 pt-0.5">
                            <span class="text-[11px] font-medium text-slate-400">
                                <i class="fa-solid fa-users mr-1"></i>{{ $res->guests_count }} Orang Tamu
                            </span>
                            <a href="{{ route('reservasi.show', $res->id) }}"
                                class="h-8 px-3.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-[11px] font-medium rounded-lg flex items-center justify-center gap-1 transition-all active:scale-95">
                                <i class="fa-solid fa-receipt text-[10px]"></i> Lihat Struk
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="bg-white border-t border-slate-100 py-10 text-center px-4">
                        <p class="text-[12px] font-medium text-slate-400">Tidak ada riwayat reservasi pada kategori
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

    <!-- JAVASCRIPT LOGIC SWITCH TAB -->
    <script>
        function switchTab(tabName) {
            const url = new URL(window.location.href);
            url.searchParams.set('status', tabName);
            url.searchParams.delete('page'); // Reset pagination ke halaman awal
            window.location.href = url.toString();
        }
    </script>
</x-app-layout>
