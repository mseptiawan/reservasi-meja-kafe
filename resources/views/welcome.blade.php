<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PesanMeja | Coffee & Workspace Palembang</title>

    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="bg-[#faf9f6] text-[#1c1917] antialiased min-h-screen flex flex-col justify-between selection:bg-blue-600 selection:text-white">

    <!-- HEADER -->
    <header
        class="w-full max-w-7xl mx-auto px-6 py-6 flex items-center justify-between sticky top-0 z-50 bg-[#faf9f6]/80 backdrop-blur-md">
        <div class="flex items-center gap-2">

            <span class="font-semibold tracking-tight text-lg">Pesan <span class="text-blue-600">Meja</span></span>
        </div>

        <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-stone-600">
            <a href="#menu" class="hover:text-blue-600 transition-colors">Menu Andalan</a>
            <a href="#tables" class="hover:text-blue-600 transition-colors">Daftar Meja</a>
            <a href="#announcements" class="hover:text-blue-600 transition-colors">Pengumuman</a>
        </nav>

        <div class="flex items-center gap-3">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="px-5 py-2.5 text-sm font-semibold bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-all duration-200 shadow-md shadow-blue-600/10">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="hidden sm:inline-block px-4 py-2 text-sm font-semibold text-slate-600 hover:text-blue-600 transition-colors">
                        Log in
                    </a>
                @endauth
            @endif
        </div>
    </header>

    <!-- HERO SECTION -->
    <section class="w-full max-w-7xl mx-auto px-6 pt-12 pb-20 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
        <div class="lg:col-span-7 space-y-6">
            <span
                class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-600 border border-blue-100">
                ☕ Freshly Brewed Daily in Palembang
            </span>
            <h1 class="text-4xl sm:text-6xl font-black tracking-tight leading-[1.1] text-slate-800">
                Temukan Sudut Terbaik untuk <span
                    class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-500">Kreativitasmu.</span>
            </h1>
            <p class="text-base sm:text-lg text-stone-500 max-w-xl leading-relaxed">
                Lebih dari sekadar secangkir kopi. PesanMeja menghadirkan suasana tenang dengan fasilitas lengkap, pas
                untuk fokus bekerja, rapat kolaboratif, atau sekadar menikmati sore.
            </p>

            <div class="flex flex-wrap gap-4 pt-2">
                <a href="#tables"
                    class="px-7 py-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl shadow-lg shadow-blue-600/15 hover:shadow-blue-600/25 transition-all duration-150 flex items-center gap-2">
                    <span>Pilih Meja Sekarang</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
                <a href="#menu"
                    class="px-7 py-4 border border-stone-200 hover:bg-stone-50 font-semibold rounded-xl transition-all duration-150">
                    Lihat Menu
                </a>
            </div>

            <div class="pt-8 border-t border-stone-100 grid grid-cols-3 gap-6">
                <div>
                    <p class="text-2xl sm:text-3xl font-extrabold text-blue-600">100%</p>
                    <p class="text-xs text-stone-400 font-medium">Arabica Premium</p>
                </div>
                <div>
                    <p class="text-2xl sm:text-3xl font-extrabold text-slate-800">150+ Mbps</p>
                    <p class="text-xs text-stone-400 font-medium">Ultra-Fast WiFi</p>
                </div>
                <div>
                    <p class="text-2xl sm:text-3xl font-extrabold text-slate-800">3 Area</p>
                    <p class="text-xs text-stone-400 font-medium">Indoor, Semi, & Garden</p>
                </div>
            </div>
        </div>

        <!-- HERO HIGHLIGHT -->
        <div class="lg:col-span-5 relative">
            <span
                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-72 h-72 bg-blue-600 rounded-full filter blur-[120px] opacity-20 pointer-events-none"></span>

            <div
                class="relative bg-white p-8 rounded-3xl border border-stone-100 shadow-2xl shadow-stone-200/50 space-y-6">
                <div class="flex justify-between items-start">
                    <span class="text-xs font-semibold tracking-widest text-blue-600 uppercase">Highlight Of The
                        Week</span>
                    <span class="text-xs font-medium px-2.5 py-1 bg-emerald-500/10 text-emerald-600 rounded-full">Buka
                        Hari Ini</span>
                </div>
                <div
                    class="aspect-[4/3] w-full rounded-2xl p-6 flex flex-col justify-between text-white relative overflow-hidden bg-stone-900">
                    <!-- GAMBAR BEKGRON -->
                    <img src="{{ asset('images/main.jpg') }}" alt="Signature Butterscotch Latte"
                        class="absolute inset-0 w-full h-full object-cover opacity-60" />

                    <!-- GRADIENT OVERLAY (Supaya teks putih tetap terbaca jelas di atas gambar) -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/40 to-black/10"></div>

                    <!-- KONTEN (Gunakan z-10 agar berada di atas gambar dan overlay) -->
                    <span
                        class="relative z-10 bg-white/10 backdrop-blur-md text-[11px] font-medium px-3 py-1.5 rounded-full self-start border border-white/10">
                        ☕ Signature Butterscotch Latte
                    </span>

                    <div class="relative z-10">
                        <p class="text-xs text-stone-300">Rekomendasi Barista</p>
                        <h3 class="text-lg sm:text-xl font-medium mt-0.5">Rasakan Kombinasi Espresso dengan Manisnya
                            Karamel Mentega</h3>
                    </div>
                </div>

                <div class="space-y-3.5 text-sm text-stone-600">
                    <div class="flex items-center gap-3">
                        <span class="p-1.5 rounded-lg bg-stone-100 text-stone-500">📍</span>
                        <span>Jl. Jenderal Sudirman No. 12, Palembang</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="p-1.5 rounded-lg bg-stone-100 text-stone-500">🕒</span>
                        <span>Setiap Hari : 09:00 WIB - 23:00 WIB</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- MENU SECTION -->
    <section id="menu" class="w-full max-w-7xl mx-auto px-6 py-20 border-t border-stone-100">
        <div class="max-w-2xl mb-12">
            <h2 class="text-3xl font-extrabold tracking-tight text-slate-800">Dibuat dengan Dedikasi</h2>
            <p class="text-sm text-stone-500 mt-2">Biji kopi pilihan yang dipanggang sempurna dan diracik oleh barista
                berpengalaman.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-2xl border border-stone-100 shadow-sm">
                <span class="text-2xl">☕</span>
                <h3 class="font-semibold text-slate-800 text-lg mt-4">Espresso Blend</h3>
                <p class="text-xs text-stone-400 mt-1 leading-relaxed">Keseimbangan sempurna rasa cokelat hitam, kacang
                    panggang, dan keasaman buah yang pas.</p>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-stone-100 shadow-sm">
                <span class="text-2xl">🥐</span>
                <h3 class="font-semibold text-slate-800 text-lg mt-4">Artisanal Pastries</h3>
                <p class="text-xs text-stone-400 mt-1 leading-relaxed">Croissant mentega yang renyah di luar dan lembut
                    di dalam, dipanggang segar setiap pagi.</p>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-stone-100 shadow-sm">
                <span class="text-2xl">🍀</span>
                <h3 class="font-semibold text-slate-800 text-lg mt-4">Non-Coffee Selections</h3>
                <p class="text-xs text-stone-400 mt-1 leading-relaxed">Matcha Jepang murni, teh artisan, dan minuman
                    botani segar untuk harimu yang lebih cerah.</p>
            </div>
        </div>
    </section>

    <!-- NEW SECTION: DAFTAR MEJA / WORKSPACE TABLES -->
    <section id="tables" class="w-full max-w-7xl mx-auto px-6 py-20 border-t border-stone-100">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
            <div class="max-w-xl">
                <span class="text-[10px] font-bold uppercase tracking-widest text-blue-600">Pilihan Ruang & Meja</span>
                <h2 class="text-3xl font-extrabold tracking-tight mt-1 text-slate-800">Pilih Tempat Kerja Terbaik Anda
                </h2>
                <p class="text-sm text-stone-500 mt-2">Setiap meja dilengkapi akses terminal listrik stabil dan
                    jangkauan internet WiFi ultra cepat.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($tables as $table)
                <div
                    class="bg-white rounded-2xl border border-slate-200/60 overflow-hidden shadow-sm flex flex-col justify-between hover:border-blue-500/40 hover:shadow-md transition duration-200">

                    <!-- Image Meja -->
                    <div class="aspect-video w-full bg-slate-100 relative">
                        @if ($table->image)
                            <img src="{{ asset('storage/' . $table->image) }}" alt="Meja {{ $table->table_number }}"
                                class="w-full h-full object-cover" />
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-300">
                                <i class="fa-solid fa-chair text-3xl"></i>
                            </div>
                        @endif
                        <span
                            class="absolute top-3 right-3 px-2.5 py-1 text-[9px] font-extrabold uppercase rounded-full shadow-sm
              {{ $table->status === 'available' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-amber-50 text-amber-700 border border-amber-200' }}">
                            {{ $table->status === 'available' ? 'Tersedia' : 'Terisi' }}
                        </span>
                    </div>

                    <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                        <div class="space-y-1.5">
                            <span
                                class="text-[9px] font-bold uppercase tracking-wider text-blue-600">{{ $table->area }}
                                Area</span>
                            <h3 class="font-bold text-slate-800 text-sm">Meja No. {{ $table->table_number }}</h3>
                            <p class="text-xs text-stone-400 line-clamp-2 leading-relaxed">
                                {{ $table->description ?? 'Dilengkapi fasilitas stopkontak mandiri.' }}
                            </p>
                        </div>

                        <div class="border-t border-slate-50 pt-3 flex items-center justify-between">
                            <span class="text-[10px] text-slate-400"><i
                                    class="fa-solid fa-user-group mr-1.5"></i>Kapasitas: {{ $table->capacity }}
                                Orang</span>

                            @auth
                                <a href="{{ route('reservasi.create', $table->id) }}"
                                    class="px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-[10px] rounded-lg shadow-sm transition">
                                    Booking
                                </a>
                            @else
                                <a href="{{ route('register') }}"
                                    class="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-[10px] rounded-lg transition">
                                    Booking
                                </a>
                            @endauth
                        </div>
                    </div>

                </div>
            @empty
                <div
                    class="col-span-1 sm:col-span-2 lg:col-span-4 bg-white border border-stone-100 py-16 text-center text-stone-400 rounded-2xl">
                    <div
                        class="w-12 h-12 bg-stone-50 rounded-full flex items-center justify-center mx-auto mb-3 text-lg">
                        🪑</div>
                    <p class="text-sm font-medium">Informasi tata letak meja belum tersedia.</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- ANNOUNCEMENTS & PROMOS SECTION -->
    <section id="announcements" class="w-full max-w-7xl mx-auto px-6 py-20 border-t border-stone-100">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
            <div class="max-w-xl">
                <span class="text-[10px] font-bold uppercase tracking-widest text-blue-600">Update & Informasi</span>
                <h2 class="text-3xl font-extrabold tracking-tight mt-1 text-slate-800">Kabar Terbaru PesanMeja</h2>
                <p class="text-sm text-stone-500 mt-2">Cari tahu promo menarik, event komunitas terdekat, dan
                    pemberitahuan layanan operasional kami di Palembang.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($announcements as $announcement)
                <div
                    class="bg-white p-7 rounded-2xl border border-stone-100 shadow-sm hover:shadow-md hover:border-blue-600/30 transition-all duration-200 flex flex-col justify-between">
                    <div class="space-y-4">
                        <span
                            class="inline-block px-2.5 py-1 text-[9px] font-bold uppercase tracking-wider rounded-md
              {{ $announcement->type === 'promo' ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : 'bg-blue-50 text-blue-700 border border-blue-100' }}">
                            {{ $announcement->type }}
                        </span>
                        <h3 class="font-bold text-[#1c1917] text-base leading-snug line-clamp-2">
                            {{ $announcement->title }}
                        </h3>
                        <p class="text-xs text-stone-500 leading-relaxed line-clamp-3">
                            {{ strip_tags($announcement->content) }}
                        </p>
                    </div>

                    <div
                        class="border-t border-stone-100/80 pt-4 mt-6 flex items-center justify-between text-[10px] text-stone-400">
                        <span><i class="fa-regular fa-clock mr-1"></i>
                            {{ $announcement->created_at->diffForHumans() }}</span>
                        <span class="font-medium text-stone-500">By Admin</span>
                    </div>
                </div>
            @empty
                <div
                    class="col-span-1 md:col-span-3 bg-white border border-stone-100 py-16 text-center text-stone-400 rounded-2xl">
                    <div
                        class="w-12 h-12 bg-stone-50 rounded-full flex items-center justify-center mx-auto mb-3 text-lg">
                        📢</div>
                    <p class="text-sm font-medium">Belum ada pengumuman terbaru saat ini.</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- CTA / RESERVE SECTION -->
    <section id="reserve" class="w-full max-w-7xl mx-auto px-6 pb-20">
        <div
            class="w-full bg-[#1c1917] text-white rounded-3xl p-8 sm:p-14 relative overflow-hidden flex flex-col md:flex-row justify-between items-center gap-8">
            <span
                class="absolute top-0 right-0 w-80 h-80 bg-blue-600 rounded-full filter blur-[140px] opacity-25 pointer-events-none"></span>

            <div class="space-y-4 max-w-lg relative z-10">
                <h2 class="text-2xl sm:text-4xl font-medium tracking-tight">Ingin Mengadakan Rapat atau Acara
                    Komunitas?</h2>
                <p class="text-sm text-stone-300 leading-relaxed">
                    Kami menyediakan reservasi meja khusus, ruang VIP, serta paket katering kafe untuk mendukung
                    kelancaran acaramu di Palembang.
                </p>
            </div>

            <div class="relative z-10 flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
                <a href="https://wa.me/6281234567890" target="_blank"
                    class="px-6 py-3.5 bg-blue-600 hover:bg-blue-700 text-center text-white font-semibold rounded-xl transition-all duration-150 shadow-lg shadow-blue-600/20">
                    Hubungi via WhatsApp
                </a>
                <a href="{{ route('register') }}"
                    class="px-6 py-3.5 bg-white/10 hover:bg-white/15 text-center text-white font-semibold rounded-xl transition-all duration-150">
                    Buat Akun
                </a>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="w-full text-center py-8 text-xs text-stone-400 border-t border-stone-100">
        &copy; {{ date('Y') }} PesanMeja. Palembang, Indonesia. Developed with Tailwind & Laravel.
    </footer>

</body>

</html>
