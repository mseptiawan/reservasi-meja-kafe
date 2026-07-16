<x-app-layout>
    <div class="w-full max-w-none mx-auto space-y-5 md:space-y-8">

        <!-- PAGE HEADER -->
        <x-slot name="headerTitle">Verifikasi Pembayaran</x-slot>

        <x-slot name="header">
            <div class="border-b border-slate-100 pb-5 md:border-none md:pb-0">
                <!-- Komponen Page Header -->
                <x-page-header title="Verifikasi Pembayaran Masuk"
                    subtitle="Konfirmasi bukti transfer tanda jadi reservasi pelanggan Senja Space Cafe">
                    <span class="text-[10px] font-medium uppercase tracking-wider text-indigo-500 block">
                        Area Kerja / Keuangan
                    </span>
                </x-page-header>
            </div>
        </x-slot>

        <!-- STATS GRID -->
        <div
            class="grid grid-cols-2 lg:grid-cols-3 gap-2.5 sm:gap-4 md:gap-5 w-full max-w-full select-none box-border overflow-hidden">
            <!-- Total Transaksi masuk -->
            <div
                class="bg-white rounded-xl md:rounded-2xl p-3 md:p-5 flex flex-row items-start justify-between border border-slate-200/75 w-full min-w-0 box-border break-words gap-2">
                <div class="space-y-0.5 md:space-y-1 min-w-0 flex-1">
                    <span
                        class="text-[9px] sm:text-[11px] md:text-[12px] font-medium text-slate-400 uppercase tracking-wider block whitespace-normal break-words leading-tight">
                        Total Transaksi
                    </span>
                    <span
                        class="text-sm sm:text-lg md:text-2xl font-medium text-slate-900 tracking-tight tabular-nums block break-all sm:truncate leading-none pt-0.5">
                        {{ $stats['total'] }} <span
                            class="text-[8.5px] sm:text-[10px] md:text-xs font-medium text-slate-500 inline-block ml-0.5">Data</span>
                    </span>
                </div>
                <div
                    class="flex w-7 h-7 sm:w-11 sm:h-11 rounded-lg sm:rounded-xl items-center justify-center bg-slate-50 text-slate-400 border border-slate-200/50 shrink-0 ml-1">
                    <i class="fa-solid fa-file-invoice-dollar text-[11px] sm:text-base"></i>
                </div>
            </div>

            <!-- Menunggu Verifikasi (Pending) -->
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
                            class="text-[8.5px] sm:text-[10px] md:text-xs font-medium text-amber-500 inline-block ml-0.5">Berkas</span>
                    </span>
                </div>
                <div
                    class="flex w-7 h-7 sm:w-11 sm:h-11 rounded-lg sm:rounded-xl items-center justify-center bg-amber-50 text-amber-500 border border-amber-200/50 shrink-0 ml-1">
                    <i class="fa-solid fa-hourglass-half text-[11px] sm:text-base"></i>
                </div>
            </div>

            <!-- Total Berhasil (Disetujui) -->
            <div
                class="bg-white rounded-xl md:rounded-2xl p-3 md:p-5 flex flex-row items-start justify-between border border-slate-200/75 w-full min-w-0 box-border break-words gap-2 col-span-2 lg:col-span-1">
                <div class="space-y-0.5 md:space-y-1 min-w-0 flex-1">
                    <span
                        class="text-[9px] sm:text-[11px] md:text-[12px] font-medium text-emerald-600 uppercase tracking-wider block whitespace-normal break-words leading-tight">
                        Pembayaran Lunas
                    </span>
                    <span
                        class="text-sm sm:text-lg md:text-2xl font-medium text-emerald-700 tracking-tight tabular-nums block break-all sm:truncate leading-none pt-0.5">
                        {{ $stats['success'] }} <span
                            class="text-[8.5px] sm:text-[10px] md:text-xs font-medium text-emerald-500 inline-block ml-0.5">Sukses</span>
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
                        class="flex-none whitespace-nowrap rounded-lg px-3.5 py-1.5 text-center text-[11px] transition-all duration-200 outline-none cursor-pointer {{ $status === 'pending' ? 'bg-white font-medium text-slate-900 shadow-sm' : 'font-medium text-slate-500 hover:text-slate-800' }}">
                        Permintaan Aktif ({{ $stats['pending'] }})
                    </button>
                    <button type="button" onclick="switchTab('history')"
                        class="flex-none whitespace-nowrap rounded-lg px-3.5 py-1.5 text-center text-[11px] transition-all duration-200 outline-none cursor-pointer {{ $status === 'history' ? 'bg-white font-medium text-slate-900 shadow-sm' : 'font-medium text-slate-500 hover:text-slate-800' }}">
                        Riwayat Pembayaran ({{ $stats['success'] + $stats['failed'] }})
                    </button>
                </div>
            </div>
        </div>

        <!-- Alert Notifikasi Berhasil -->
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
                            <th class="py-4 px-6">Kode / Waktu</th>
                            <th class="py-4 px-6">Pelanggan</th>
                            <th class="py-4 px-6">Detail Reservasi</th>
                            <th class="py-4 px-6">Nominal</th>
                            <th class="py-4 px-6">Bukti Transfer</th>
                            <th class="py-4 px-6 text-center">Status</th>
                            <th class="py-4 px-6 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white font-medium text-slate-600">
                        @forelse($payments as $pay)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="py-4 px-6">
                                    <span
                                        class="font-medium text-slate-800 block text-[13px]">{{ $pay->payment_code }}</span>
                                    <span
                                        class="text-[10px] font-medium text-slate-400 inline-block mt-0.5">{{ $pay->created_at->format('d M Y, H:i') }}
                                        WIB</span>
                                </td>
                                <td class="py-4 px-6 text-slate-800">
                                    {{ $pay->reservation->user->name ?? 'User Terhapus' }}
                                </td>
                                <td class="py-4 px-6">
                                    <span class="block font-medium text-slate-700">Meja
                                        {{ $pay->reservation->table->table_number ?? '-' }}</span>
                                    <span class="text-[11px] text-slate-400 font-normal block mt-0.5">
                                        Jadwal:
                                        {{ \Carbon\Carbon::parse($pay->reservation->reservation_date)->format('d/m/Y') }}
                                        ({{ substr($pay->reservation->start_time, 0, 5) }} -
                                        {{ substr($pay->reservation->end_time, 0, 5) }})
                                    </span>
                                </td>
                                <td class="py-4 px-6 font-medium text-slate-900">
                                    Rp {{ number_format($pay->amount, 0, ',', '.') }}
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center justify-center">
                                        <a href="{{ asset('storage/' . $pay->proof_of_payment) }}" target="_blank"
                                            class="text-slate-400 hover:text-indigo-600 font-medium text-[12px] transition-colors active:scale-[0.98]"
                                            title="Lihat Bukti Transfer">
                                            Lihat
                                        </a>
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-center select-none">
                                    @if ($pay->status === 'pending')
                                        <span
                                            class="inline-block px-2.5 py-0.5 text-[10px] font-medium bg-amber-50 text-amber-600 border border-amber-200/50 rounded-full">PENDING</span>
                                    @elseif($pay->status === 'success')
                                        <span
                                            class="inline-block px-2.5 py-0.5 text-[10px] font-medium bg-emerald-50 text-emerald-600 border border-emerald-200/50 rounded-full">APPROVED</span>
                                    @else
                                        <span
                                            class="inline-block px-2.5 py-0.5 text-[10px] font-medium bg-rose-50 text-rose-600 border border-rose-200/50 rounded-full">REJECTED</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6">
                                    @if ($pay->status === 'pending')
                                        <form action="{{ route('admin.payments.verify', $pay->id) }}" method="POST"
                                            class="flex items-center justify-center gap-1.5 m-0">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" name="status" value="success"
                                                onclick="return confirm('Setujui transaksi ini?')"
                                                class="w-8 h-8 rounded-lg bg-white border border-slate-200/80 text-slate-400 hover:text-emerald-600 inline-flex items-center justify-center transition-all active:scale-[0.95]"
                                                title="Setujui Akun">
                                                <i class="fa-solid fa-user-check text-[11px]"></i>
                                            </button>
                                            <button type="submit" name="status" value="failed"
                                                onclick="return confirm('Tolak transaksi ini?')"
                                                class="w-8 h-8 rounded-lg border border-rose-200 bg-rose-50/40 text-rose-600 inline-flex items-center justify-center transition-all active:scale-[0.95] hover:bg-rose-50 cursor-pointer"
                                                title="Tolak Pembayaran">

                                                <i class="fa-solid fa-user-xmark text-[11px]"></i>

                                            </button>
                                        </form>
                                    @else
                                        <div
                                            class="text-center text-[11px] text-slate-400 italic bg-slate-50 py-1 rounded-md border border-slate-100">
                                            Terverifikasi
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-12 text-center text-slate-400 font-medium">Tidak ada data
                                    transaksi pembayaran yang sesuai.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- MOBILE RESPONSIVE CARD VIEW -->
            <div class="block md:hidden divide-y divide-slate-100 w-full">
                @forelse($payments as $pay)
                    <div class="p-4 space-y-3.5 bg-white">
                        <div class="flex items-center justify-between gap-2">
                            <div>
                                <h4 class="text-[13px] font-medium text-slate-800 tracking-tight">
                                    {{ $pay->payment_code }}</h4>
                                <p class="text-[11px] text-slate-400 font-medium mt-0.5">
                                    {{ $pay->created_at->format('d/m/Y, H:i') }} WIB</p>
                            </div>
                            @if ($pay->status === 'pending')
                                <span
                                    class="inline-block px-2.5 py-0.5 text-[9.5px] font-medium bg-amber-50 text-amber-600 border border-amber-200/50 rounded-full">PENDING</span>
                            @elseif($pay->status === 'success')
                                <span
                                    class="inline-block px-2.5 py-0.5 text-[9.5px] font-medium bg-emerald-50 text-emerald-600 border border-emerald-200/50 rounded-full">APPROVED</span>
                            @else
                                <span
                                    class="inline-block px-2.5 py-0.5 text-[9.5px] font-medium bg-rose-50 text-rose-600 border border-rose-200/50 rounded-full">REJECTED</span>
                            @endif
                        </div>

                        <div
                            class="bg-slate-50/60 rounded-xl px-3.5 py-2.5 border border-slate-200/30 space-y-2 text-xs">
                            <div class="flex justify-between">
                                <span class="text-slate-400">Pelanggan:</span>
                                <span
                                    class="font-medium text-slate-700">{{ $pay->reservation->user->name ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-400">Reservasi:</span>
                                <span class="font-medium text-slate-700">Meja
                                    {{ $pay->reservation->table->table_number ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-400">Nominal Transfer:</span>
                                <span class="font-medium text-indigo-600">Rp
                                    {{ number_format($pay->amount, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pt-0.5">
                            <a href="{{ asset('storage/' . $pay->proof_of_payment) }}" target="_blank"
                                class="h-8 px-3 bg-blue-50 text-blue-600 border border-blue-200/60 text-[11px] font-medium rounded-lg flex items-center justify-center gap-1.5 active:scale-95">
                                <i class="fa-solid fa-image"></i> Lihat Bukti Transfer
                            </a>

                            @if ($pay->status === 'pending')
                                <form action="{{ route('admin.payments.verify', $pay->id) }}" method="POST"
                                    class="flex items-center gap-1.5 m-0 w-full sm:w-auto">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" name="status" value="success"
                                        class="h-8 px-3 bg-emerald-600 text-white text-[11px] font-medium rounded-lg active:scale-95">
                                        ACC
                                    </button>
                                    <button type="submit" name="status" value="failed"
                                        class="h-8 w-8 bg-rose-600 text-white rounded-lg flex items-center justify-center text-xs active:scale-95">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </form>
                            @else
                                <div
                                    class="text-right text-[11px] text-slate-400 italic bg-slate-50 px-3 py-1.5 rounded-lg border border-slate-100 w-full">
                                    Terverifikasi
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="bg-white py-10 text-center px-4 border-t border-slate-100">
                        <p class="text-[12px] font-medium text-slate-400">Tidak ada pengajuan berkas transaksi
                            pembayaran aktif.</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Pagination (jika diaktifkan di Controller) --}}
        @if (method_exists($payments, 'hasPages') && $payments->hasPages())
            <div class="p-2">
                {{ $payments->appends(['status' => $status])->links() }}
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
