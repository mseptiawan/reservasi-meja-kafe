@props(['title', 'subtitle' => null, 'backRoute' => null, 'backTitle' => 'Kembali'])

<div class="flex items-start gap-3">
    @if ($backRoute)
        <a href="{{ $backRoute }}"
            class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-slate-500 hover:text-slate-800 bg-white border border-slate-200/60 shadow-xs active:scale-95 transition-all duration-150 mt-1"
            title="{{ $backTitle }}">
            <i class="fa-solid fa-arrow-left text-[11px]"></i>
        </a>
    @endif

    <div class="flex flex-col gap-0.5">
        @if ($slot->isNotEmpty())
            <div class="mb-0.5">
                {{ $slot }}
            </div>
        @endif

        <h2 class="font-medium text-xl text-slate-800 leading-tight">
            {{ $title }}
        </h2>

        @if ($subtitle)
            <p class="text-[11px] text-slate-400 mt-0.5">{{ $subtitle }}</p>
        @endif
    </div>
</div>
