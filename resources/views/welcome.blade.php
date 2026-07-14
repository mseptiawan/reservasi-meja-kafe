<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Reservasi Meja Online | Senja Space Palembang</title>

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

  @fonts
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#FAF7F2] dark:bg-[#0F0E0C] text-[#2C2520] dark:text-[#F4ECE1] antialiased min-h-screen flex flex-col justify-between selection:bg-[#8B5A2B] selection:text-white">
  
  <!-- Navigation Header -->
  <header class="w-full max-w-7xl mx-auto px-6 py-6 flex items-center justify-between sticky top-0 z-50 bg-[#FAF7F2]/80 dark:bg-[#0F0E0C]/80 backdrop-blur-md">
    <div class="flex items-center gap-2">
      <!-- Logo Aesthetic Brown -->
      <span class="p-2 rounded-xl bg-[#8B5A2B] text-white shadow-lg shadow-[#8B5A2B]/20">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
        </svg>
      </span>
      <span class="font-bold tracking-tight text-lg dark:text-white">Senja <span class="text-[#8B5A2B]">Space</span></span>
    </div>

    <!-- Navigation Menu (Desktop) -->
    <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-[#5C5146] dark:text-[#D1C4B4]">
      <a href="#keuntungan" class="hover:text-[#8B5A2B] transition-colors">Kenapa Reservasi?</a>
      <a href="#pilihan-area" class="hover:text-[#8B5A2B] transition-colors">Pilihan Area</a>
      <a href="#cara-kerja" class="hover:text-[#8B5A2B] transition-colors">Cara Pesan</a>
    </nav>

    <div class="flex items-center gap-3">
      @if (Route::has('login'))
        @auth
        <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 text-sm font-semibold bg-[#2C2520] dark:bg-[#FAF7F2] text-white dark:text-[#2C2520] rounded-xl hover:opacity-90 transition-all duration-200">
          Dashboard
        </a>
        @else
        <a href="{{ route('login') }}" class="hidden sm:inline-block px-4 py-2 text-sm font-medium hover:text-[#8B5A2B] transition-colors">
          Log in
        </a>
        <a href="#cara-kerja" class="px-5 py-2.5 text-sm font-semibold bg-[#8B5A2B] hover:bg-[#6F4E37] text-white rounded-xl shadow-md transition-all duration-200">
          Mulai Booking
        </a>
        @endauth
      @endif
    </div>
  </header>

  <!-- Hero Section -->
  <section class="w-full max-w-7xl mx-auto px-6 pt-12 pb-20 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
    <!-- Hero Left -->
    <div class="lg:col-span-7 space-y-6">
      <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full text-xs font-semibold bg-[#8B5A2B]/10 text-[#8B5A2B] dark:bg-[#8B5A2B]/20">
        🪑 Garansi Dapat Meja Kayu Terbaik
      </span>
      <h1 class="text-4xl sm:text-6xl font-black tracking-tight leading-[1.1] dark:text-white">
        Datang Lebih Tenang,<br>Meja Pilihan Sudah <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#8B5A2B] to-[#D4A373]">Milikmu.</span>
      </h1>
      <p class="text-base sm:text-lg text-[#5C5146] dark:text-[#D1C4B4] max-w-xl leading-relaxed">
        Nggak perlu khawatir kehabisan tempat atau mondar-mandir cari colokan. Pilih area meja favoritmu sekarang secara online dan pastikan produktivitas berjalan sempurna.
      </p>

      <!-- CTA Buttons -->
      <div class="flex flex-wrap gap-4 pt-2">
        <a href="/booking/create" class="px-8 py-4 bg-[#8B5A2B] hover:bg-[#6F4E37] text-white font-semibold rounded-xl shadow-lg shadow-[#8B5A2B]/15 hover:shadow-[#8B5A2B]/25 transition-all duration-150 flex items-center gap-2">
          <span>Pesan Meja Sekarang</span>
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
          </svg>
        </a>
        <a href="#pilihan-area" class="px-8 py-4 border border-[#E6DFD5] dark:border-[#2C2520] hover:bg-[#FAF7F2] dark:hover:bg-[#1A1815] font-semibold rounded-xl transition-all duration-150">
          Eksplorasi Area
        </a>
      </div>

      <!-- Live Counter -->
      <div class="pt-6 border-t border-[#E6DFD5] dark:border-[#2C2520] flex items-center gap-4">
        <div class="flex -space-x-2">
          <span class="inline-block h-8 w-8 rounded-full ring-2 ring-[#FAF7F2] dark:ring-[#0F0E0C] bg-[#8B5A2B] flex items-center justify-center text-[10px] font-bold text-white">1,2k+</span>
        </div>
        <p class="text-xs text-[#8A7E72] dark:text-[#A89D8F] font-medium">
          Lebih dari <span class="text-[#2C2520] dark:text-[#F4ECE1] font-bold">1,200+ meja</span> telah direservasi bulan ini di Palembang.
        </p>
      </div>
    </div>

    <!-- Hero Right (Visual Element) -->
    <div class="lg:col-span-5 relative">
      <!-- Glow Effect Cokelat Hangat -->
      <span class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-72 h-72 bg-[#8B5A2B] rounded-full filter blur-[120px] opacity-20 dark:opacity-30 pointer-events-none"></span>

      <!-- Box Live Booking Status -->
      <div class="relative bg-white dark:bg-[#151412] p-8 rounded-3xl border border-[#E6DFD5] dark:border-[#26221E] shadow-2xl shadow-stone-200/50 dark:shadow-none space-y-6">
        <div class="flex justify-between items-center border-b border-[#FAF7F2] dark:border-[#26221E] pb-4">
          <div>
            <span class="text-xs font-semibold tracking-wider text-[#8B5A2B] uppercase">Sistem Realtime</span>
            <h3 class="text-base font-bold dark:text-white">Ketersediaan Meja Hari Ini</h3>
          </div>
          <span class="text-xs font-medium px-2.5 py-1 bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 rounded-full animate-pulse">
            ● Live Updated
          </span>
        </div>

        <!-- Info Grid -->
        <div class="grid grid-cols-2 gap-4">
          <div class="p-4 bg-[#FAF7F2] dark:bg-[#1C1A17] rounded-2xl">
            <p class="text-xs text-[#8A7E72]">Indoor (AC)</p>
            <p class="text-xl font-black text-emerald-600 dark:text-emerald-400 mt-1">8 Meja Ready</p>
          </div>
          <div class="p-4 bg-[#FAF7F2] dark:bg-[#1C1A17] rounded-2xl">
            <p class="text-xs text-[#8A7E72]">Outdoor (Garden)</p>
            <p class="text-xl font-black text-emerald-600 dark:text-emerald-400 mt-1">4 Meja Ready</p>
          </div>
          <div class="p-4 bg-[#FAF7F2] dark:bg-[#1C1A17] rounded-2xl">
            <p class="text-xs text-[#8A7E72]">Sofa VIP</p>
            <p class="text-xl font-black text-amber-600 dark:text-amber-400 mt-1">Sisa 1 Sofa</p>
          </div>
          <div class="p-4 bg-[#FAF7F2] dark:bg-[#1C1A17] rounded-2xl">
            <p class="text-xs text-[#8A7E72]">Semi-Outdoor</p>
            <p class="text-xl font-black text-[#8A7E72] mt-1">Full Booked</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Section: Keuntungan Reservasi -->
  <section id="keuntungan" class="w-full max-w-7xl mx-auto px-6 py-20 border-t border-[#E6DFD5] dark:border-[#26221E]">
    <div class="max-w-3xl mb-16">
      <span class="text-xs font-bold tracking-widest text-[#8B5A2B] uppercase">Keistimewaan Reservasi</span>
      <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight dark:text-white mt-1">Kenapa Harus Booking Meja Dulu?</h2>
      <p class="text-sm sm:text-base text-[#5C5146] dark:text-[#D1C4B4] mt-2">Dapatkan kenyamanan ekstra yang tidak didapatkan oleh pengunjung biasa.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <!-- Feature 1 -->
      <div class="space-y-3">
        <span class="inline-flex items-center justify-center p-3 rounded-xl bg-[#8B5A2B]/10 text-[#8B5A2B] dark:bg-[#8B5A2B]/20 text-xl">
          🪑
        </span>
        <h3 class="font-bold text-lg dark:text-white">Tanpa Menunggu & Mengantre</h3>
        <p class="text-sm text-[#5C5146] dark:text-[#D1C4B4]">Datang kapan saja sesuai jadwal yang kamu tentukan. Meja kayu pilihanmu sudah bersih, siap pakai, dan disiapkan khusus.</p>
      </div>

      <!-- Feature 2 -->
      <div class="space-y-3">
        <span class="inline-flex items-center justify-center p-3 rounded-xl bg-[#8B5A2B]/10 text-[#8B5A2B] dark:bg-[#8B5A2B]/20 text-xl">
          🔌
        </span>
        <h3 class="font-bold text-lg dark:text-white">Fasilitas Sesuai Kebutuhan</h3>
        <p class="text-sm text-[#5C5146] dark:text-[#D1C4B4]">Butuh meja dekat colokan listrik untuk laptop? Atau butuh ruang yang tenang? Berikan catatan saat memesan.</p>
      </div>

      <!-- Feature 3 -->
      <div class="space-y-3">
        <span class="inline-flex items-center justify-center p-3 rounded-xl bg-[#8B5A2B]/10 text-[#8B5A2B] dark:bg-[#8B5A2B]/20 text-xl">
          ☕
        </span>
        <h3 class="font-bold text-lg dark:text-white">Prapesan Makanan & Minuman</h3>
        <p class="text-sm text-[#5C5146] dark:text-[#D1C4B4]">Ingin kopi favoritmu langsung tersaji hangat saat kamu tiba? Atur pesanan bersamaan dengan pemesanan mejamu.</p>
      </div>
    </div>
  </section>

  <!-- Section: Pilihan Area -->
  <section id="pilihan-area" class="w-full max-w-7xl mx-auto px-6 py-20 border-t border-[#E6DFD5] dark:border-[#26221E] bg-[#FAF7F2]/50 dark:bg-[#141311] rounded-3xl">
    <div class="max-w-2xl mb-12">
      <span class="text-xs font-bold tracking-widest text-[#8B5A2B] uppercase">Pilih Vibe Terbaikmu</span>
      <h2 class="text-3xl font-extrabold tracking-tight dark:text-white mt-1">Area Meja yang Tersedia</h2>
    </div>

    <!-- Area Grid Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <!-- Area 1 -->
      <div class="bg-white dark:bg-[#1A1815] p-6 rounded-2xl border border-[#E6DFD5] dark:border-[#26221E] flex flex-col justify-between h-64">
        <div>
          <span class="text-xs font-medium px-2 py-1 bg-[#FAF7F2] dark:bg-[#1C1A17] rounded-lg dark:text-[#D1C4B4]">Quiet Zone</span>
          <h3 class="font-bold text-lg mt-4 dark:text-white">Indoor (AC & Colokan)</h3>
          <p class="text-xs text-[#8A7E72] mt-2">Didesain khusus untuk fokus bekerja, belajar, atau rapat penting dengan didukung stopkontak di setiap sudut meja.</p>
        </div>
        <div class="text-xs font-bold text-[#8B5A2B]">
          <span>Kapasitas: 1 - 4 Orang per meja</span>
        </div>
      </div>

      <!-- Area 2 -->
      <div class="bg-white dark:bg-[#1A1815] p-6 rounded-2xl border border-[#E6DFD5] dark:border-[#26221E] flex flex-col justify-between h-64">
        <div>
          <span class="text-xs font-medium px-2 py-1 bg-[#FAF7F2] dark:bg-[#1C1A17] rounded-lg dark:text-[#D1C4B4]">Aesthetic Vibe</span>
          <h3 class="font-bold text-lg mt-4 dark:text-white">Outdoor (Garden Area)</h3>
          <p class="text-xs text-[#8A7E72] mt-2">Nikmati hembusan angin segar dan pemandangan meja taman kayu estetik yang menenangkan pikiran di sore hari.</p>
        </div>
        <div class="text-xs font-bold text-[#8B5A2B]">
          <span>Kapasitas: 2 - 6 Orang per meja</span>
        </div>
      </div>

      <!-- Area 3 -->
      <div class="bg-white dark:bg-[#1A1815] p-6 rounded-2xl border border-[#E6DFD5] dark:border-[#26221E] flex flex-col justify-between h-64">
        <div>
          <span class="text-xs font-medium px-2 py-1 bg-[#FAF7F2] dark:bg-[#1C1A17] rounded-lg dark:text-[#D1C4B4]">Exclusive Class</span>
          <h3 class="font-bold text-lg mt-4 dark:text-white">Sofa VIP Lounge</h3>
          <p class="text-xs text-[#8A7E72] mt-2">Area duduk super nyaman dengan privasi tinggi, sangat cocok untuk kumpul keluarga besar atau rapat bisnis formal.</p>
        </div>
        <div class="text-xs font-bold text-[#8B5A2B]">
          <span>Kapasitas: Up to 8 Orang</span>
        </div>
      </div>
    </div>
  </section>

  <!-- Section: Cara Kerja (How it Works) -->
  <section id="cara-kerja" class="w-full max-w-7xl mx-auto px-6 py-20">
    <div class="max-w-2xl text-center mx-auto mb-16">
      <span class="text-xs font-bold tracking-widest text-[#8B5A2B] uppercase">Mudah & Cepat</span>
      <h2 class="text-3xl font-extrabold tracking-tight dark:text-white mt-1">Cara Kerja Reservasi</h2>
      <p class="text-sm text-[#8A7E72] mt-2">Hanya butuh waktu kurang dari 2 menit hingga tempat terbaikmu terkunci aman.</p>
    </div>

    <!-- Steps Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
      <div class="space-y-2">
        <div class="w-12 h-12 bg-[#8B5A2B]/10 text-[#8B5A2B] rounded-full flex items-center justify-center font-bold text-lg mx-auto">1</div>
        <h4 class="font-bold dark:text-white">Pilih Area & Tanggal</h4>
        <p class="text-xs text-[#8A7E72]">Tentukan area meja, tanggal berkunjung, jam tiba, dan estimasi durasimu.</p>
      </div>

      <div class="space-y-2">
        <div class="w-12 h-12 bg-[#8B5A2B]/10 text-[#8B5A2B] rounded-full flex items-center justify-center font-bold text-lg mx-auto">2</div>
        <h4 class="font-bold dark:text-white">Isi Detail Kontak</h4>
        <p class="text-xs text-[#8A7E72]">Masukkan nama lengkap dan nomor telepon untuk keperluan konfirmasi di tempat.</p>
      </div>

      <div class="space-y-2">
        <div class="w-12 h-12 bg-[#8B5A2B]/10 text-[#8B5A2B] rounded-full flex items-center justify-center font-bold text-lg mx-auto">3</div>
        <h4 class="font-bold dark:text-white">Konfirmasi Instan</h4>
        <p class="text-xs text-[#8A7E72]">Sistem kami akan langsung memproses dan mengunci meja pilihanmu dalam hitungan detik.</p>
      </div>

      <div class="space-y-2">
        <div class="w-12 h-12 bg-[#8B5A2B]/10 text-[#8B5A2B] rounded-full flex items-center justify-center font-bold text-lg mx-auto">4</div>
        <h4 class="font-bold dark:text-white">Tiba & Duduk!</h4>
        <p class="text-xs text-[#8A7E72]">Tunjukkan bukti reservasi di HP-mu kepada staf kami saat tiba di depan pintu.</p>
      </div>
    </div>
  </section>

  <!-- CTA Reservation -->
  <section class="w-full max-w-7xl mx-auto px-6 pb-20">
    <div class="w-full bg-[#2C2520] text-white rounded-3xl p-8 sm:p-14 relative overflow-hidden flex flex-col md:flex-row justify-between items-center gap-8">
      <!-- Glow Effect -->
      <span class="absolute top-0 right-0 w-80 h-80 bg-[#8B5A2B] rounded-full filter blur-[140px] opacity-25 pointer-events-none"></span>
      
      <div class="space-y-4 max-w-lg relative z-10">
        <h2 class="text-2xl sm:text-4xl font-bold tracking-tight">Siap Untuk Mengamankan Meja Kayumu?</h2>
        <p class="text-sm text-[#D1C4B4] leading-relaxed">
          Sistem pemesanan kami beroperasi 24/7. Tidak ada biaya pendaftaran tambahan, proses reservasi murni gratis dan cepat.
        </p>
      </div>

      <div class="relative z-10 flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
        <a href="/booking/create" class="px-8 py-4 bg-[#8B5A2B] hover:bg-[#6F4E37] text-center text-white font-semibold rounded-xl transition-all duration-150">
          Pesan Meja Sekarang
        </a>
        <a href="https://wa.me/6281234567890" target="_blank" class="px-8 py-4 bg-white/10 hover:bg-white/15 text-center text-white font-semibold rounded-xl transition-all duration-150">
          Tanya Layanan VIP
        </a>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="w-full text-center py-8 text-xs text-[#8A7E72] dark:text-[#5C5146] border-t border-[#E6DFD5] dark:border-[#26221E]">
    &copy; {{ date('Y') }} Senja Space. Palembang, Indonesia. Developed with Tailwind & Laravel.
  </footer>

</body>

</html>