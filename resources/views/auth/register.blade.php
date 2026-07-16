<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register | PesanMeja</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Font & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="antialiased min-h-screen bg-white flex font-['Plus_Jakarta_Sans'] selection:bg-indigo-500 selection:text-white">

    <div class="flex w-full min-h-screen">

        <div class="w-full lg:w-1/2 flex flex-col justify-between p-6 sm:p-12 bg-white">

            <div class="flex items-center gap-2">

                <span class="font-medium text-slate-800 text-sm tracking-tight">PesanMeja</span>
            </div>

            <div class="w-full max-w-sm mx-auto my-auto py-4">
                <div class="space-y-1 mb-5">
                    <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Create an account</h1>
                    <p class="text-xs text-slate-400 font-medium">Start your experience with us</p>
                </div>

                @if (session('success'))
                    <div
                        class="mb-4 p-3 bg-emerald-50 border border-emerald-100 rounded-lg text-emerald-800 text-xs font-medium">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="space-y-3.5">
                    @csrf

                    <!-- Input Nama Lengkap -->
                    <div class="space-y-1">
                        <label for="name"
                            class="text-[11px] font-semibold text-slate-600 tracking-wide uppercase">Full Name</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required
                            autofocus autocomplete="name" placeholder="Enter your full name"
                            class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-lg text-slate-800 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-xs transition-all shadow-sm" />

                        <x-input-error :messages="$errors->get('name')" class="mt-1 text-[11px] text-rose-500 font-medium" />
                    </div>

                    <!-- Input Email -->
                    <div class="space-y-1">
                        <label for="email"
                            class="text-[11px] font-semibold text-slate-600 tracking-wide uppercase">Email
                            address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            autocomplete="username" placeholder="Enter your email"
                            class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-lg text-slate-800 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-xs transition-all shadow-sm" />

                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-[11px] text-rose-500 font-medium" />
                    </div>

                    <!-- Input Nomor Telepon -->
                    <div class="space-y-1">
                        <label for="phone_number"
                            class="text-[11px] font-semibold text-slate-600 tracking-wide uppercase">Phone
                            Number</label>
                        <input id="phone_number" type="text" name="phone_number" value="{{ old('phone_number') }}"
                            required placeholder="e.g. 08123456789"
                            class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-lg text-slate-800 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-xs transition-all shadow-sm" />

                        <x-input-error :messages="$errors->get('phone_number')" class="mt-1 text-[11px] text-rose-500 font-medium" />
                    </div>

                    <!-- Input Password -->
                    <div class="space-y-1">
                        <label for="password"
                            class="text-[11px] font-semibold text-slate-600 tracking-wide uppercase">Password</label>
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                            placeholder="Create a password"
                            class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-lg text-slate-800 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-xs transition-all shadow-sm" />

                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-[11px] text-rose-500 font-medium" />
                    </div>

                    <!-- Input Konfirmasi Password -->
                    <div class="space-y-1">
                        <label for="password_confirmation"
                            class="text-[11px] font-semibold text-slate-600 tracking-wide uppercase">Confirm
                            Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                            autocomplete="new-password" placeholder="Repeat your password"
                            class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-lg text-slate-800 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-xs transition-all shadow-sm" />

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-[11px] text-rose-500 font-medium" />
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="pt-1">
                        <button type="submit"
                            class="w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-xs rounded-lg shadow-sm transition-all duration-150">
                            Register
                        </button>
                    </div>
                </form>

                <!-- Footer Akses Login & Cek Status -->
                <div class="text-center mt-5 text-[11px] text-slate-500 font-medium space-y-3">
                    <div>
                        Already registered?
                        <a href="{{ route('login') }}"
                            class="text-indigo-600 hover:text-indigo-700 font-medium transition-colors underline underline-offset-2">
                            Sign in
                        </a>
                    </div>

                    <div
                        class="pt-5 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-center gap-1">
                        <span class="text-slate-400">Ingin tahu progres verifikasi?</span>
                        <a href="{{ route('account.status') }}"
                            class="text-purple-600 hover:text-purple-700 font-medium transition-colors inline-flex items-center gap-0.5">
                            Cek Status Akun Saya <i class="fa-solid fa-arrow-right text-[9px]"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Footer Hak Cipta -->
            <div class="text-[10px] text-slate-400 font-medium text-center lg:text-left">
                &copy; 2026 PesanMeja. All rights reserved.
            </div>

        </div>

        <div
            class="hidden lg:flex w-1/2 bg-gradient-to-br from-indigo-50 to-indigo-100 items-center justify-center relative p-12 overflow-hidden">

            <div class="absolute inset-0 z-0 pointer-events-none">
                <svg class="absolute -top-10 -right-10 w-96 h-96 text-indigo-200/50" fill="currentColor"
                    viewBox="0 0 200 200">
                    <path
                        d="M47.5,-15.7C55.3,-1.2,51.1,23.5,36.5,36.8C21.9,50.1,-3.1,52,-21.9,42.8C-40.7,33.5,-53.3,13.1,-49.4,0.3C-45.5,-12.5,-25,-17.7,-8.4,-23.5C8.2,-29.3,39.7,-30.1,47.5,-15.7Z"
                        transform="translate(100 100)" />
                </svg>
            </div>

            <!-- Konten Ilustrasi Minimalis -->
            <div class="relative z-10 flex flex-col items-center justify-center text-center space-y-6 max-w-sm">
                <div
                    class="w-56 h-56 rounded-2xl bg-white/80 backdrop-blur-md border border-white/40 flex items-center justify-center shadow-lg shadow-indigo-100/30">
                    <i class="fa-solid fa-mug-hot text-5xl text-indigo-500"></i>
                </div>
                <div class="space-y-2">
                    <h3 class="text-lg font-medium text-slate-800">Seduh Harimu di PesanMeja</h3>
                    <p class="text-xs text-slate-500 leading-relaxed max-w-xs">Temukan ruang kerja ternyaman, nikmati
                        kopi hangat terbaik, dan amankan meja reservasi Anda dengan mudah.</p>
                </div>
            </div>

        </div>

    </div>

</body>

</html>
