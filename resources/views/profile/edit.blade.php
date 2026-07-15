<x-app-layout>
    <div class="w-full max-w-5xl mx-auto space-y-6 md:space-y-8 px-4 py-8">

        <!-- PAGE HEADER -->
        <div class="flex flex-col gap-1 border-b border-slate-100 pb-5">
            <span class="text-[10px] font-medium uppercase tracking-wider text-blue-600">Pengaturan</span>
            <h2 class="font-medium text-xl text-slate-800 leading-tight">
                {{ __('Kelola Profil & Keamanan') }}
            </h2>
            <p class="text-[11px] text-slate-400 mt-0.5">Perbarui detail identitas akun Anda dan amankan akses login Anda
                di sini.</p>
        </div>

        <!-- NOTIFICATION ALERTS -->
        @if (session('status') === 'profile-updated' || session('status') === 'password-updated')
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-transition
                class="flex items-center gap-3 p-4 bg-emerald-50 border border-emerald-200/50 rounded-xl text-emerald-800 text-xs font-medium">
                <i class="fa-solid fa-circle-check text-sm text-emerald-500"></i>
                <span>{{ session('status') === 'profile-updated' ? 'Informasi profil berhasil diperbarui!' : 'Kata sandi Anda berhasil diperbarui!' }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8 items-start">

            <!-- LEFT COLUMN: USER BADGE & STATUS INFO -->
            <div class="bg-white p-6 border border-slate-200 rounded-2xl shadow-sm space-y-6">
                <div class="flex flex-col items-center text-center space-y-3">
                    <!-- Avatar Badge -->
                    <div
                        class="w-20 h-20 rounded-2xl bg-blue-50 border border-blue-100 flex items-center justify-center font-bold text-blue-600 text-2xl shadow-inner">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>
                    <div>
                        <h3 class="font-semibold text-slate-800 text-base">{{ $user->name }}</h3>
                        <p class="text-xs text-slate-400 font-normal">{{ $user->email }}</p>
                    </div>
                </div>

                <hr class="border-slate-100" />

                <!-- Detail Meta User -->
                <div class="space-y-3">
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-slate-400 font-medium">Kode Pelanggan</span>
                        <span
                            class="font-mono font-semibold text-slate-700 bg-slate-50 px-2 py-0.5 rounded border border-slate-200">
                            {{ $user->customer_code ?? 'BELUM DI-GENERATE' }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-slate-400 font-medium">Peran Akses</span>
                        <span
                            class="font-semibold text-slate-700 uppercase bg-slate-50 px-2 py-0.5 rounded border border-slate-200">
                            {{ $user->role }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-slate-400 font-medium">Status Akun</span>
                        @if ($user->status_verifikasi === 'active')
                            <span
                                class="px-2.5 py-0.5 font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200/50 rounded-full text-[10px]">VERIFIED</span>
                        @else
                            <span
                                class="px-2.5 py-0.5 font-semibold bg-amber-50 text-amber-700 border border-amber-200/50 rounded-full text-[10px] uppercase">{{ $user->status_verifikasi }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN: COMBINED EDIT FORMS (PROFILE & PASSWORD) -->
            <div class="lg:col-span-2 space-y-6 md:space-y-8">

                <!-- 1. FORM EDIT PROFILE -->
                <div class="bg-white p-6 border border-slate-200 rounded-2xl shadow-sm">
                    <div class="border-b border-slate-100 pb-4 mb-5">
                        <h3 class="font-semibold text-slate-800 text-base">Informasi Profil</h3>
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
                                class="w-full px-3.5 py-2.5 text-xs border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 font-medium text-slate-700"
                                value="{{ old('name', $user->name) }}" required autofocus />
                            @if ($errors->get('name'))
                                <p class="text-[11px] text-rose-500 font-medium mt-1">{{ $errors->get('name')[0] }}</p>
                            @endif
                        </div>

                        <!-- Input Email -->
                        <div class="space-y-1.5">
                            <label for="email" class="text-xs font-semibold text-slate-700">Alamat Email</label>
                            <input id="email" name="email" type="email"
                                class="w-full px-3.5 py-2.5 text-xs border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 font-medium text-slate-700"
                                value="{{ old('email', $user->email) }}" required />
                            @if ($errors->get('email'))
                                <p class="text-[11px] text-rose-500 font-medium mt-1">{{ $errors->get('email')[0] }}
                                </p>
                            @endif
                        </div>

                        <!-- Input Nomor Telepon (Field Baru) -->
                        <div class="space-y-1.5">
                            <label for="phone_number" class="text-xs font-semibold text-slate-700">Nomor Telepon</label>
                            <input id="phone_number" name="phone_number" type="text"
                                class="w-full px-3.5 py-2.5 text-xs border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 font-medium text-slate-700"
                                value="{{ old('phone_number', $user->phone_number) }}" required
                                placeholder="Contoh: 08123456789" />
                            @if ($errors->get('phone_number'))
                                <p class="text-[11px] text-rose-500 font-medium mt-1">
                                    {{ $errors->get('phone_number')[0] }}</p>
                            @endif
                        </div>

                        <div class="flex justify-end pt-3">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold text-xs uppercase tracking-wider transition duration-150 shadow-sm cursor-pointer">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>

                <!-- 2. FORM GANTI PASSWORD -->
                <div id="change-password" class="bg-white p-6 border border-slate-200 rounded-2xl shadow-sm">
                    <div class="border-b border-slate-100 pb-4 mb-5">
                        <h3 class="font-semibold text-slate-800 text-base">Ganti Kata Sandi</h3>
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
                                class="w-full px-3.5 py-2.5 text-xs border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 font-medium text-slate-700"
                                autocomplete="current-password" required />
                            @if ($errors->updatePassword->get('current_password'))
                                <p class="text-[11px] text-rose-500 font-medium mt-1">
                                    {{ $errors->updatePassword->get('current_password')[0] }}</p>
                            @endif
                        </div>

                        <!-- Password Baru -->
                        <div class="space-y-1.5">
                            <label for="update_password_password" class="text-xs font-semibold text-slate-700">Kata
                                Sandi Baru</label>
                            <input id="update_password_password" name="password" type="password"
                                class="w-full px-3.5 py-2.5 text-xs border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 font-medium text-slate-700"
                                autocomplete="new-password" required />
                            @if ($errors->updatePassword->get('password'))
                                <p class="text-[11px] text-rose-500 font-medium mt-1">
                                    {{ $errors->updatePassword->get('password')[0] }}</p>
                            @endif
                        </div>

                        <!-- Konfirmasi Password Baru -->
                        <div class="space-y-1.5">
                            <label for="update_password_password_confirmation"
                                class="text-xs font-semibold text-slate-700">Konfirmasi Kata Sandi Baru</label>
                            <input id="update_password_password_confirmation" name="password_confirmation"
                                type="password"
                                class="w-full px-3.5 py-2.5 text-xs border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 font-medium text-slate-700"
                                autocomplete="new-password" required />
                            @if ($errors->updatePassword->get('password_confirmation'))
                                <p class="text-[11px] text-rose-500 font-medium mt-1">
                                    {{ $errors->updatePassword->get('password_confirmation')[0] }}</p>
                            @endif
                        </div>

                        <div class="flex justify-end pt-3">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-slate-900 hover:bg-slate-800 text-white rounded-lg font-semibold text-xs uppercase tracking-wider transition duration-150 shadow-sm cursor-pointer">
                                Perbarui Sandi
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </div>
</x-app-layout>
