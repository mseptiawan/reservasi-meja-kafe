<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cek Status Akun | Senja Space</title>
    
    <!-- Font & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased min-h-screen bg-slate-50 flex items-center justify-center p-4 font-['Plus_Jakarta_Sans']">

    <div class="w-full max-w-md bg-white border border-slate-100 rounded-xl shadow-sm p-6 sm:p-8 space-y-6">
        
        <!-- Header Brand & Title -->
        <div class="text-center space-y-2">
            <div class="inline-flex items-center gap-2 mx-auto">
                <div class="w-7 h-7 rounded-md bg-gradient-to-tr from-indigo-500 to-purple-500 flex items-center justify-center text-white shadow-sm">
                    <i class="fa-solid fa-mug-hot text-xs"></i>
                </div>
                <span class="font-bold text-slate-800 text-sm tracking-tight">Senja Space</span>
            </div>
            <h1 class="text-xl font-extrabold text-slate-900 tracking-tight pt-2">Check Account Status</h1>
            <p class="text-xs text-slate-400 font-medium">Masukkan Email untuk melihat progres verifikasi.</p>
        </div>

        <!-- Form Pencarian -->
        <form method="POST" action="{{ route('account.status.check') }}" class="space-y-3.5">
            @csrf
            <div class="space-y-1.5">
                <label for="search_key" class="text-[11px] font-semibold text-slate-600 tracking-wide uppercase">Email</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400 text-xs">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                    <input id="search_key" 
                           type="text" 
                           name="search_key" 
                           value="{{ old('search_key') }}" 
                           required 
                           placeholder="e.g. nama@email.com" 
                           class="w-full pl-9 pr-3.5 py-2.5 bg-white border border-slate-200 rounded-lg text-slate-800 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-xs transition-all shadow-sm" />
                </div>
                <x-input-error :messages="$errors->get('search_key')" class="mt-1 text-[11px] text-rose-500 font-medium" />
            </div>

            <button type="submit" class="w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-xs rounded-lg shadow-sm transition-all duration-150">
                Periksa Status
            </button>
        </form>

        <!-- Hasil Pencarian Status -->
        @if (session('error'))
            <div class="p-3 bg-rose-50 border border-rose-100 rounded-lg text-rose-800 text-xs font-medium text-center">
                <i class="fa-solid fa-circle-xmark mr-1"></i> {{ session('error') }}
            </div>
        @endif

@if (session('account_user'))
            @php $user = session('account_user'); @endphp
            <div class="p-4 bg-slate-50 border border-slate-100 rounded-lg space-y-3">
                <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider border-b border-slate-200/60 pb-1.5">Hasil Pencarian</div>
                
                <div class="grid grid-cols-3 gap-y-2 text-xs">
                    <span class="text-slate-400">Nama</span>
                    <!-- DIUBAH MENJADI ARRAY SYNTAX -->
                    <span class="col-span-2 font-semibold text-slate-700">: {{ $user['name'] }}</span>

                    <span class="text-slate-400">Kode Akun</span>
                    <!-- DIUBAH MENJADI ARRAY SYNTAX -->
                    <span class="col-span-2 font-mono font-medium text-indigo-600">: {{ $user['customer_code'] }}</span>

                    <span class="text-slate-400">Status</span>
                    <span class="col-span-2 flex items-center gap-1">
                        : 
                        <!-- DIUBAH MENJADI ARRAY SYNTAX -->
                        @if ($user['status_verifikasi'] === 'pending')
                            <span class="px-2 py-0.5 rounded bg-amber-50 text-amber-700 border border-amber-200 font-bold text-[10px] uppercase">
                                <i class="fa-solid fa-hourglass-half text-[9px] mr-0.5 animate-pulse"></i> Pending / Menunggu Admin
                            </span>
                        @elseif ($user['status_verifikasi'] === 'active')
                            <span class="px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 border border-emerald-200 font-bold text-[10px] uppercase">
                                <i class="fa-solid fa-circle-check text-[9px] mr-0.5"></i> Aktif (Silakan Login)
                            </span>
                        @else
                            <span class="px-2 py-0.5 rounded bg-rose-50 text-rose-700 border border-rose-200 font-bold text-[10px] uppercase">
                                <i class="fa-solid fa-circle-xmark text-[9px] mr-0.5"></i> Ditolak
                            </span>
                        @endif
                    </span>
                </div>

                <!-- DIUBAH MENJADI ARRAY SYNTAX -->
                @if ($user['status_verifikasi'] === 'approved')
                    <div class="pt-2">
                        <a href="{{ route('login') }}" class="w-full block text-center py-2 px-3 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs rounded-md shadow-sm transition-all duration-150">
                            Masuk ke Dashboard <i class="fa-solid fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                @endif
            </div>
        @endif

    </div>

</body>
</html>