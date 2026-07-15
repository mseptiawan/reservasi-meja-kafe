<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-medium text-xl text-slate-800 leading-tight">
                {{ __('Data Meja & Kursi') }}
            </h2>
            <p class="text-[11px] text-slate-400 mt-1">Kelola ketersediaan, kapasitas, dan tata letak meja di Senja Space
            </p>
        </div>
    </x-slot>

    <!-- Baris Kontrol di Bawah Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-5">

        <div class="flex flex-wrap items-center gap-2">
            <!-- TOMBOL SEMUA MEJA -->
            <a href="{{ route('admin.tables.index', ['area' => 'all']) }}"
                class="inline-flex items-center gap-2 px-4 py-2 text-xs font-medium rounded-xl border transition-all duration-200 
        {{ !$selectedArea || $selectedArea === 'all'
            ? 'bg-slate-950 text-white border-slate-950 shadow-sm shadow-slate-950/10'
            : 'bg-white text-slate-600 border-slate-200/80 hover:bg-slate-50 hover:text-slate-900' }}">
                <span>Semua Meja</span>
                <span
                    class="inline-flex items-center justify-center px-2 py-0.5 text-[10px] font-bold rounded-md tracking-wide
            {{ !$selectedArea || $selectedArea === 'all' ? 'bg-white/15 text-white' : 'bg-slate-100 text-slate-500' }}">
                    {{ \App\Models\Table::count() }}
                </span>
            </a>

            <!-- LOOPING FILTER AREA -->
            @foreach ($availableAreas as $area)
                @php
                    $countArea = \App\Models\Table::where('area', $area)->count();
                @endphp
                <a href="{{ route('admin.tables.index', ['area' => $area]) }}"
                    class="inline-flex items-center gap-2 px-4 py-2 text-xs font-medium rounded-xl border transition-all duration-200 
            {{ $selectedArea === $area
                ? 'bg-blue-600 text-white border-blue-600 shadow-sm shadow-blue-600/10'
                : 'bg-white text-slate-600 border-slate-200/80 hover:bg-slate-50 hover:text-slate-900' }}">
                    <span>{{ $area }}</span>
                    <span
                        class="inline-flex items-center justify-center px-2 py-0.5 text-[10px] font-bold rounded-md tracking-wide
                {{ $selectedArea === $area ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-500' }}">
                        {{ $countArea }}
                    </span>
                </a>
            @endforeach
        </div>

        <!-- SISI KANAN: Tombol Tambah Meja -->
        <a href="{{ route('admin.tables.create') }}"
            class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs rounded-lg transition-all duration-150 self-start sm:self-auto">
            <i class="fa-solid fa-plus text-[10px]"></i>
            Tambah Meja
        </a>
    </div>

    @if ($selectedArea && $selectedArea !== 'all')
        <div class="text-[11px] text-slate-500 font-medium mb-3">
            Menampilkan filter area: <span class="text-slate-800 font-medium">"{{ $selectedArea }}"</span>
            ({{ $tables->count() }} Meja ditemukan)
        </div>
    @endif

    <!-- Notifikasi Sukses -->
    @if (session('success'))
        <div
            class="mb-5 p-3.5 bg-emerald-50 border border-emerald-100 text-emerald-600 text-xs rounded-xl flex items-center gap-3">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        @forelse($tables as $table)
            <div class="bg-white rounded-lg border border-slate-200/60 overflow-hidden flex flex-col justify-between">

                <div>
                    <div class="relative h-48 bg-slate-50 overflow-hidden border-b border-slate-100">
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

                        <!-- Badge Status -->
                        <div class="absolute top-3 right-3">
                            @php
                                $statusClasses = [
                                    'available' => 'bg-emerald-50 text-emerald-600 border border-emerald-100/80',
                                    'reserved' => 'bg-amber-50 text-amber-600 border border-amber-100/80',
                                    'occupied' => 'bg-blue-50 text-blue-600 border border-blue-100/80',
                                    'maintenance' => 'bg-rose-50 text-rose-600 border border-rose-100/80',
                                ];
                                $statusLabels = [
                                    'available' => 'Tersedia',
                                    'reserved' => 'Dipesan',
                                    'occupied' => 'Terisi',
                                    'maintenance' => 'Perbaikan',
                                ];
                            @endphp
                            <span
                                class="px-2.5 py-1 text-[9px] font-medium uppercase rounded-lg tracking-wider border {{ $statusClasses[$table->status] }}">
                                {{ $statusLabels[$table->status] }}
                            </span>
                        </div>
                    </div>

                    <div class="p-4">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="font-medium text-sm text-slate-800">Meja {{ $table->table_number }}</h3>
                            <span
                                class="px-2 py-0.5 text-[10px] font-medium text-slate-500 bg-slate-50 border border-slate-200/50 rounded-md">
                                {{ $table->area }}
                            </span>
                        </div>

                        <div class="flex flex-wrap gap-x-3 gap-y-1 text-[11px] text-slate-500 mb-2">
                            <div class="flex items-center gap-1">
                                <i class="fa-solid fa-users text-slate-400 text-[10px]"></i>
                                <span>Kapasitas: <strong class="text-slate-700">{{ $table->capacity }}
                                        Kursi</strong></span>
                            </div>
                            <div class="flex items-center gap-1">
                                <i
                                    class="fa-solid fa-toggle-on text-[10px] {{ $table->is_active ? 'text-emerald-500' : 'text-slate-300' }}"></i>
                                <span>Aktif: <strong
                                        class="text-slate-700">{{ $table->is_active ? 'Ya' : 'Tidak' }}</strong></span>
                            </div>
                        </div>

                        <p class="text-[11px] text-slate-400 leading-relaxed line-clamp-2">
                            {{ $table->description ?? 'Tidak ada deskripsi tambahan.' }}
                        </p>
                    </div>
                </div>

                <div class="px-4 py-3 border-t border-slate-100 bg-slate-50/50 flex items-center justify-end gap-1.5">
                    <!-- Tombol Edit -->
                    <a href="{{ route('admin.tables.edit', $table->id) }}"
                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-white hover:bg-slate-100 border border-slate-200 text-slate-500 hover:text-slate-800 transition-colors"
                        title="Edit">
                        <i class="fa-solid fa-pen-to-square text-[10px]"></i>
                    </a>

                    <!-- Tombol Hapus -->
                    <form action="{{ route('admin.tables.destroy', $table->id) }}" method="POST"
                        class="delete-form inline-block m-0">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-white hover:bg-rose-50 border border-slate-200 hover:border-rose-100 text-slate-400 hover:text-rose-600 transition-colors"
                            title="Hapus">
                            <i class="fa-solid fa-trash-can text-[10px]"></i>
                        </button>
                    </form>
                </div>

            </div>
        @empty
            <div
                class="col-span-full bg-white rounded-2xl border border-slate-200/60 p-10 text-center flex flex-col items-center justify-center">
                <div
                    class="w-12 h-12 rounded-xl bg-slate-50 flex items-center justify-center text-slate-300 mb-3 border border-slate-100">
                    <i class="fa-solid fa-chair text-lg"></i>
                </div>
                <h3 class="font-medium text-slate-700 text-sm">Belum ada data meja</h3>
                <p class="text-[11px] text-slate-400 mt-0.5 max-w-xs leading-relaxed">Mulai menambahkan meja baru di
                    kafe kamu dengan menekan tombol 'Tambah Meja Baru'.</p>
            </div>
        @endforelse
    </div>
</x-app-layout>
