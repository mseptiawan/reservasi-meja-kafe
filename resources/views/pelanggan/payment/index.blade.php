<x-app-layout>
    <div class="w-full max-w-none mx-auto space-y-5 md:space-y-8">

        <!-- PAGE HEADER -->
        <x-slot name="headerTitle">Pembayaran Reservasi</x-slot>
        <x-slot name="header">
            <div class="border-b border-slate-100 pb-5 md:border-none md:pb-0">
                <x-page-header title="Pembayaran Reservasi"
                    subtitle="Selesaikan tagihan pemesanan meja atau pantau riwayat konfirmasi keuangan Senja Space">
                    <span class="text-[10px] font-medium uppercase tracking-wider text-indigo-500 block">
                        Area Pelanggan / Keuangan
                    </span>
                </x-page-header>
            </div>
        </x-slot>

        <!-- STATS GRID -->
        <div
            class="grid grid-cols-2 lg:grid-cols-3 gap-2.5 sm:gap-4 md:gap-5 w-full max-w-full select-none box-border overflow-hidden">
            <!-- Menunggu Tindakan / Pending -->
            <div
                class="bg-white rounded-xl md:rounded-2xl p-3 md:p-5 flex flex-row items-start justify-between border border-slate-200/75 w-full min-w-0 box-border break-words gap-2">
                <div class="space-y-0.5 md:space-y-1 min-w-0 flex-1">
                    <span
                        class="text-[9px] sm:text-[11px] md:text-[12px] font-medium text-amber-600 uppercase tracking-wider block whitespace-normal break-words leading-tight">
                        Permintaan Aktif
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

            <!-- Pembayaran Sukses -->
            <div
                class="bg-white rounded-xl md:rounded-2xl p-3 md:p-5 flex flex-row items-start justify-between border border-slate-200/75 w-full min-w-0 box-border break-words gap-2">
                <div class="space-y-0.5 md:space-y-1 min-w-0 flex-1">
                    <span
                        class="text-[9px] sm:text-[11px] md:text-[12px] font-medium text-slate-500 uppercase tracking-wider block whitespace-normal break-words leading-tight">
                        Pembayaran Sukses
                    </span>
                    <span
                        class="text-sm sm:text-lg md:text-2xl font-medium text-slate-900 tracking-tight tabular-nums block break-all sm:truncate leading-none pt-0.5">
                        {{ $stats['success'] }} <span
                            class="text-[8.5px] sm:text-[10px] md:text-xs font-semibold text-slate-500 inline-block ml-0.5">Transaksi</span>
                    </span>
                </div>
                <div
                    class="flex w-7 h-7 sm:w-11 sm:h-11 rounded-lg sm:rounded-xl items-center justify-center bg-slate-50 text-slate-400 border border-slate-200/50 shrink-0 ml-1">
                    <i class="fa-solid fa-circle-check text-[11px] sm:text-base"></i>
                </div>
            </div>

            <!-- Pembayaran Ditolak -->
            <div
                class="bg-white rounded-xl md:rounded-2xl p-3 md:p-5 flex flex-row items-start justify-between border border-slate-200/75 w-full min-w-0 box-border break-words gap-2 col-span-2 lg:col-span-1">
                <div class="space-y-0.5 md:space-y-1 min-w-0 flex-1">
                    <span
                        class="text-[9px] sm:text-[11px] md:text-[12px] font-medium text-slate-500 uppercase tracking-wider block whitespace-normal break-words leading-tight">
                        Ditolak Admin
                    </span>
                    <span
                        class="text-sm sm:text-lg md:text-2xl font-medium text-slate-900 tracking-tight tabular-nums block break-all sm:truncate leading-none pt-0.5">
                        {{ $stats['failed'] }} <span
                            class="text-[8.5px] sm:text-[10px] md:text-xs font-semibold text-slate-500 inline-block ml-0.5">Gagal</span>
                    </span>
                </div>
                <div
                    class="flex w-7 h-7 sm:w-11 sm:h-11 rounded-lg sm:rounded-xl items-center justify-center bg-slate-100 text-slate-500 border border-slate-200/50 shrink-0 ml-1">
                    <i class="fa-solid fa-circle-xmark text-[11px] sm:text-base"></i>
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
                        Permintaan Aktif ({{ $stats['pending'] }})
                    </button>
                    <button type="button" onclick="switchTab('history')"
                        class="flex-none whitespace-nowrap rounded-lg px-3.5 py-1.5 text-center text-[11px] transition-all duration-200 outline-none cursor-pointer {{ $status === 'history' ? 'bg-white font-medium text-slate-900 shadow-xs' : 'font-medium text-slate-500 hover:text-slate-800' }}">
                        Riwayat Transaksi ({{ $stats['success'] + $stats['failed'] }})
                    </button>
                </div>
            </div>
        </div>

        <!-- DATA CONTAINER -->
        <div class="bg-white rounded-2xl overflow-hidden w-full border border-slate-200/50">

            <!-- DESKTOP TABLE VIEW -->
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-left border-collapse text-[13px]">
                    <thead>
                        <tr
                            class="bg-slate-50/70 border-b border-slate-200/50 text-[11px] font-semibold text-slate-400 uppercase tracking-wider select-none">
                            <th class="py-4 px-6">Informasi Transaksi</th>
                            <th class="py-4 px-6">Detail Meja</th>
                            <th class="py-4 px-6">Jadwal Pemesanan</th>
                            <th class="py-4 px-6 text-right">Nominal</th>
                            <th class="py-4 px-6 text-center">Status</th>
                            <th class="py-4 px-6 text-center">Aksi / Berkas</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white font-medium text-slate-600">
                        @forelse($displayData as $item)
                            <tr class="hover:bg-slate-50/50 transition-colors">

                                <!-- 1. Informasi Transaksi -->
                                <td class="py-4 px-6">
                                    @if ($item->display_type === 'unpaid')
                                        <span
                                            class="text-[10px] font-mono font-semibold bg-amber-50 border border-amber-200 text-amber-700 px-1.5 py-0.5 rounded-md inline-block">
                                            {{ $item->reservation_code }}
                                        </span>
                                        <span class="text-[10px] font-medium text-slate-400 block mt-1">Belum Ada
                                            Transaksi</span>
                                    @else
                                        <span
                                            class="text-[10px] font-mono font-semibold bg-slate-100 border border-slate-200 text-slate-600 px-1.5 py-0.5 rounded-md inline-block">
                                            {{ $item->payment_code }}
                                        </span>
                                        <span class="text-[10px] font-medium text-slate-400 block mt-1">Ref:
                                            {{ $item->reservation->reservation_code ?? '-' }}</span>
                                    @endif
                                </td>

                                <!-- 2. Detail Meja -->
                                <td class="py-4 px-6">
                                    @if ($item->display_type === 'unpaid')
                                        <span class="font-semibold text-slate-800 block">Meja
                                            {{ $item->table->table_number }}</span>
                                        <span class="text-[10px] text-slate-400 font-medium">Area
                                            {{ $item->table->area ?? 'Indoor' }}</span>
                                    @else
                                        <span class="font-semibold text-slate-800 block">Meja
                                            {{ $item->reservation->table->table_number ?? '-' }}</span>
                                        <span class="text-[10px] text-slate-400 font-medium">Area
                                            {{ $item->reservation->table->area ?? 'Indoor' }}</span>
                                    @endif
                                </td>

                                <!-- 3. Jadwal Pemesanan -->
                                <td class="py-4 px-6 font-medium text-slate-500">
                                    @if ($item->display_type === 'unpaid')
                                        <span
                                            class="block text-slate-700">{{ \Carbon\Carbon::parse($item->reservation_date)->translatedFormat('d M Y') }}</span>
                                        <span
                                            class="text-[10px] text-slate-400 block mt-0.5">{{ substr($item->start_time, 0, 5) }}
                                            - {{ substr($item->end_time, 0, 5) }} WIB</span>
                                    @else
                                        <span
                                            class="block text-slate-700">{{ \Carbon\Carbon::parse($item->reservation->reservation_date ?? now())->translatedFormat('d M Y') }}</span>
                                        <span
                                            class="text-[10px] text-slate-400 block mt-0.5">{{ substr($item->reservation->start_time ?? '', 0, 5) }}
                                            - {{ substr($item->reservation->end_time ?? '', 0, 5) }} WIB</span>
                                    @endif
                                </td>

                                <!-- 4. Nominal -->
                                <td class="py-4 px-6 text-right font-semibold text-slate-800 tabular-nums">
                                    @if ($item->display_type === 'unpaid')
                                        Rp {{ number_format($item->table->capacity * 25000, 0, ',', '.') }}
                                    @else
                                        Rp {{ number_format($item->amount, 0, ',', '.') }}
                                    @endif
                                </td>

                                <!-- 5. Status -->
                                <td class="py-4 px-6 text-center select-none">
                                    @if ($item->display_type === 'unpaid')
                                        <div
                                            class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-medium tracking-wide border bg-amber-50 text-amber-600 border-amber-200/50">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                                            <span>BELUM BAYAR</span>
                                        </div>
                                    @elseif($item->display_type === 'pending_verification')
                                        <div
                                            class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-medium tracking-wide border bg-indigo-50 text-indigo-600 border-indigo-200/50 animate-pulse">
                                            <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span>
                                            <span>VERIFIKASI</span>
                                        </div>
                                    @elseif($item->status === 'success')
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

                                <!-- 6. Aksi / Berkas -->
                                <td class="py-4 px-6">
                                    <div class="flex items-center justify-center">
                                        @if ($item->display_type === 'unpaid')
                                            <a href="{{ route('payment.create', $item->id) }}"
                                                class="h-7 px-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-[11px] rounded-lg inline-flex items-center justify-center tracking-wide transition-all active:scale-[0.95]"
                                                title="Proses Pembayaran">
                                                Bayar
                                            </a>
                                        @else
                                            <a href="{{ asset('storage/' . $item->proof_of_payment) }}" target="_blank"
                                                class="text-slate-400 hover:text-indigo-600 font-medium text-[12px] transition-colors active:scale-[0.98]"
                                                title="Lihat Bukti Transfer">
                                                Lihat
                                            </a>
                                        @endif
                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-12 text-center text-slate-400 font-medium">
                                    {{ $status === 'pending' ? 'Tidak ada tagihan aktif atau konfirmasi berjalan saat ini.' : 'Belum ada riwayat transaksi pembayaran.' }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- MOBILE RESPONSIVE CARD VIEW -->
            <div class="block md:hidden divide-y divide-slate-100 w-full">
                @forelse($displayData as $item)
                    <div class="p-4 space-y-3.5 bg-white">
                        <div class="flex items-center justify-between gap-2">
                            <div>
                                @if ($item->display_type === 'unpaid')
                                    <h4 class="text-[13px] font-semibold text-slate-800 tracking-tight">Meja
                                        {{ $item->table->table_number }}</h4>
                                    <p class="text-[11px] font-mono font-medium text-slate-400 mt-0.5">
                                        {{ $item->reservation_code }}</p>
                                @else
                                    <h4 class="text-[13px] font-semibold text-slate-800 tracking-tight">Meja
                                        {{ $item->reservation->table->table_number ?? '-' }}</h4>
                                    <p class="text-[11px] font-mono font-medium text-slate-400 mt-0.5">
                                        {{ $item->payment_code }}</p>
                                @endif
                            </div>

                            <!-- Status Badge Mobile -->
                            @if ($item->display_type === 'unpaid')
                                <div
                                    class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[9.5px] font-medium border bg-amber-50 text-amber-600 border-amber-200/50">
                                    <span>BELUM BAYAR</span>
                                </div>
                            @elseif($item->display_type === 'pending_verification')
                                <div
                                    class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[9.5px] font-medium border bg-indigo-50 text-indigo-600 border-indigo-200/50 animate-pulse">
                                    <span>VERIFIKASI</span>
                                </div>
                            @elseif($item->status === 'success')
                                <div
                                    class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[9.5px] font-medium border bg-emerald-50 text-emerald-600 border-emerald-200/50">
                                    <span>APPROVED</span>
                                </div>
                            @else
                                <div
                                    class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[9.5px] font-medium border bg-rose-50 text-rose-600 border-rose-200/50">
                                    <span>REJECTED</span>
                                </div>
                            @endif
                        </div>

                        <!-- Detail Section Box -->
                        <div
                            class="bg-slate-50/60 rounded-xl px-3.5 py-2.5 border border-slate-200/30 grid grid-cols-2 gap-2 text-xs">
                            <div>
                                <p class="text-[10px] font-medium text-slate-400 uppercase tracking-wide">Jadwal
                                    Pemesanan</p>
                                <p class="text-[11px] font-semibold text-slate-700 mt-0.5">
                                    @if ($item->display_type === 'unpaid')
                                        {{ \Carbon\Carbon::parse($item->reservation_date)->format('d/m/Y') }}
                                    @else
                                        {{ \Carbon\Carbon::parse($item->reservation->reservation_date ?? now())->format('d/m/Y') }}
                                    @endif
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="text-[10px] font-medium text-slate-400 uppercase tracking-wide">Total Nominal
                                </p>
                                <p class="text-[12px] font-bold text-slate-800 mt-0.5 tracking-tight tabular-nums">
                                    @if ($item->display_type === 'unpaid')
                                        Rp {{ number_format($item->table->capacity * 25000, 0, ',', '.') }}
                                    @else
                                        Rp {{ number_format($item->amount, 0, ',', '.') }}
                                    @endif
                                </p>
                            </div>
                        </div>

                        <!-- Rejection Reason if available -->
                        @if ($item->display_type === 'history' && $item->admin_notes)
                            <div
                                class="text-[11px] text-rose-600 bg-rose-50/40 border border-rose-100/70 p-2.5 rounded-xl italic">
                                Catatan Admin: {{ $item->admin_notes }}
                            </div>
                        @endif

                        <!-- Bottom Action Mobile -->
                        <div class="flex items-center justify-between gap-2 pt-0.5">
                            <span class="text-[11px] font-medium text-slate-400">
                                <i class="fa-solid fa-clock-rotate-left mr-1"></i>
                                @if ($item->display_type === 'unpaid')
                                    {{ substr($item->start_time, 0, 5) }} WIB
                                @else
                                    {{ $item->created_at->format('H:i') }} WIB
                                @endif
                            </span>

                            @if ($item->display_type === 'unpaid')
                                <a href="{{ route('payment.create', $item->id) }}"
                                    class="h-8 px-4 bg-indigo-600 text-white text-[11px] font-semibold rounded-lg flex items-center justify-center tracking-wide active:scale-95">
                                    BAYAR SEKARANG
                                </a>
                            @else
                                <a href="{{ asset('storage/' . $item->proof_of_payment) }}" target="_blank"
                                    class="text-slate-400 hover:text-indigo-600 font-medium text-[11px] transition-colors active:scale-[0.98]">
                                    Lihat Bukti
                                </a>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="bg-white border-t border-slate-100 py-10 text-center px-4">
                        <p class="text-[12px] font-medium text-slate-400">
                            {{ $status === 'pending' ? 'Tidak ada tagihan aktif saat ini.' : 'Belum ada riwayat transaksi.' }}
                        </p>
                    </div>
                @endforelse
            </div>

        </div>

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
