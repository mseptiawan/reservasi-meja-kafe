<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register | Senja Space</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Font & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased min-h-screen bg-white flex font-['Plus_Jakarta_Sans'] selection:bg-indigo-500 selection:text-white">

    <div class="flex w-full min-h-screen">
        
        <!-- BAGIAN KIRI: FORM REGISTRASI (50% Lebar Layar) -->
        <div class="w-full lg:w-1/2 flex flex-col justify-between p-8 sm:p-16 bg-white">
            
            <!-- Logo & Brand Header -->
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-indigo-500 to-purple-500 flex items-center justify-center text-white shadow-md shadow-indigo-100">
                    <i class="fa-solid fa-mug-hot text-sm"></i>
                </div>
                <span class="font-bold text-slate-800 text-base tracking-tight">Senja Space</span>
            </div>

            <!-- Form Container -->
            <div class="w-full max-w-md mx-auto my-auto py-8">
                <div class="space-y-2 mb-6">
                    <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Create an account</h1>
                    <p class="text-sm text-slate-400 font-medium">Start your experience with us</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <!-- Input Nama Lengkap -->
                    <div class="space-y-1.5">
                        <label for="name" class="text-xs font-semibold text-slate-700 tracking-wide uppercase">Full Name</label>
                        <input id="name" 
                               type="text" 
                               name="name" 
                               value="{{ old('name') }}" 
                               required 
                               autofocus 
                               autocomplete="name"
                               placeholder="Enter your full name" 
                               class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-sm transition-all shadow-sm" />
                        
                        <x-input-error :messages="$errors->get('name')" class="mt-1.5 text-xs text-rose-500 font-medium" />
                    </div>

                    <!-- Input Email -->
                    <div class="space-y-1.5">
                        <label for="email" class="text-xs font-semibold text-slate-700 tracking-wide uppercase">Email address</label>
                        <input id="email" 
                               type="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               autocomplete="username"
                               placeholder="Enter your email" 
                               class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-sm transition-all shadow-sm" />
                        
                        <x-input-error :messages="$errors->get('email')" class="mt-1.5 text-xs text-rose-500 font-medium" />
                    </div>

                    <!-- Input Password -->
                    <div class="space-y-1.5">
                        <label for="password" class="text-xs font-semibold text-slate-700 tracking-wide uppercase">Password</label>
                        <input id="password" 
                               type="password" 
                               name="password" 
                               required 
                               autocomplete="new-password"
                               placeholder="Create a password" 
                               class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-sm transition-all shadow-sm" />
                        
                        <x-input-error :messages="$errors->get('password')" class="mt-1.5 text-xs text-rose-500 font-medium" />
                    </div>

                    <!-- Input Konfirmasi Password -->
                    <div class="space-y-1.5">
                        <label for="password_confirmation" class="text-xs font-semibold text-slate-700 tracking-wide uppercase">Confirm Password</label>
                        <input id="password_confirmation" 
                               type="password" 
                               name="password_confirmation" 
                               required 
                               autocomplete="new-password"
                               placeholder="Repeat your password" 
                               class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-sm transition-all shadow-sm" />
                        
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5 text-xs text-rose-500 font-medium" />
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="pt-2">
                        <button type="submit" class="w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm rounded-xl shadow-md shadow-indigo-100 hover:shadow-lg transition-all duration-150">
                            Register
                        </button>
                    </div>
                </form>

                <!-- Footer Akses Login -->
                <div class="text-center mt-6 text-xs text-slate-500 font-medium">
                    Already registered? 
                    <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-700 font-bold transition-colors underline underline-offset-2">
                        Sign in
                    </a>
                </div>
            </div>

            <!-- Footer Hak Cipta -->
            <div class="text-[10px] text-slate-400 font-medium text-center lg:text-left">
                &copy; 2026 Senja Space. All rights reserved.
            </div>

        </div>

        <!-- BAGIAN KANAN: ILLUSTRASI / BRAND ARTWORK (50% Lebar Layar) -->
        <div class="hidden lg:flex w-1/2 bg-gradient-to-br from-indigo-50 to-indigo-100 items-center justify-center relative p-16 overflow-hidden">
            
            <!-- Ornamen Dekoratif -->
            <div class="absolute inset-0 z-0 pointer-events-none">
                <svg class="absolute -top-10 -right-10 w-96 h-96 text-indigo-200/50" fill="currentColor" viewBox="0 0 200 200">
                    <path d="M47.5,-15.7C55.3,-1.2,51.1,23.5,36.5,36.8C21.9,50.1,-3.1,52,-21.9,42.8C-40.7,33.5,-53.3,13.1,-49.4,0.3C-45.5,-12.5,-25,-17.7,-8.4,-23.5C8.2,-29.3,39.7,-30.1,47.5,-15.7Z" transform="translate(100 100)" />
                </svg>
                <svg class="absolute -bottom-20 -left-20 w-80 h-80 text-indigo-200/40" fill="currentColor" viewBox="0 0 200 200">
                    <path d="M39.9,-68.2C50.7,-60.4,57.9,-46.3,64.2,-31.8C70.5,-17.3,75.9,-2.4,74.4,11.8C72.9,26,64.5,39.5,53.4,49.2C42.3,58.9,28.5,64.8,13.8,68.2C-0.9,71.6,-16.5,72.5,-30.9,67.6Z" transform="translate(100 100)" />
                </svg>
            </div>

            <!-- Konten Ilustrasi Minimalis -->
            <div class="relative z-10 flex flex-col items-center justify-center text-center space-y-8 max-w-lg">
                <div class="w-72 h-72 rounded-3xl bg-white/80 backdrop-blur-md border border-white/40 flex items-center justify-center shadow-xl shadow-indigo-100/50">
                    <i class="fa-solid fa-mug-hot text-7xl text-indigo-500"></i>
                </div>
                <div class="space-y-3">
                    <h3 class="text-xl font-bold text-slate-800">Seduh Harimu di Senja Space</h3>
                    <p class="text-sm text-slate-500 leading-relaxed max-w-sm">Temukan ruang kerja ternyaman, nikmati kopi hangat terbaik, dan amankan meja reservasi Anda dengan mudah.</p>
                </div>
            </div>

        </div>

    </div>

</body>
</html>