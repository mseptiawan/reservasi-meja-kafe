<x-app-layout>
    <div class="w-full  mx-auto space-y-8 px-4 py-8">

        <!-- WELCOME BANNER -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-slate-100 pb-6">
            <div>
                <span class="text-[10px] font-semibold uppercase tracking-wider text-blue-600">Ringkasan Sistem</span>
                <h2 class="font-medium text-xl text-slate-800 leading-tight mt-0.5">
                    Selamat Datang Kembali, {{ Auth::user()->name }}!
                </h2>
                <p class="text-[11px] text-slate-400 mt-0.5">Berikut adalah pantauan aktivitas dan informasi terbaru hari
                    ini.</p>
            </div>
            @if (Auth::user()->role === 'pelanggan')
                <a href="{{ route('reservasi.index') }}"
                    class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold text-xs uppercase tracking-wider transition duration-150  cursor-pointer">
                    <i class="fa-solid fa-chair mr-2 text-xs"></i> Buat Reservasi Meja
                </a>
            @endif
        </div>

        @if (Auth::user()->role === 'admin')
            <!-- ============================================== -->
            <!--                 VIEW UNTUK ADMIN               -->
            <!-- ============================================== -->

            <!-- STAT CARDS GRID -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Card 1: Verifikasi User -->
                <div class="bg-white p-5 border border-slate-200 rounded-2xl  flex items-center justify-between">
                    <div class="space-y-1">
                        <p class="text-[11px] font-medium text-slate-400 uppercase tracking-wider">Verifikasi Akun</p>
                        <h4 class="text-2xl font-medium text-slate-800">{{ $stats['pending_users'] }}</h4>
                        <p class="text-[10px] text-slate-400">Menunggu disetujui</p>
                    </div>
                    <div
                        class="w-12 h-12 rounded-xl bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-600">
                        <i class="fa-solid fa-user-clock text-lg"></i>
                    </div>
                </div>

                <!-- Card 2: Reservasi Pending -->
                <div class="bg-white p-5 border border-slate-200 rounded-2xl  flex items-center justify-between">
                    <div class="space-y-1">
                        <p class="text-[11px] font-medium text-slate-400 uppercase tracking-wider">Reservasi Baru</p>
                        <h4 class="text-2xl font-medium text-slate-800">{{ $stats['pending_reservations'] }}</h4>
                        <p class="text-[10px] text-slate-400">Butuh konfirmasi</p>
                    </div>
                    <div
                        class="w-12 h-12 rounded-xl bg-blue-50 border border-blue-100 flex items-center justify-center text-blue-600">
                        <i class="fa-solid fa-calendar-day text-lg"></i>
                    </div>
                </div>

                <!-- Card 3: Pembayaran Masuk -->
                <div class="bg-white p-5 border border-slate-200 rounded-2xl  flex items-center justify-between">
                    <div class="space-y-1">
                        <p class="text-[11px] font-medium text-slate-400 uppercase tracking-wider">Verifikasi Bayar</p>
                        <h4 class="text-2xl font-medium text-slate-800">{{ $stats['pending_payments'] }}</h4>
                        <p class="text-[10px] text-slate-400">Menunggu cek admin</p>
                    </div>
                    <div
                        class="w-12 h-12 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-600">
                        <i class="fa-solid fa-file-invoice-dollar text-lg"></i>
                    </div>
                </div>

                <!-- Card 4: Total Pelanggan -->
                <div class="bg-white p-5 border border-slate-200 rounded-2xl  flex items-center justify-between">
                    <div class="space-y-1">
                        <p class="text-[11px] font-medium text-slate-400 uppercase tracking-wider">Total Pelanggan</p>
                        <h4 class="text-2xl font-medium text-slate-800">{{ $stats['total_customers'] }}</h4>
                        <p class="text-[10px] text-slate-400">Terdaftar di sistem</p>
                    </div>
                    <div
                        class="w-12 h-12 rounded-xl bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-600">
                        <i class="fa-solid fa-users text-lg"></i>
                    </div>
                </div>
            </div>

            <!-- ADMIN DETAILS GRID -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left: Reservasi Terbaru -->
                <div class="lg:col-span-2 bg-white p-6 border border-slate-200 rounded-2xl  space-y-4">
                    <div class="border-b border-slate-100 pb-3 flex justify-between items-center">
                        <h3 class="font-semibold text-slate-800 text-sm">Reservasi Terbaru</h3>
                        <a href="{{ route('admin.reservations.index') }}"
                            class="text-xs font-semibold text-blue-600 hover:underline">Lihat Semua</a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse text-xs">
                            <thead>
                                <tr class="text-slate-400 border-b border-slate-100">
                                    <th class="pb-3 font-semibold">Pelanggan</th>
                                    <th class="pb-3 font-semibold">Status</th>
                                    <th class="pb-3 font-semibold">Waktu</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @forelse($recentReservations as $res)
                                    <tr>
                                        <td class="py-3 font-medium text-slate-700">{{ $res->user->name ?? 'User' }}
                                        </td>
                                        <td class="py-3">
                                            <span
                                                class="px-2 py-0.5 rounded-full text-[10px] font-medium uppercase 
                                                {{ $res->status === 'pending' ? 'bg-amber-50 text-amber-700' : 'bg-emerald-50 text-emerald-700' }}">
                                                {{ $res->status }}
                                            </span>
                                        </td>
                                        <td class="py-3 text-slate-400">{{ $res->created_at->diffForHumans() }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="py-4 text-center text-slate-400">Belum ada reservasi
                                            masuk hari ini.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Right: Kolom Pengumuman (Admin) -->
                @include('partials.announcements-widget')
            </div>
        @else
            <!-- ============================================== -->
            <!--               VIEW UNTUK PELANGGAN             -->
            <!-- ============================================== -->

            @if ($activeReservation)
                <!-- HERO ACTION: TICKET/WAITING PAYMENT BANNER -->
                <div
                    class="p-6 bg-gradient-to-r from-blue-50 to-indigo-50/50 border border-blue-100 rounded-lg flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                    <div class="space-y-1">
                        <span
                            class="px-2.5 py-0.5 bg-blue-100 text-blue-800 rounded-full text-[9px] font-medium uppercase tracking-wider">Aktivitas
                            Berjalan</span>
                        <h3 class="font-semibold text-slate-800 text-sm mt-1">Anda memiliki reservasi yang sedang aktif!
                        </h3>
                        <p class="text-xs text-slate-500">Silakan segera selesaikan verifikasi pembayaran atau cek
                            status reservasi Anda secara berkala.</p>
                    </div>
                    <div class="flex gap-2 shrink-0">
                        <a href="{{ route('payment.confirm') }}"
                            class="px-4 py-2 bg-slate-900 hover:bg-slate-800 text-white rounded-lg text-xs font-semibold  transition">
                            Konfirmasi Pembayaran
                        </a>
                    </div>
                </div>
            @endif

            <!-- CLIENT DETAILS GRID -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left: Riwayat Booking Saya -->
                <div class="lg:col-span-2 bg-white p-6 border border-slate-200 rounded-2xl  space-y-4">
                    <div class="border-b border-slate-100 pb-3 flex justify-between items-center">
                        <h3 class="font-semibold text-slate-800 text-sm">Riwayat Booking Terakhir</h3>
                        <a href="{{ route('reservasi.history') }}"
                            class="text-xs font-semibold text-blue-600 hover:underline">Lihat Semua</a>
                    </div>

                    <div class="space-y-3">
                        @forelse($myRecentBookings as $booking)
                            <div
                                class="flex items-center justify-between p-3 border border-slate-100 rounded-xl hover:bg-slate-50 transition">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600">
                                        <i class="fa-solid fa-receipt text-xs"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold text-slate-800">Booking #{{ $booking->id }}
                                        </p>
                                        <p class="text-[10px] text-slate-400">
                                            {{ $booking->created_at->format('d M Y, H:i') }} WIB</p>
                                    </div>
                                </div>
                                <span
                                    class="px-2 py-0.5 rounded-full text-[9px] font-medium uppercase 
                                    {{ $booking->status === 'pending' ? 'bg-amber-50 text-amber-700' : 'bg-emerald-50 text-emerald-700' }}">
                                    {{ $booking->status }}
                                </span>
                            </div>
                        @empty
                            <div class="text-center py-6 text-slate-400 text-xs">
                                <i class="fa-solid fa-folder-open text-lg mb-2 block"></i>
                                Anda belum memiliki riwayat reservasi.
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Right: Kolom Pengumuman (Pelanggan) -->
                @include('partials.announcements-widget')
            </div>
        @endif

    </div>
</x-app-layout>
