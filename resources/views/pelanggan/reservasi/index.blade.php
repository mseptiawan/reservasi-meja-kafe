<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-medium text-xl text-slate-800 leading-tight">
                {{ __('Pilih Meja Kafe') }}
            </h2>
            <p class="text-[11px] text-slate-400 mt-1">Silahkan pilih nomor meja favoritmu yang tersedia di Senja Space
            </p>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        @forelse($tables as $table)
            <div
                class="bg-white rounded-lg border border-slate-200/60 overflow-hidden flex flex-col justify-between shadow-sm">

                <div>
                    <div class="relative h-44 bg-slate-50 overflow-hidden border-b border-slate-100">
                        @if ($table->image)
                            <img src="{{ asset('storage/' . $table->image) }}" alt="Meja {{ $table->table_number }}"
                                class="w-full h-full object-cover">
                        @else
                            <div
                                class="w-full h-full flex flex-col items-center justify-center text-slate-300 bg-slate-50">
                                <i class="fa-solid fa-chair text-3xl"></i>
                                <span class="text-[9px] uppercase font-medium mt-1.5 tracking-wider">No Image</span>
                            </div>
                        @endif

                        <span
                            class="absolute top-3 left-3 px-2 py-0.5 text-[10px] font-medium text-white bg-slate-900/70 backdrop-blur-sm rounded-md uppercase tracking-wider">
                            {{ $table->area }}
                        </span>
                    </div>

                    <div class="p-4">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="font-medium text-sm text-slate-800">Meja {{ $table->table_number }}</h3>
                            <span class="flex items-center gap-1 text-[11px] font-medium text-slate-600">
                                <i class="fa-solid fa-users text-slate-400"></i> {{ $table->capacity }} Kursi
                            </span>
                        </div>
                        <p class="text-[11px] text-slate-400 leading-relaxed line-clamp-2">
                            {{ $table->description ?? 'Nikmati suasana santai terbaik di sudut Senja Space.' }}
                        </p>
                    </div>
                </div>

                <div class="px-4 py-3 border-t border-slate-100 bg-slate-50/50">
                    @if ($table->status === 'available')
                        <a href="{{ route('reservasi.create', $table->id) }}"
                            class="block w-full text-center py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium text-xs rounded-lg transition-colors">
                            Booking Meja Ini
                        </a>
                    @elseif($table->status === 'reserved' || $table->status === 'occupied')
                        <button disabled
                            class="w-full py-2 bg-amber-100 text-amber-600 font-medium text-xs rounded-lg cursor-not-allowed border border-amber-200/50 flex items-center justify-center gap-1.5">
                            <i class="fa-solid fa-lock text-[10px]"></i> Sudah Dipesan
                        </button>
                    @else
                        <button disabled
                            class="w-full py-2 bg-rose-50 text-rose-500 font-medium text-xs rounded-lg cursor-not-allowed border border-rose-100 flex items-center justify-center gap-1.5">
                            <i class="fa-solid fa-screwdriver-wrench text-[10px]"></i> Sedang Diperbaiki
                        </button>
                    @endif
                </div>

            </div>
        @empty
            <div class="col-span-full bg-white rounded-lg border border-slate-200/60 p-10 text-center">
                <p class="text-xs text-slate-400">Maaf, saat ini belum ada meja kafe yang dikonfigurasi aktif oleh
                    admin.</p>
            </div>
        @endforelse
    </div>
</x-app-layout>
