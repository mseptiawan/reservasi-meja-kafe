<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Senja Space | Coffee & Workspace Palembang</title>

  @fonts
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#faf9f6]  text-[#1c1917] antialiased min-h-screen flex flex-col justify-between selection:bg-[#f53003] selection:text-white">

  <header class="w-full max-w-7xl mx-auto px-6 py-6 flex items-center justify-between sticky top-0 z-50 bg-[#faf9f6]/80 dark:bg-[#0c0c0e]/80 backdrop-blur-md">
    <div class="flex items-center gap-2">
      <span class="p-2 rounded-xl bg-[#f53003] text-white shadow-lg shadow-[#f53003]/20">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
        </svg>
      </span>
      <span class="font-medium tracking-tight text-lg dark:text-white">Senja <span class="text-[#f53003]">Space</span></span>
    </div>

    <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-stone-600 dark:text-stone-300">
      <a href="#about" class="hover:text-[#f53003] transition-colors">Tentang Kami</a>
      <a href="#menu" class="hover:text-[#f53003] transition-colors">Menu Andalan</a>
      <a href="#experience" class="hover:text-[#f53003] transition-colors">Suasana</a>
    </nav>

    <div class="flex items-center gap-3">
      @if (Route::has('login'))
      @auth
      <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 text-sm font-semibold bg-[#1c1917] dark:bg-white text-white dark:text-black rounded-xl hover:opacity-90 transition-all duration-200">
        Dashboard
      </a>
      @else
      <a href="{{ route('login') }}" class="hidden sm:inline-block px-4 py-2 text-sm font-medium hover:text-[#f53003] transition-colors">
        Log in
      </a>
      <a href="#reserve" class="px-5 py-2.5 text-sm font-semibold bg-[#f53003] hover:bg-[#d62700] text-white rounded-xl shadow-md shadow-[#f53003]/10 hover:shadow-[#f53003]/20 transition-all duration-200">
        Booking Meja
      </a>
      @endauth
      @endif
    </div>
  </header>

  <section class="w-full max-w-7xl mx-auto px-6 pt-12 pb-20 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
    <div class="lg:col-span-7 space-y-6">
      <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full text-xs font-semibold bg-[#f53003]/10 text-[#f53003] dark:bg-[#f53003]/20">
        ☕ Freshly Brewed Daily in Palembang
      </span>
      <h1 class="text-4xl sm:text-6xl font-black tracking-tight leading-[1.1] dark:text-white">
        Temukan Sudut Terbaik untuk <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#f53003] to-amber-500">Kreativitasmu.</span>
      </h1>
      <p class="text-base sm:text-lg text-stone-500 dark:text-zinc-400 max-w-xl leading-relaxed">
        Lebih dari sekadar secangkir kopi. Senja Space menghadirkan suasana tenang dengan fasilitas lengkap, pas untuk fokus bekerja, rapat kolaboratif, atau sekadar menikmati sore.
      </p>

      <div class="flex flex-wrap gap-4 pt-2">
        <a href="#reserve" class="px-7 py-4 bg-[#f53003] hover:bg-[#d62700] text-white font-semibold rounded-xl shadow-lg shadow-[#f53003]/15 hover:shadow-[#f53003]/25 transition-all duration-150 flex items-center gap-2">
          <span>Pesan Tempat Sekarang</span>
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
          </svg>
        </a>
        <a href="#menu" class="px-7 py-4 border border-stone-200 dark:border-zinc-800 hover:bg-stone-50 dark:hover:bg-zinc-900 font-semibold rounded-xl transition-all duration-150">
          Lihat Menu
        </a>
      </div>

      <div class="pt-8 border-t border-stone-100 dark:border-zinc-900 grid grid-cols-3 gap-6">
        <div>
          <p class="text-2xl sm:text-3xl font-extrabold dark:text-white">100%</p>
          <p class="text-xs text-stone-400 dark:text-zinc-500 font-medium">Arabica Premium</p>
        </div>
        <div>
          <p class="text-2xl sm:text-3xl font-extrabold dark:text-white">150+ Mbps</p>
          <p class="text-xs text-stone-400 dark:text-zinc-500 font-medium">Ultra-Fast WiFi</p>
        </div>
        <div>
          <p class="text-2xl sm:text-3xl font-extrabold dark:text-white">3 Area</p>
          <p class="text-xs text-stone-400 dark:text-zinc-500 font-medium">Indoor, Semi, & Garden</p>
        </div>
      </div>
    </div>

    <div class="lg:col-span-5 relative">
      <span class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-72 h-72 bg-[#f53003] rounded-full filter blur-[120px] opacity-20 dark:opacity-30 pointer-events-none"></span>

      <div class="relative bg-white dark:bg-[#121214] p-8 rounded-3xl border border-stone-100 dark:border-zinc-900 shadow-2xl shadow-stone-200/50 dark:shadow-none space-y-6">
        <div class="flex justify-between items-start">
          <span class="text-xs font-medium tracking-widest text-[#f53003] uppercase">Highlight Of The Week</span>
          <span class="text-xs font-medium px-2.5 py-1 bg-emerald-500/10 text-emerald-500 dark:bg-emerald-500/20 rounded-full">Buka Hari Ini</span>
        </div>

        <div class="aspect-[4/3] w-full rounded-2xl bg-gradient-to-br from-[#1c1917] to-[#2e2a27] p-6 flex flex-col justify-between text-white relative overflow-hidden">
          <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>

          <span class="bg-white/10 backdrop-blur-md text-[11px] font-medium px-3 py-1.5 rounded-full self-start">
            ☕ Signature Butterscotch Latte
          </span>

          <div>
            <p class="text-xs text-stone-300">Rekomendasi Barista</p>
            <h3 class="text-lg sm:text-xl font-medium mt-0.5">Rasakan Kombinasi Espresso dengan Manisnya Karamel Mentega</h3>
          </div>
        </div>

        <div class="space-y-3.5 text-sm text-stone-600 dark:text-zinc-400">
          <div class="flex items-center gap-3">
            <span class="p-1.5 rounded-lg bg-stone-100 dark:bg-zinc-800 text-stone-500 dark:text-zinc-300">📍</span>
            <span>Jl. Jenderal Sudirman No. 12, Palembang</span>
          </div>
          <div class="flex items-center gap-3">
            <span class="p-1.5 rounded-lg bg-stone-100 dark:bg-zinc-800 text-stone-500 dark:text-zinc-300">🕒</span>
            <span>Setiap Hari : 09:00 WIB - 23:00 WIB</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="menu" class="w-full max-w-7xl mx-auto px-6 py-20 border-t border-stone-100 dark:border-zinc-900/60">
    <div class="max-w-2xl mb-12">
      <h2 class="text-3xl font-extrabold tracking-tight dark:text-white">Dibuat dengan Dedikasi</h2>
      <p class="text-sm text-stone-500 dark:text-zinc-400 mt-2">Biji kopi pilihan yang dipanggang sempurna dan diracik oleh barista berpengalaman.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <div class="bg-white dark:bg-[#121214] p-6 rounded-2xl border border-stone-100 dark:border-zinc-900">
        <span class="text-2xl">☕</span>
        <h3 class="font-medium text-lg mt-4 dark:text-white">Espresso Blend</h3>
        <p class="text-xs text-stone-400 dark:text-zinc-500 mt-1">Keseimbangan sempurna rasa cokelat hitam, kacang panggang, dan keasaman buah yang pas.</p>
      </div>

      <div class="bg-white dark:bg-[#121214] p-6 rounded-2xl border border-stone-100 dark:border-zinc-900">
        <span class="text-2xl">🥐</span>
        <h3 class="font-medium text-lg mt-4 dark:text-white">Artisanal Pastries</h3>
        <p class="text-xs text-stone-400 dark:text-zinc-500 mt-1">Croissant mentega yang renyah di luar dan lembut di dalam, dipanggang segar setiap pagi.</p>
      </div>

      <div class="bg-white dark:bg-[#121214] p-6 rounded-2xl border border-stone-100 dark:border-zinc-900">
        <span class="text-2xl">🍀</span>
        <h3 class="font-medium text-lg mt-4 dark:text-white">Non-Coffee Selections</h3>
        <p class="text-xs text-stone-400 dark:text-zinc-500 mt-1">Matcha Jepang murni, teh artisan, dan minuman botani segar untuk harimu yang lebih cerah.</p>
      </div>
    </div>
  </section>

  <section id="reserve" class="w-full max-w-7xl mx-auto px-6 pb-20">
    <div class="w-full bg-[#1c1917] text-white rounded-3xl p-8 sm:p-14 relative overflow-hidden flex flex-col md:flex-row justify-between items-center gap-8">
      <span class="absolute top-0 right-0 w-80 h-80 bg-[#f53003] rounded-full filter blur-[140px] opacity-25 pointer-events-none"></span>

      <div class="space-y-4 max-w-lg relative z-10">
        <h2 class="text-2xl sm:text-4xl font-medium tracking-tight">Ingin Mengadakan Rapat atau Acara Komunitas?</h2>
        <p class="text-sm text-stone-300 leading-relaxed">
          Kami menyediakan reservasi meja khusus, ruang VIP, serta paket katering kafe untuk mendukung kelancaran acaramu di Palembang.
        </p>
      </div>

      <div class="relative z-10 flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
        <a href="https://wa.me/6281234567890" target="_blank" class="px-6 py-3.5 bg-[#f53003] hover:bg-[#d62700] text-center text-white font-semibold rounded-xl transition-all duration-150">
          Hubungi via WhatsApp
        </a>
        <a href="{{ route('register') }}" class="px-6 py-3.5 bg-white/10 hover:bg-white/15 text-center text-white font-semibold rounded-xl transition-all duration-150">
          Buat Akun Member
        </a>
      </div>
    </div>
  </section>

  <footer class="w-full text-center py-8 text-xs text-stone-400 dark:text-zinc-600 border-t border-stone-100 dark:border-zinc-900/50">
    &copy;
    {{ date('Y') }} Senja Space. Palembang, Indonesia. Developed with Tailwind & Laravel.
  </footer>

</body>

</html>