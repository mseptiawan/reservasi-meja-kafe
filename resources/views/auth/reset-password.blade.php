<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password | Senja Space</title>

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
    class="antialiased min-h-screen bg-slate-50 flex items-center justify-center p-4 font-['Plus_Jakarta_Sans'] selection:bg-indigo-500 selection:text-white">

    <div
        class="w-full max-w-md bg-white border border-slate-100 rounded-2xl shadow-xl shadow-slate-100/70 p-8 space-y-6">

        <!-- Header -->
        <div class="flex flex-col items-center text-center space-y-4">
            <div
                class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-indigo-500 to-purple-500 flex items-center justify-center text-white shadow-md shadow-indigo-100">
                <i class="fa-solid fa-shield-halved text-lg"></i>
            </div>
            <div class="space-y-1">
                <h1 class="text-xl font-extrabold text-slate-900 tracking-tight">Create new password</h1>
                <p class="text-xs text-slate-400 font-medium px-4 leading-relaxed">
                    Please enter your email and set your new secure password.
                </p>
            </div>
        </div>

        <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div class="space-y-1.5">
                <label for="email" class="text-xs font-semibold text-slate-700 tracking-wide uppercase">Email
                    address</label>
                <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required
                    autofocus autocomplete="username" placeholder="Enter your email"
                    class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-sm transition-all shadow-sm" />

                <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-rose-500 font-medium" />
            </div>

            <!-- Password -->
            <div class="space-y-1.5">
                <label for="password" class="text-xs font-semibold text-slate-700 tracking-wide uppercase">New
                    Password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                    placeholder="••••••••"
                    class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-sm transition-all shadow-sm" />

                <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-rose-500 font-medium" />
            </div>

            <!-- Confirm Password -->
            <div class="space-y-1.5">
                <label for="password_confirmation"
                    class="text-xs font-semibold text-slate-700 tracking-wide uppercase">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    autocomplete="new-password" placeholder="••••••••"
                    class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-sm transition-all shadow-sm" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs text-rose-500 font-medium" />
            </div>

            <!-- Action Button -->
            <div class="pt-2">
                <button type="submit"
                    class="w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm rounded-xl shadow-md shadow-indigo-100 hover:shadow-lg transition-all duration-150">
                    Reset Password
                </button>
            </div>
        </form>

    </div>

</body>

</html>
