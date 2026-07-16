<x-app-layout>
    <div class="w-full  mx-auto space-y-5 md:space-y-8 px-4">
        <x-slot name="headerTitle">Pembayaran Reservasi</x-slot>

        <!-- PAGE HEADER -->
        <x-slot name="header">
            <div class="border-b border-slate-100 pb-5 md:border-none md:pb-0">
                <x-page-header title="Pembayaran Reservasi Anda"
                    subtitle="Selesaikan pembayaran berkas reservasi Anda atau lihat riwayat transaksi di Senja Space">
                    {{-- Slot untuk Badge Kustom di Bagian Atas Judul --}}
                    <span class="text-[10px] font-medium uppercase tracking-wider text-indigo-500 block">
                        Pelanggan / Keuangan
                    </span>
                </x-page-header>
            </div>
        </x-slot>

        <!-- STATS GRID -->
        <div
            class="grid grid-cols-2 lg:grid-cols-3 gap-2.5 sm:gap-4 md:gap-5 w-full max-w-full select-none box-border overflow-hidden">
            <div
                class="bg-white rounded-xl md:rounded-2xl p-3 md:p-5 flex flex-row items-start justify-between border border-slate-200/75 w-full min-w-0 box-border break-words gap-2">
                <div class="space-y-0.5 md:space-y-1 min-w-0 flex-1">
                    <span
                        class="text-[9px] sm:text-[11px] md:text-[12px] font-medium text-amber-600 uppercase tracking-wider block whitespace-normal break-words leading-tight">
                        Belum Dibayar
                    </span>
                    <span
                        class="text-sm sm:text-lg md:text-2xl font-medium text-amber-700 tracking-tight tabular-nums block break-all sm:truncate leading-none pt-0.5">
                        {{ $stats['pending'] }} <span
                            class="text-[8.5px] sm:text-[10px] md:text-xs font-medium text-amber-500 inline-block ml-0.5">Tagihan</span>
                    </span>
                </div>
                <div
                    class="flex w-7 h-7 sm:w-11 sm:h-11 rounded-lg sm:rounded-xl items-center justify-center bg-amber-50 text-amber-500 border border-amber-200/50 shrink-0 ml-1">
                    <i class="fa-solid fa-hourglass-half text-[11px] sm:text-base"></i>
                </div>
            </div>

            <!-- Total Pembayaran Berhasil -->
            <div
                class="bg-white rounded-xl md:rounded-2xl p-3 md:p-5 flex flex-row items-start justify-between border border-slate-200/75 w-full min-w-0 box-border break-words gap-2">
                <div class="space-y-0.5 md:space-y-1 min-w-0 flex-1">
                    <span
                        class="text-[9px] sm:text-[11px] md:text-[12px] font-medium text-emerald-600 uppercase tracking-wider block whitespace-normal break-words leading-tight">
                        Pembayaran Sukses
                    </span>
                    <span
                        class="text-sm sm:text-lg md:text-2xl font-medium text-emerald-700 tracking-tight tabular-nums block break-all sm:truncate leading-none pt-0.5">
                        {{ $stats['success'] }} <span
                            class="text-[8.5px] sm:text-[10px] md:text-xs font-medium text-emerald-500 inline-block ml-0.5">Transaksi</span>
                    </span>
                </div>
                <div
                    class="flex w-7 h-7 sm:w-11 sm:h-11 rounded-lg sm:rounded-xl items-center justify-center bg-emerald-50 text-emerald-500 border border-emerald-200/50 shrink-0 ml-1">
                    <i class="fa-solid fa-circle-check text-[11px] sm:text-base"></i>
                </div>
            </div>

            <!-- Pembayaran Ditolak -->
            <div
                class="bg-white rounded-xl md:rounded-2xl p-3 md:p-5 flex flex-row items-start justify-between border border-slate-200/75 w-full min-w-0 box-border break-words gap-2 col-span-2 lg:col-span-1">
                <div class="space-y-0.5 md:space-y-1 min-w-0 flex-1">
                    <span
                        class="text-[9px] sm:text-[11px] md:text-[12px] font-medium text-rose-600 uppercase tracking-wider block whitespace-normal break-words leading-tight">
                        Ditolak Admin
                    </span>
                    <span
                        class="text-sm sm:text-lg md:text-2xl font-medium text-rose-700 tracking-tight tabular-nums block break-all sm:truncate leading-none pt-0.5">
                        {{ $stats['failed'] }} <span
                            class="text-[8.5px] sm:text-[10px] md:text-xs font-medium text-rose-500 inline-block ml-0.5">Gagal</span>
                    </span>
                </div>
                <div
                    class="flex w-7 h-7 sm:w-11 sm:h-11 rounded-lg sm:rounded-xl items-center justify-center bg-rose-50 text-rose-500 border border-rose-200/50 shrink-0 ml-1">
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
                        class="flex-none whitespace-nowrap rounded-lg px-3.5 py-1.5 text-center text-[11px] transition-all duration-200 outline-none cursor-pointer {{ $status === 'pending' ? 'bg-white font-medium text-slate-900 ' : 'font-medium text-slate-500 hover:text-slate-800' }}">
                        Permintaan Aktif ({{ $stats['pending'] }})
                    </button>
                    <button type="button" onclick="switchTab('history')"
                        class="flex-none whitespace-nowrap rounded-lg px-3.5 py-1.5 text-center text-[11px] transition-all duration-200 outline-none cursor-pointer {{ $status === 'history' ? 'bg-white font-medium text-slate-900 ' : 'font-medium text-slate-500 hover:text-slate-800' }}">
                        Riwayat Transaksi ({{ $stats['success'] + $stats['failed'] }})
                    </button>
                </div>
            </div>
        </div>

        <!-- MAIN DATA LAYOUT -->
        <div class="space-y-4">
            @forelse($displayData as $item)
                @if ($status === 'pending')
                    <div
                        class="bg-white p-5 border border-slate-200 rounded-xl  flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <span
                                class="text-[10px] font-medium uppercase tracking-wider bg-amber-100 text-amber-800 px-2 py-0.5 rounded">
                                {{ $item->reservation_code }}
                            </span>
                            <h3 class="font-medium text-slate-800 text-base mt-1.5">Meja Nomor:
                                {{ $item->table->table_number }}</h3>
                            <p class="text-xs text-slate-500 font-medium mt-0.5">
                                Jadwal: {{ \Carbon\Carbon::parse($item->reservation_date)->format('d M Y') }} |
                                {{ substr($item->start_time, 0, 5) }} - {{ substr($item->end_time, 0, 5) }} WIB
                            </p>
                        </div>
                        <div class="shrink-0">
                            <a href="{{ route('payment.create', $item->id) }}"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-medium text-xs text-white uppercase tracking-wider hover:bg-blue-500 active:bg-slate-950 transition ease-in-out duration-150 ">
                                Bayar Sekarang
                            </a>
                        </div>
                    </div>
                @else
                    <div
                        class="bg-white p-5 border border-slate-200 rounded-xl  flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <div class="flex items-center gap-2">
                                <span
                                    class="text-[10px] font-medium uppercase tracking-wider bg-slate-100 border border-slate-200 text-slate-600 px-2 py-0.5 rounded">
                                    {{ $item->payment_code }}
                                </span>
                                @if ($item->status === 'success')
                                    <span
                                        class="inline-block px-2 py-0.5 text-[9.5px] font-medium bg-emerald-50 text-emerald-600 border border-emerald-200/50 rounded-full">APPROVED</span>
                                @else
                                    <span
                                        class="inline-block px-2 py-0.5 text-[9.5px] font-medium bg-rose-50 text-rose-600 border border-rose-200/50 rounded-full">REJECTED</span>
                                @endif
                            </div>
                            <h3 class="font-medium text-slate-800 text-base mt-2">Nominal: Rp
                                {{ number_format($item->amount, 0, ',', '.') }}</h3>
                            <p class="text-xs text-slate-500 font-medium mt-0.5">
                                Meja {{ $item->reservation->table->table_number ?? '-' }} | Dicatat:
                                {{ $item->created_at->format('d M Y, H:i') }} WIB
                            </p>
                            @if ($item->admin_note)
                                <p
                                    class="text-[11px] text-rose-600 italic bg-rose-50/50 px-2 py-1 rounded-md border border-rose-100 mt-2 max-w-md">
                                    Catatan Admin: {{ $item->admin_note }}
                                </p>
                            @endif
                        </div>
                        <div class="shrink-0 flex items-center">
                            <a href="{{ asset('storage/' . $item->proof_of_payment) }}" target="_blank"
                                class="inline-flex items-center px-3 py-1.5 border border-slate-200 bg-slate-50 text-slate-600 rounded-lg font-medium text-xs tracking-wide hover:bg-slate-100 transition">
                                <i class="fa-solid fa-image mr-1.5 text-slate-400"></i> Lihat Bukti
                            </a>
                        </div>
                    </div>
                @endif
            @empty
                <div class="bg-white p-8 text-center rounded-xl border border-slate-200 ">
                    <p class="text-slate-500 font-medium text-xs">
                        {{ $status === 'pending' ? 'Tidak ada tagihan reservasi aktif saat ini.' : 'Belum ada riwayat transaksi pembayaran.' }}
                    </p>
                </div>
            @endforelse
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
