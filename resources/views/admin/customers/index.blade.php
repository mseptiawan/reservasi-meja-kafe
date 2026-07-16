<x-app-layout>
    <div class="w-full max-w-none mx-auto space-y-5 md:space-y-8">

        <!-- PAGE HEADER -->
        <x-slot name="headerTitle">Pelanggan Aktif</x-slot>

        <x-slot name="header">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 border-b border-slate-100 pb-5 md:border-none md:pb-0">
                <!-- Komponen Page Header (Sisi Kiri) -->
                <x-page-header title="Daftar Pelanggan Aktif"
                    subtitle="Daftar seluruh pelanggan Senja Space yang berstatus aktif dan terverifikasi">
                    <span class="text-[10px] font-medium uppercase tracking-wider text-indigo-500 block">
                        Area Kerja / Keanggotaan
                    </span>
                </x-page-header>

                <!-- Search Bar Compact (Sisi Kanan) -->
                <form action="{{ route('admin.customers.index') }}" method="GET" class="w-full md:w-72 m-0 flex gap-2 shrink-0">
                    <div class="relative w-full">
                        <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama, email, atau kode..."
                            class="w-full h-9 pl-8 pr-3 text-xs bg-white border border-slate-200 rounded-lg outline-none focus:border-indigo-500 text-slate-700 placeholder-slate-400 transition-colors">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                            <i class="fa-solid fa-magnifying-glass text-[11px]"></i>
                        </div>
                    </div>
                    @if($search)
                    <a href="{{ route('admin.customers.index') }}" class="h-9 px-2.5 bg-slate-100 text-slate-500 hover:text-slate-700 rounded-lg flex items-center justify-center text-xs border border-slate-200 transition-colors shrink-0">
                        Reset
                    </a>
                    @endif
                </form>
            </div>
        </x-slot>
        <div class="bg-white rounded-2xl overflow-hidden w-full border border-slate-200/50">

            <!-- DESKTOP TABLE VIEW -->
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-left border-collapse text-[13px]">
                    <thead>
                        <tr class="bg-slate-50/70 border-b border-slate-200/50 text-[11px] font-semibold text-slate-400 uppercase tracking-wider select-none">
                            <th class="py-4 px-6">Pelanggan</th>
                            <th class="py-4 px-6">Kontak WhatsApp</th>
                            <th class="py-4 px-6">Kode Customer</th>
                            <th class="py-4 px-6">Tanggal Bergabung</th>
                            <th class="py-4 px-6 text-center">Status Akses</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white font-medium text-slate-600">
                        @forelse($customers as $customer)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="py-4 px-6">
                                <span class="font-semibold text-slate-800 block text-[13px]">{{ $customer->name }}</span>
                                <span class="text-[10px] font-medium text-slate-400 inline-block mt-0.5">{{ $customer->email }}</span>
                            </td>
                            <td class="py-4 px-6 font-medium text-slate-500">
                                <div class="flex items-center gap-1.5">
                                    <i class="fa-solid fa-phone text-slate-400 text-[10px]"></i>
                                    {{ $customer->phone_number ?? '-' }}
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="text-[10px] font-mono font-semibold bg-indigo-50 border border-indigo-100 text-indigo-600 px-1.5 py-0.5 rounded-md inline-block">
                                    {{ $customer->customer_code ?? '-' }}
                                </span>
                            </td>
                            <td class="py-4 px-6 font-medium text-slate-500">
                                {{ $customer->created_at->translatedFormat('d M Y') }}
                            </td>
                            <td class="py-4 px-6 text-center select-none">
                                <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-medium tracking-wide border bg-emerald-50 text-emerald-600 border-emerald-200/50">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    <span>AKTIF</span>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-slate-400 font-medium">Tidak ada data pelanggan aktif ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- MOBILE RESPONSIVE CARD VIEW -->
            <div class="block md:hidden divide-y divide-slate-100 w-full">
                @forelse($customers as $customer)
                <div class="p-4 space-y-3 bg-white">
                    <div class="flex items-center justify-between gap-2">
                        <div>
                            <h4 class="text-[13px] font-semibold text-slate-800 tracking-tight">{{ $customer->name }}</h4>
                            <p class="text-[11px] text-slate-400 font-medium mt-0.5">{{ $customer->email }}</p>
                        </div>
                        <div class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[9.5px] font-medium tracking-wider border shrink-0 bg-emerald-50 text-emerald-600 border-emerald-200/50">
                            <span class="w-1 h-1 rounded-full bg-emerald-500"></span>
                            <span>AKTIF</span>
                        </div>
                    </div>

                    <div class="bg-slate-50/60 rounded-xl px-3.5 py-2.5 border border-slate-200/30 grid grid-cols-2 gap-2 text-xs">
                        <div>
                            <p class="text-[10px] font-medium text-slate-400 uppercase tracking-wide">Nomor Kontak</p>
                            <p class="text-[12px] font-semibold text-slate-700 mt-0.5 truncate">{{ $customer->phone_number ?? '-' }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-[10px] font-medium text-slate-400 uppercase tracking-wide">Kode Customer</p>
                            <p class="text-[11px] font-mono font-semibold text-indigo-600 mt-0.5">{{ $customer->customer_code ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="text-[11px] font-medium text-slate-400 pt-0.5">
                        <i class="fa-solid fa-calendar mr-1"></i>Bergabung: {{ $customer->created_at->format('d/m/Y') }}
                    </div>
                </div>
                @empty
                <div class="bg-white border-t border-slate-100 py-10 text-center px-4">
                    <p class="text-[12px] font-medium text-slate-400">Tidak ada data pelanggan aktif.</p>
                </div>
                @endforelse
            </div>

        </div>

        <!-- Pagination -->
        @if($customers->hasPages())
        <div class="p-2">
            {{ $customers->appends(['search' => $search])->links() }}
        </div>
        @endif

    </div>
</x-app-layout>