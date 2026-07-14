<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <a href="{{ route('reservasi.history') }}" class="w-8 h-8 rounded-lg text-slate-500 hover:text-slate-800 flex items-center justify-center transition-all active:scale-95" title="Kembali ke Riwayat">
                    <i class="fa-solid fa-arrow-left text-xs"></i>
                </a>
                <div>
                    <h3 class="font-medium text-md text-slate-800 leading-tight">
                        {{ __('Detail Struk Reservasi') }}
                    </h3>
                    <p class="text-[11px] text-slate-400 mt-0.5">Nota digital bukti pengajuan tempat duduk di Senja Space</p>
                </div>
            </div>
        </div>
    </x-slot>
    <div class="max-w-xl mx-auto bg-white border border-slate-200 rounded-xl overflow-hidden ">

        <div class="p-4 bg-slate-50/70 border-b border-slate-200/50 flex items-start gap-2.5">
            <div class="mt-0.5 shrink-0 text-slate-400">
                <i class="fa-solid fa-circle-info text-xs"></i>
            </div>
            <div class="flex-1">
                <p class="text-xs text-slate-600 font-medium leading-relaxed">
                    <span class="font-bold text-slate-700">Status: Menunggu Verifikasi.</span> Permintaan Anda sedang masuk dalam antrean pengecekan ketersediaan meja secara fisik oleh pihak manajemen Senja Space.
                </p>
            </div>
        </div>

        <div class="p-6 space-y-4 text-xs text-slate-600">
            <div class="flex justify-between items-center border-b border-dashed border-slate-200 pb-3">
                <div>
                    <h3 class="font-medium text-slate-800 text-sm">SENJA SPACE CAFE</h3>
                    <p class="text-[10px] text-slate-400 mt-0.5">Kode Booking:
                    <p class="text-slate-700">{{ $reservation->reservation_code }}</p>
                    </p>
                </div>
                <div class="text-right text-[10px] text-slate-400">
                    <p>Diajukan pada:</p>
                    <p class="font-medium text-slate-600">{{ $reservation->created_at->format('d M Y, H:i') }}</p>
                </div>
            </div>

            <div class="space-y-2.5">
                <div class="flex justify-between"><span class="text-slate-400">Nama Pelanggan</span>
                    <p class="text-slate-800">{{ $reservation->user->name }}</p>
                </div>
                <div class="flex justify-between"><span class="text-slate-400">Pilihan Meja</span>
                    <p class="text-slate-800">Meja {{ $reservation->table->table_number }} (Area {{ $reservation->table->area }})</p>
                </div>
                <div class="flex justify-between"><span class="text-slate-400">Tanggal Kunjungan</span>
                    <p class="text-slate-800">{{ date('d F Y', strtotime($reservation->reservation_date)) }}</p>
                </div>
                <div class="flex justify-between"><span class="text-slate-400">Durasi Waktu</span>
                    <p class="text-slate-800">{{ date('H:i', strtotime($reservation->start_time)) }} - {{ date('H:i', strtotime($reservation->end_time)) }} WIB</p>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-400">Jumlah Orang</span>
                    <p class="text-slate-800">{{ $reservation->guests_count }} Kursi</p>
                </div>
            </div>

            <div class="bg-slate-50 rounded-lg p-3 border border-slate-100 mt-2">
                <span class="block text-[10px] font-medium text-slate-400 uppercase tracking-wider mb-1">Catatan Anda:</span>
                <p class="italic text-slate-600">{{ $reservation->notes ?? 'Tidak ada catatan tambahan.' }}</p>
            </div>

        </div>

    </div>
</x-app-layout>