<x-app-layout>
    <x-slot name="headerTitle">Formulir Reservasi</x-slot>

    <x-slot name="header">
        <div class="border-b border-slate-100 pb-5 md:border-none md:pb-0">
            <!-- Komponen Page Header dengan tombol kembali -->
            <x-page-header title="Formulir Reservasi Meja"
                subtitle="Silahkan lengkapi data reservasi dan pilih area meja yang tersedia di Senja Space"
                :backRoute="route('reservasi.index')" backTitle="Kembali ke Daftar Reservasi">
                <span class="text-[10px] font-medium uppercase tracking-wider text-indigo-500 block">
                    Layanan / Reservasi
                </span>
            </x-page-header>
        </div>
    </x-slot>
    @if ($existingBookings->isNotEmpty())
        <div class="m-5 p-3.5 bg-amber-50 border border-amber-200 text-amber-800 rounded-lg text-xs">
            <h4 class="font-semibold mb-1.5"><i class="fa-solid fa-calendar-clock mr-1"></i> Jadwal Terisi Untuk Meja Ini:
            </h4>
            <ul class="list-disc pl-4 space-y-1 font-medium">
                @foreach ($existingBookings as $booking)
                    <li>
                        {{ \Carbon\Carbon::parse($booking->reservation_date)->format('d M Y') }} :
                        <span class="underline">{{ substr($booking->start_time, 0, 5) }} -
                            {{ substr($booking->end_time, 0, 5) }} WIB</span>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="max-w-2xl mx-auto bg-white border border-slate-200/60 rounded-xl overflow-hidden shadow-sm">
        <div class="p-5 bg-slate-50 border-b border-slate-100 flex items-center justify-between">
            <div>
                <span class="text-[10px] font-medium text-white bg-blue-600 px-2 py-0.5 rounded uppercase">Meja
                    {{ $table->table_number }}</span>
                <h3 class="font-medium text-sm text-slate-800 mt-1">Area {{ $table->area }}</h3>
            </div>
            <div class="text-right text-xs text-slate-500 font-medium"> Max Kapasitas: <strong
                    class="text-slate-700">{{ $table->capacity }} Kursi</strong> </div>
        </div>

        @if ($errors->any())
            <div class="m-5 p-3 bg-rose-50 border border-rose-200 text-rose-600 text-xs rounded-lg font-medium">
                <ul class="list-disc pl-4 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('reservasi.store') }}" method="POST" class="p-5 space-y-4">
            @csrf
            <input type="hidden" name="table_id" value="{{ $table->id }}">

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Tanggal Kedatangan</label>
                    <input type="date" name="reservation_date" min="{{ date('Y-m-d') }}"
                        value="{{ old('reservation_date') }}" required
                        class="w-full p-2 text-xs border border-slate-200 rounded-lg outline-none focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Jumlah Orang (Tamu)</label>
                    <input type="number" name="guests_count" max="{{ $table->capacity }}" min="1"
                        value="{{ old('guests_count') }}" required
                        class="w-full p-2 text-xs border @error('guests_count') border-rose-400 focus:border-rose-500 @else border-slate-200 focus:border-blue-500 @enderror rounded-lg outline-none">

                    @error('guests_count')
                        <span class="text-[10px] text-rose-500 font-medium mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Jam Mulai</label>
                    <input type="time" name="start_time" value="{{ old('start_time') }}" required
                        class="w-full p-2 text-xs border border-slate-200 rounded-lg outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Jam Selesai</label>
                    <input type="time" name="end_time" value="{{ old('end_time') }}" required
                        class="w-full p-2 text-xs border border-slate-200 rounded-lg outline-none focus:border-blue-500">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">Catatan Tambahan (Opsional)</label>
                <textarea name="notes" rows="3" placeholder="Contoh: Minta pasang lilin ulang tahun..."
                    class="w-full p-2 text-xs border border-slate-200 rounded-lg outline-none focus:border-blue-500">{{ old('notes') }}</textarea>
            </div>

            <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2">
                <a href="{{ route('reservasi.index') }}"
                    class="px-4 py-2 border border-slate-200 text-slate-600 rounded-lg font-semibold text-xs hover:bg-slate-50">Batal</a>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs rounded-lg transition-colors">Ajukan
                    Reservasi</button>
            </div>
        </form>
    </div>
</x-app-layout>
