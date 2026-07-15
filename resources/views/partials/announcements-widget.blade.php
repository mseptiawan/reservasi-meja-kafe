<div class="bg-white p-6 border border-slate-200 rounded-2xl shadow-sm space-y-4 h-fit">
    <div class="border-b border-slate-100 pb-3">
        <h3 class="font-semibold text-slate-800 text-sm">Pusat Informasi & Pengumuman</h3>
    </div>
    <div class="space-y-4">
        @forelse($announcements as $announcement)
            <div class="space-y-1">
                <span
                    class="text-[9px] font-bold text-blue-600 uppercase tracking-wider">{{ $announcement->type }}</span>
                <h4 class="text-xs font-semibold text-slate-800 hover:text-blue-600 transition cursor-pointer">
                    {{ $announcement->title }}
                </h4>
                <p class="text-[11px] text-slate-400 line-clamp-2 leading-relaxed">
                    {{ strip_tags($announcement->content) }}
                </p>
                <p class="text-[9px] text-slate-400 pt-1">
                    Dipublikasikan: {{ $announcement->created_at->diffForHumans() }}
                </p>
                <hr class="border-slate-50 pt-2" />
            </div>
        @empty
            <div class="text-center py-6 text-slate-400 text-xs">
                <i class="fa-solid fa-bullhorn text-lg mb-2 block text-slate-300"></i>
                Tidak ada pengumuman terbaru saat ini.
            </div>
        @endforelse
    </div>
</div>
