<x-app-layout>
    <div class="w-full max-w-5xl mx-auto space-y-8 py-8 select-none">

        <!-- SLOT HEADER COMPATIBILITY -->
        <x-slot name="headerTitle">Pengaturan Profil</x-slot>
        <x-slot name="header">
            <div class="flex flex-col gap-1 border-b border-slate-100 pb-5">
                <span class="text-[10px] font-medium uppercase tracking-wider text-indigo-600 block">Pengaturan</span>
                <x-page-header title="Kelola Profil & Keamanan"
                    subtitle="Perbarui detail identitas akun Anda dan amankan akses login Anda di sini.">
                </x-page-header>
            </div>
        </x-slot>

        <!-- NOTIFICATION ALERTS -->
        @if (session('status') === 'profile-updated' || session('status') === 'password-updated')
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-transition
                class="flex items-center gap-3 p-4 bg-emerald-50 border border-emerald-200/50 rounded-xl text-emerald-800 text-xs font-semibold shadow-xs">
                <i class="fa-solid fa-circle-check text-sm text-emerald-500"></i>
                <span>{{ session('status') === 'profile-updated' ? 'Informasi profil berhasil diperbarui!' : 'Kata sandi Anda berhasil diperbarui!' }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8 items-start">

            <!-- LEFT COLUMN: USER BADGE & STATUS INFO -->
            <div class="bg-white p-6 border border-slate-200/60 rounded-2xl shadow-xs space-y-6">
                <div class="flex flex-col items-center text-center space-y-3.5">
                    <!-- Avatar Badge -->
                    <div
                        class="w-20 h-20 rounded-2xl bg-slate-50 border border-slate-200 flex items-center justify-center font-bold text-slate-700 text-2xl shadow-xs">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>
                    <div class="space-y-0.5">
                        <h3 class="font-semibold text-slate-800 text-base tracking-tight">{{ $user->name }}</h3>
                        <p class="text-xs text-slate-400 font-medium">{{ $user->email }}</p>
                    </div>
                </div>

                <hr class="border-slate-100" />

                <!-- Detail Meta User -->
                <div class="space-y-3.5">
                    <div class="flex items-center justify-between text-xs font-medium">
                        <span class="text-slate-400">Kode Pelanggan</span>
                        <span
                            class="font-mono font-bold text-slate-700 bg-slate-50 px-2 py-0.5 border border-slate-200 rounded-md tracking-wide">
                            {{ $user->customer_code ?? 'BELUM DI-GENERATE' }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between text-xs font-medium">
                        <span class="text-slate-400">Peran Akses</span>
                        <span
                            class="font-bold text-slate-600 uppercase bg-slate-50 px-2 py-0.5 border border-slate-200 rounded-md tracking-wide">
                            {{ $user->role }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between text-xs font-medium">
                        <span class="text-slate-400">Status Akun</span>
                        @if ($user->status_verifikasi === 'active')
                            <span
                                class="inline-flex items-center gap-1 px-2.5 py-0.5 font-bold bg-emerald-50 border border-emerald-100 text-emerald-600 rounded-full text-[10px] tracking-wide uppercase">
                                <span class="w-1 h-1 rounded-full bg-emerald-400 animate-pulse"></span>
                                Verified
                            </span>
                        @else
                            <span
                                class="inline-flex items-center gap-1 px-2.5 py-0.5 font-bold bg-amber-50 border border-amber-100 text-amber-600 rounded-full text-[10px] tracking-wide uppercase">
                                <span class="w-1 h-1 rounded-full bg-amber-400 animate-pulse"></span>
                                {{ $user->status_verifikasi }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN: COMBINED EDIT FORMS (PROFILE & PASSWORD) -->
            <div class="lg:col-span-2 space-y-6 md:space-y-8">

                <!-- 1. FORM EDIT PROFILE -->
                <div class="bg-white p-6 border border-slate-200/60 rounded-2xl shadow-xs">
                    <div class="border-b border-slate-100 pb-4 mb-5">
                        <h3 class="font-semibold text-slate-800 text-sm md:text-base tracking-tight">Informasi Profil
                        </h3>
                        <p class="text-[11px] text-slate-400 mt-0.5">Perbarui nama lengkap, alamat email, dan nomor
                            telepon aktif Anda.</p>
                    </div>

                    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
                        @csrf
                        @method('patch')

                        <!-- Input Nama -->
                        <div class="space-y-1.5">
                            <label for="name" class="text-xs font-semibold text-slate-700">Nama Lengkap</label>
                            <input id="name" name="name" type="text"
                                class="w-full px-3.5 py-2.5 text-xs border border-slate-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/10 focus:border-indigo-500 font-medium text-slate-700 transition"
                                value="{{ old('name', $user->name) }}" required autofocus />
                            @if ($errors->get('name'))
                                <p class="text-[11px] text-rose-500 font-medium mt-1"><i
                                        class="fa-solid fa-circle-exclamation mr-1"></i>{{ $errors->get('name')[0] }}
                                </p>
                            @endif
                        </div>

                        <!-- Input Email -->
                        <div class="space-y-1.5">
                            <label for="email" class="text-xs font-semibold text-slate-700">Alamat Email</label>
                            <input id="email" name="email" type="email"
                                class="w-full px-3.5 py-2.5 text-xs border border-slate-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/10 focus:border-indigo-500 font-medium text-slate-700 transition"
                                value="{{ old('email', $user->email) }}" required />
                            @if ($errors->get('email'))
                                <p class="text-[11px] text-rose-500 font-medium mt-1"><i
                                        class="fa-solid fa-circle-exclamation mr-1"></i>{{ $errors->get('email')[0] }}
                                </p>
                            @endif
                        </div>

                        <!-- Input Nomor Telepon -->
                        <div class="space-y-1.5">
                            <label for="phone_number" class="text-xs font-semibold text-slate-700">Nomor Telepon</label>
                            <input id="phone_number" name="phone_number" type="text"
                                class="w-full px-3.5 py-2.5 text-xs border border-slate-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/10 focus:border-indigo-500 font-medium text-slate-700 transition"
                                value="{{ old('phone_number', $user->phone_number) }}" required
                                placeholder="Contoh: 08123456789" />
                            @if ($errors->get('phone_number'))
                                <p class="text-[11px] text-rose-500 font-medium mt-1"><i
                                        class="fa-solid fa-circle-exclamation mr-1"></i>{{ $errors->get('phone_number')[0] }}
                                </p>
                            @endif
                        </div>

                        <div class="flex justify-end pt-2">
                            <button type="submit"
                                class="h-9 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-[11px] md:text-xs rounded-lg inline-flex items-center justify-center tracking-wide shadow-sm transition-all active:scale-[0.97] cursor-pointer">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>

                <!-- 2. FORM GANTI PASSWORD -->
                <div id="change-password" class="bg-white p-6 border border-slate-200/60 rounded-2xl shadow-xs">
                    <div class="border-b border-slate-100 pb-4 mb-5">
                        <h3 class="font-semibold text-slate-800 text-sm md:text-base tracking-tight">Ganti Kata Sandi
                        </h3>
                        <p class="text-[11px] text-slate-400 mt-0.5">Pastikan akun Anda menggunakan kata sandi yang kuat
                            dan acak agar tetap aman.</p>
                    </div>

                    <form method="post" action="{{ route('password.update') }}" class="space-y-5">
                        @csrf
                        @method('put')

                        <!-- Password Lama -->
                        <div class="space-y-1.5">
                            <label for="update_password_current_password"
                                class="text-xs font-semibold text-slate-700">Kata Sandi Saat Ini</label>
                            <input id="update_password_current_password" name="current_password" type="password"
                                class="w-full px-3.5 py-2.5 text-xs border border-slate-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/10 focus:border-indigo-500 font-medium text-slate-700 transition"
                                autocomplete="current-password" required />
                            @if ($errors->updatePassword->get('current_password'))
                                <p class="text-[11px] text-rose-500 font-medium mt-1"><i
                                        class="fa-solid fa-circle-exclamation mr-1"></i>{{ $errors->updatePassword->get('current_password')[0] }}
                                </p>
                            @endif
                        </div>

                        <!-- Password Baru -->
                        <div class="space-y-1.5">
                            <label for="update_password_password" class="text-xs font-semibold text-slate-700">Kata
                                Sandi Baru</label>
                            <input id="update_password_password" name="password" type="password"
                                class="w-full px-3.5 py-2.5 text-xs border border-slate-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/10 focus:border-indigo-500 font-medium text-slate-700 transition"
                                autocomplete="new-password" required />
                            @if ($errors->updatePassword->get('password'))
                                <p class="text-[11px] text-rose-500 font-medium mt-1"><i
                                        class="fa-solid fa-circle-exclamation mr-1"></i>{{ $errors->updatePassword->get('password')[0] }}
                                </p>
                            @endif
                        </div>

                        <!-- Konfirmasi Password Baru -->
                        <div class="space-y-1.5">
                            <label for="update_password_password_confirmation"
                                class="text-xs font-semibold text-slate-700">Konfirmasi Kata Sandi Baru</label>
                            <input id="update_password_password_confirmation" name="password_confirmation"
                                type="password"
                                class="w-full px-3.5 py-2.5 text-xs border border-slate-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/10 focus:border-indigo-500 font-medium text-slate-700 transition"
                                autocomplete="new-password" required />
                            @if ($errors->updatePassword->get('password_confirmation'))
                                <p class="text-[11px] text-rose-500 font-medium mt-1"><i
                                        class="fa-solid fa-circle-exclamation mr-1"></i>{{ $errors->updatePassword->get('password_confirmation')[0] }}
                                </p>
                            @endif
                        </div>

                        <div class="flex justify-end pt-2">
                            <button type="submit"
                                class="h-9 px-4 bg-slate-900 hover:bg-slate-800 text-white font-semibold text-[11px] md:text-xs rounded-lg inline-flex items-center justify-center tracking-wide shadow-sm transition-all active:scale-[0.97] cursor-pointer">
                                Perbarui Sandi
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </div>
</x-app-layout>
