<x-app-layout>
    <x-slot name="header">
        <div class="border-b border-slate-100 pb-5 md:border-none md:pb-0">
            <!-- Mengubah istilah Struk/Nota menjadi Tiket agar lebih relevan dengan isi halaman -->
            <x-page-header title="Detail Tiket Reservasi"
                subtitle="Tiket digital bukti pengajuan tempat duduk di PesanMeja" :backRoute="route('reservasi.history')"
                backTitle="Kembali ke Riwayat">
                <span class="text-[10px] font-medium uppercase tracking-wider text-indigo-500 block">
                    Layanan / Reservasi
                </span>
            </x-page-header>
        </div>
    </x-slot>
    <div class="max-w-xl mx-auto bg-white border border-slate-200 rounded-xl overflow-hidden ">
        <div class="p-4 bg-slate-50/70 border-b border-slate-200/50 flex items-start gap-2.5">
            <div class="mt-0.5 shrink-0 text-slate-400">
                <i class="fa-solid fa-circle-info text-xs"></i>
            </div>
            <div class="flex-1">
                <span class="block text-xs font-bold text-slate-700 leading-none mb-1">
                    Status: Menunggu Verifikasi
                </span>
                <p class="text-[11px] text-slate-500 font-normal leading-relaxed">
                    Permintaan Anda sedang masuk dalam antrean pengecekan ketersediaan meja secara fisik oleh pihak
                    manajemen PesanMeja.
                </p>
            </div>
        </div>

        <div class="p-6 space-y-4 text-xs text-slate-600">
            <div class="flex justify-between items-center border-b border-dashed border-slate-200 pb-3">
                <div>
                    <h3 class="font-medium text-slate-800 text-sm">PesanMeja CAFE</h3>
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
                    <p class="text-slate-800">Meja {{ $reservation->table->table_number }} (Area
                        {{ $reservation->table->area }})</p>
                </div>
                <div class="flex justify-between"><span class="text-slate-400">Tanggal Kunjungan</span>
                    <p class="text-slate-800">{{ date('d F Y', strtotime($reservation->reservation_date)) }}</p>
                </div>
                <div class="flex justify-between"><span class="text-slate-400">Durasi Waktu</span>
                    <p class="text-slate-800">{{ date('H:i', strtotime($reservation->start_time)) }} -
                        {{ date('H:i', strtotime($reservation->end_time)) }} WIB</p>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-400">Jumlah Orang</span>
                    <p class="text-slate-800">{{ $reservation->guests_count }} Kursi</p>
                </div>
            </div>

            <div class="bg-slate-50 rounded-lg p-3 border border-slate-100 mt-2">
                <span class="block text-[10px] font-medium text-slate-400 uppercase tracking-wider mb-1">Catatan
                    Anda:</span>
                <p class="italic text-slate-600">{{ $reservation->notes ?? 'Tidak ada catatan tambahan.' }}</p>
            </div>

        </div>

    </div>
</x-app-layout>
