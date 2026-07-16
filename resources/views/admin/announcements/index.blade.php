<x-app-layout>
    <x-slot name="headerTitle">Pengumuman</x-slot>

    <x-slot name="header">
        <div class="border-b border-slate-100 pb-5 md:border-none md:pb-0">
            <!-- Komponen Page Header -->
            <x-page-header title="Data Pengumuman"
                subtitle="Kelola info internal, promo, event, dan info maintenance Senja Space">
                <span class="text-[10px] font-medium uppercase tracking-wider text-indigo-500 block">
                    Area Kerja / Informasi
                </span>
            </x-page-header>
        </div>
    </x-slot>

    <!-- Baris Kontrol di Bawah Header -->
    <div class="flex items-center justify-between mb-5">
        <div class="text-xs text-slate-500 font-medium">
            Total Pengumuman: <span class="text-slate-800 font-medium">{{ $announcements->count() }} Konten</span>
        </div>

        <a href="{{ route('admin.announcements.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs rounded-lg transition-all duration-150">
            <i class="fa-solid fa-plus text-[10px]"></i>
            Tambah
        </a>
    </div>

    <!-- Notifikasi Sukses -->
    @if(session('success'))
    <div class="mb-5 p-3.5 bg-emerald-50 border border-emerald-100 text-emerald-600 text-xs rounded-xl flex items-center gap-3">
        <i class="fa-solid fa-circle-check"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    <!-- Grid Card Pengumuman -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        @forelse($announcements as $announcement)
        <div class="bg-white rounded-lg border border-slate-200/60 overflow-hidden flex flex-col justify-between">

            <div>
                <!-- Gambar Banner/Thumbnail -->
                <div class="relative h-40 bg-slate-50 overflow-hidden border-b border-slate-100">
                    @if($announcement->image)
                    <img src="{{ \Illuminate\Support\Str::contains($announcement->image, ['http://', 'https://']) ? $announcement->image : asset('storage/' . $announcement->image) }}"
                        alt="{{ $announcement->title }}"
                        class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full flex flex-col items-center justify-center text-slate-300 bg-slate-50">
                        <i class="fa-solid fa-bullhorn text-3xl"></i>
                        <span class="text-[9px] uppercase font-medium mt-1.5 tracking-wider">No Banner</span>
                    </div>
                    @endif

                    <!-- Badge Tipe Pengumuman (Kiri Atas) -->
                    <div class="absolute top-3 left-3">
                        @php
                        $typeClasses = [
                        'info_internal' => 'bg-purple-50 text-purple-600 border-purple-100/80',
                        'promo' => 'bg-emerald-50 text-emerald-600 border-emerald-100/80',
                        'event' => 'bg-indigo-50 text-indigo-600 border-indigo-100/80',
                        'maintenance' => 'bg-rose-50 text-rose-600 border-rose-100/80',
                        'announcement' => 'bg-slate-50 text-slate-600 border-slate-200/80',
                        ];
                        $typeLabels = [
                        'info_internal' => 'Internal',
                        'promo' => 'Promo',
                        'event' => 'Event',
                        'maintenance' => 'Maintenance',
                        'announcement' => 'Umum',
                        ];
                        @endphp
                        <span class="px-2 py-0.5 text-[9px] font-medium uppercase rounded border {{ $typeClasses[$announcement->type] ?? $typeClasses['announcement'] }}">
                            {{ $typeLabels[$announcement->type] ?? $typeLabels['announcement'] }}
                        </span>
                    </div>

                    <!-- Badge Status (Kanan Atas) -->
                    <div class="absolute top-3 right-3">
                        @php
                        $statusClasses = [
                        'draft' => 'bg-slate-100 text-slate-600',
                        'published' => 'bg-blue-600 text-white',
                        'archived' => 'bg-amber-100 text-amber-700',
                        ];
                        @endphp
                        <span class="px-2 py-0.5 text-[9px] font-medium uppercase rounded {{ $statusClasses[$announcement->status] }}">
                            {{ $announcement->status }}
                        </span>
                    </div>
                </div>

                <!-- Informasi Konten -->
                <div class="p-4">
                    <h3 class="font-medium text-sm text-slate-800 line-clamp-1 mb-1" title="{{ $announcement->title }}">
                        {{ $announcement->title }}
                    </h3>

                    <!-- Meta Data Author & Waktu -->
                    <div class="flex items-center gap-x-2 text-[10px] text-slate-400 mb-3 flex-wrap">
                        <div class="flex items-center gap-1">
                            <i class="fa-solid fa-user text-[9px]"></i>
                            <span>{{ $announcement->author->name ?? 'System' }}</span>
                        </div>
                        <span>•</span>
                        <div class="flex items-center gap-1">
                            <i class="fa-solid fa-calendar text-[9px]"></i>
                            <span>{{ $announcement->published_at ? \Carbon\Carbon::parse($announcement->published_at)->format('d M Y') : 'Belum Rilis' }}</span>
                        </div>
                    </div>

                    <p class="text-[11px] text-slate-500 leading-relaxed line-clamp-3">
                        {{ strip_tags($announcement->content) }}
                    </p>
                </div>
            </div>

            <div class="px-4 py-3 border-t border-slate-100 bg-slate-50/50 flex items-center justify-end gap-1.5">
                <!-- Tombol Edit -->
                <a href="{{ route('admin.announcements.edit', $announcement->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-white hover:bg-slate-100 border border-slate-200 text-slate-500 hover:text-slate-800 transition-colors" title="Edit">
                    <i class="fa-solid fa-pen-to-square text-[10px]"></i>
                </a>

                <!-- Tombol Hapus -->
                <form action="{{ route('admin.announcements.destroy', $announcement->id) }}"
                    method="POST"
                    class="delete-form inline-block m-0">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-white hover:bg-rose-50 border border-slate-200 hover:border-rose-100 text-slate-400 hover:text-rose-600 transition-colors" title="Hapus">
                        <i class="fa-solid fa-trash-can text-[10px]"></i>
                    </button>
                </form>
            </div>

        </div>
        @empty
        <div class="col-span-full bg-white rounded-lg border border-slate-200/60 p-10 text-center flex flex-col items-center justify-center">
            <div class="w-12 h-12 rounded-xl bg-slate-50 flex items-center justify-center text-slate-300 mb-3 border border-slate-100">
                <i class="fa-solid fa-bullhorn text-lg"></i>
            </div>
            <h3 class="font-medium text-slate-700 text-sm">Belum ada pengumuman</h3>
            <p class="text-[11px] text-slate-400 mt-0.5 max-w-xs leading-relaxed">Mulai buat info promo, event, atau berita internal pertamamu sekarang.</p>
        </div>
        @endforelse
    </div>
</x-app-layout>