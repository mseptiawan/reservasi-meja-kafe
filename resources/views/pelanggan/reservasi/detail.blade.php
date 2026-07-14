<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">
            {{ __('Detail Struk Reservasi') }}
        </h2>
    </x-slot>

    <div class="max-w-xl mx-auto bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm">
        
        <!-- Status Banner -->
        <div class="p-4 bg-amber-50 border-b border-amber-100 text-center flex flex-col items-center justify-center">
            <span class="px-2.5 py-0.5 text-[10px] font-bold bg-amber-500 text-white rounded-full uppercase tracking-wider mb-1">PENDING</span>
            <p class="text-xs text-amber-700 font-medium">Menunggu verifikasi ketersediaan meja oleh pihak Admin Senja Space.</p>
        </div>

        <!-- Isi Dokumen Nota -->
        <div class="p-6 space-y-4 text-xs text-slate-600">
            <div class="flex justify-between items-center border-b border-dashed border-slate-200 pb-3">
                <div>
                    <h3 class="font-bold text-slate-800 text-sm">SENJA SPACE CAFE</h3>
                    <p class="text-[10px] text-slate-400 mt-0.5">Kode Booking: <strong class="text-slate-700">{{ $reservation->reservation_code }}</strong></p>
                </div>
                <div class="text-right text-[10px] text-slate-400">
                    <p>Diajukan pada:</p>
                    <p class="font-medium text-slate-600">{{ $reservation->created_at->format('d M Y, H:i') }}</p>
                </div>
            </div>

            <!-- Rincian Data Booking -->
            <div class="space-y-2.5">
                <div class="flex justify-between"><span class="text-slate-400">Nama Pelanggan</span><strong class="text-slate-800">{{ $reservation->user->name }}</strong></div>
                <div class="flex justify-between"><span class="text-slate-400">Pilihan Meja</span><strong class="text-slate-800">Meja {{ $reservation->table->table_number }} (Area {{ $reservation->table->area }})</strong></div>
                <div class="flex justify-between"><span class="text-slate-400">Tanggal Kunjungan</span><strong class="text-slate-800">{{ date('d F Y', strtotime($reservation->reservation_date)) }}</strong></div>
                <div class="flex justify-between"><span class="text-slate-400">Durasi Waktu</span><strong class="text-slate-800">{{ date('H:i', strtotime($reservation->start_time)) }} - {{ date('H:i', strtotime($reservation->end_time)) }} WIB</strong></div>
                <div class="flex justify-between">
    <span class="text-slate-400">Jumlah Orang</span>
    <strong class="text-slate-800">{{ $reservation->guests_count }} Kursi</strong>
</div>
            </div>

            <!-- Kolom Catatan -->
            <div class="bg-slate-50 rounded-lg p-3 border border-slate-100 mt-2">
                <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Catatan Anda:</span>
                <p class="italic text-slate-600">{{ $reservation->notes ?? 'Tidak ada catatan tambahan.' }}</p>
            </div>

            <!-- Tombol Kembali -->
            <div class="pt-4 border-t border-slate-100 flex items-center justify-center">
                <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-slate-800 hover:bg-slate-900 text-white rounded-lg font-semibold text-xs tracking-wide transition-colors">
                    Kembali ke Dashboard
                </a>
            </div>
        </div>

    </div>
</x-app-layout>