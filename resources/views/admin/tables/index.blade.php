<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-slate-800 leading-tight">
                    {{ __('Data Meja & Kursi') }}
                </h2>
                <p class="text-xs text-slate-400 mt-1">Kelola ketersediaan, kapasitas, dan tata letak meja di Senja Space</p>
            </div>
            
            <!-- Tombol Tambah Meja -->
            <a href="{{ route('admin.tables.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-xs rounded-xl shadow-md shadow-indigo-100 transition-all duration-150">
                <i class="fa-solid fa-plus text-xs"></i>
                Tambah Meja Baru
            </a>
        </div>
    </x-slot>

    <!-- Notifikasi Sukses -->
    @if(session('success'))
        <div class="mb-4 p-4 bg-emerald-50 border border-emerald-100 text-emerald-600 text-sm rounded-2xl flex items-center gap-3">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($tables as $table)
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden flex flex-col justify-between">
                
                <!-- Gambar & Bagian Atas Card -->
                <div>
                    <div class="relative h-48 bg-slate-100 overflow-hidden">
                        @if($table->image)
                            <img src="{{ asset('storage/' . $table->image) }}" alt="Meja {{ $table->table_number }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-slate-300">
                                <i class="fa-solid fa-chair text-5xl"></i>
                                <span class="text-[10px] uppercase font-semibold mt-2 tracking-wider">No Image Available</span>
                            </div>
                        @endif
                        
                        <!-- Badge Status -->
                        <div class="absolute top-4 right-4">
                            @php
                                $statusClasses = [
                                    'available' => 'bg-emerald-50 text-emerald-600 border border-emerald-100',
                                    'reserved' => 'bg-amber-50 text-amber-600 border border-amber-100',
                                    'occupied' => 'bg-indigo-50 text-indigo-600 border border-indigo-100',
                                    'maintenance' => 'bg-rose-50 text-rose-600 border border-rose-100',
                                ];
                                $statusLabels = [
                                    'available' => 'Tersedia',
                                    'reserved' => 'Dipesan',
                                    'occupied' => 'Terisi',
                                    'maintenance' => 'Perbaikan',
                                ];
                            @endphp
                            <span class="px-3 py-1.5 text-[10px] font-bold uppercase rounded-full tracking-wider {{ $statusClasses[$table->status] }}">
                                {{ $statusLabels[$table->status] }}
                            </span>
                        </div>
                    </div>

                    <!-- Informasi Meja -->
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="font-bold text-lg text-slate-800">Meja {{ $table->table_number }}</h3>
                            <span class="px-2.5 py-1 text-xs font-semibold text-slate-500 bg-slate-50 border border-slate-100 rounded-lg">
                                {{ $table->area }}
                            </span>
                        </div>

                        <div class="flex items-center gap-4 text-xs text-slate-500 mb-4">
                            <div class="flex items-center gap-1.5">
                                <i class="fa-solid fa-users text-slate-400"></i>
                                <span>Kapasitas: <strong>{{ $table->capacity }} Kursi</strong></span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <i class="fa-solid fa-toggle-on {{ $table->is_active ? 'text-emerald-500' : 'text-slate-300' }}"></i>
                                <span>Status Aktif: <strong>{{ $table->is_active ? 'Ya' : 'Tidak' }}</strong></span>
                            </div>
                        </div>

                        <p class="text-xs text-slate-400 leading-relaxed truncate-3-lines">
                            {{ $table->description ?? 'Tidak ada deskripsi tambahan untuk meja ini.' }}
                        </p>
                    </div>
                </div>

                <!-- Bagian Aksi / Tombol Kontrol di Bawah Card -->
                <div class="p-6 pt-0 border-t border-slate-50 mt-4 flex items-center justify-end gap-2">
                    <!-- Tombol Edit -->
                    <a href="{{ route('admin.tables.edit', $table->id) }}" class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-slate-50 hover:bg-slate-100 border border-slate-100 text-slate-500 hover:text-slate-800 transition-colors">
                        <i class="fa-solid fa-pen-to-square text-xs"></i>
                    </a>

                    <!-- Tombol Hapus -->
                    <form action="{{ route('admin.tables.destroy', $table->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus meja ini?');" class="inline-block m-0">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-white hover:bg-rose-50 border border-slate-100 hover:border-rose-100 text-slate-400 hover:text-rose-600 transition-colors">
                            <i class="fa-solid fa-trash-can text-xs"></i>
                        </button>
                    </form>
                </div>

            </div>
        @empty
            <div class="col-span-full bg-white rounded-3xl border border-slate-100 p-12 text-center flex flex-col items-center justify-center">
                <div class="w-16 h-16 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-300 mb-4 border border-slate-100">
                    <i class="fa-solid fa-chair text-2xl"></i>
                </div>
                <h3 class="font-bold text-slate-700 text-base">Belum ada data meja</h3>
                <p class="text-xs text-slate-400 mt-1 max-w-sm leading-relaxed">Mulai menambahkan meja baru di kafe kamu dengan menekan tombol 'Tambah Meja Baru' di kanan atas.</p>
            </div>
        @endforelse
    </div>
</x-app-layout>