<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Senja Space</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased min-h-screen bg-[#E6DFD5] flex items-center justify-center relative overflow-hidden font-sans selection:bg-[#8B5A2B] selection:text-white">

    <!-- Ornamen Gelombang Latar Belakang (Persis Seperti Gambar) -->
    <div class="absolute inset-0 z-0 pointer-events-none opacity-40">
        <svg class="absolute -top-20 -left-20 w-[600px] h-[600px] text-[#C4B5A5]" fill="currentColor" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <path d="M44.7,-76.3C57.4,-69.1,66.8,-55.4,74.5,-40.8C82.2,-26.2,88.2,-10.7,86.8,4.3C85.4,19.3,76.6,33.8,66.8,45.8C57,57.7,46.2,67.1,33.3,73C20.4,78.9,5.4,81.3,-10.1,79.5C-25.6,77.7,-41.6,71.8,-54.4,61.9C-67.2,52,-76.8,38.1,-81.4,22.7C-86,7.3,-85.6,-9.6,-80,-24.8C-74.4,-40,-63.6,-53.4,-50.2,-60.8C-36.8,-68.2,-20.8,-69.6,-3.4,-64.3C14,-59,44.7,-76.3,44.7,-76.3Z" transform="translate(100 100)" />
        </svg>
        <svg class="absolute -bottom-40 -right-20 w-[800px] h-[800px] text-[#C4B5A5]" fill="currentColor" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <path d="M39.9,-68.2C50.7,-60.4,57.9,-46.3,64.2,-31.8C70.5,-17.3,75.9,-2.4,74.4,11.8C72.9,26,64.5,39.5,53.4,49.2C42.3,58.9,28.5,64.8,13.8,68.2C-0.9,71.6,-16.5,72.5,-30.9,67.6C-45.3,62.7,-58.5,52.1,-67.2,38.5C-75.9,24.9,-80,8.3,-78.3,-7.4C-76.6,-23.1,-69.1,-37.9,-58.2,-46.1C-47.3,-54.3,-33,-55.9,-19.9,-62.5C-6.8,-69.1,5.1,-80.7,21,-79.8C36.9,-78.9,39.9,-68.2,39.9,-68.2Z" transform="translate(100 100)" />
        </svg>
    </div>

    <!-- Container Card Utama (Rasio Lebar Persis Gambar) -->
    <div class="relative w-full max-w-4xl mx-4 bg-[#2C2520] rounded-[32px] shadow-2xl overflow-hidden py-16 px-6 sm:px-20 flex flex-col items-center justify-center min-h-[500px] z-10 border border-[#44382E]">
        
        <!-- Ornamen Gelombang Estetis di dalam Card -->
        <div class="absolute inset-0 z-0 pointer-events-none opacity-10">
            <svg class="absolute -right-10 top-10 w-96 h-96 text-white" fill="currentColor" viewBox="0 0 200 200">
                <path d="M47.5,-15.7C55.3,-1.2,51.1,23.5,36.5,36.8C21.9,50.1,-3.1,52,-21.9,42.8C-40.7,33.5,-53.3,13.1,-49.4,0.3C-45.5,-12.5,-25,-17.7,-8.4,-23.5C8.2,-29.3,39.7,-30.1,47.5,-15.7Z" transform="translate(100 100)" />
            </svg>
        </div>

        <div class="w-full max-w-md space-y-8 relative z-10 flex flex-col items-center">
            
            <!-- Logo Minimalis (Meja/Kafe Estetis) -->
            <div class="flex flex-col items-center space-y-2">
                <div class="text-white opacity-90 p-4 rounded-full border border-white/10 bg-white/5">
                    <!-- Icon Meja & Kopi Minimalis -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                    </svg>
                </div>
            </div>

            <!-- Session Status Alert -->
            <x-auth-session-status class="w-full text-center text-sm text-emerald-400" :status="session('status')" />

            <!-- Form Login -->
            <form method="POST" action="{{ route('login') }}" class="w-full space-y-5">
                @csrf

                <!-- Input Username/Email -->
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-white/50">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </span>
                    <input id="email" 
                           type="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           autofocus 
                           autocomplete="username"
                           placeholder="EMAIL ADDRESS" 
                           class="w-full pl-12 pr-4 py-3.5 bg-transparent border border-white/20 rounded-lg text-white placeholder-white/40 focus:outline-none focus:border-white focus:ring-0 text-sm tracking-widest transition-colors" />
                    
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-rose-400" />
                </div>

                <!-- Input Password -->
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-white/50">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>
                    </span>
                    <input id="password" 
                           type="password" 
                           name="password" 
                           required 
                           autocomplete="current-password"
                           placeholder="PASSWORD" 
                           class="w-full pl-12 pr-4 py-3.5 bg-transparent border border-white/20 rounded-lg text-white placeholder-white/40 focus:outline-none focus:border-white focus:ring-0 text-sm tracking-widest transition-colors" />
                    
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-rose-400" />
                </div>

                <!-- Remember Me & Forgot Password wrapper -->
                <div class="flex items-center justify-between text-xs text-white/60 px-1">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer hover:text-white transition-colors">
                        <input id="remember_me" type="checkbox" class="rounded border-white/20 bg-transparent text-[#8B5A2B] focus:ring-0 focus:ring-offset-0 w-4 h-4 mr-2" name="remember">
                        <span>Remember me</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="hover:text-white transition-colors underline decoration-white/20">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <!-- Tombol Login (Putih Bersih Kontras) -->
                <div class="pt-4">
                    <button type="submit" class="w-full py-4 bg-white text-[#2C2520] hover:bg-[#FAF7F2] font-bold text-sm tracking-widest rounded-lg shadow-lg hover:shadow-xl transition-all duration-150">
                        LOGIN
                    </button>
                </div>
            </form>
            
        </div>
    </div>

</body>
</html>