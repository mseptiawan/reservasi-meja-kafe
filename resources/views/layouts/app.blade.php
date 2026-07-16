<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<body class="font-sans antialiased bg-slate-50" x-data="{ sidebarOpen: false }">

    <div x-cloak x-show="sidebarOpen" @click="sidebarOpen = false" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs z-[90] md:hidden">
    </div>

    <div class="flex min-h-screen p-0 md:p-4 gap-0 md:gap-4 md:pl-20 xl:pl-[280px]">

        <!-- SIDEBAR NAVIGATION -->
        @include('layouts.navigation')

        <!-- MAIN CONTENT AREA -->
        <div class="flex-1 flex flex-col min-w-0 w-full">

            <div
                class="flex md:hidden items-center justify-between px-6 h-16 bg-white border-b border-slate-100 shrink-0 sticky top-0 z-40">
                <div class="flex items-center gap-3">
                    <button @click="sidebarOpen = true" type="button"
                        class="p-2 -ml-2 rounded-xl text-slate-600 active:scale-95 hover:bg-slate-50 transition-all cursor-pointer">
                        <i class="fa-solid fa-bars text-lg"></i>
                    </button>
                    <div>
                        <h2 class="font-semibold text-slate-800 text-xs">
                            @isset($headerTitle)
                                {{ $headerTitle }}
                            @else
                                Lsp Proyek
                            @endisset
                        </h2>
                    </div>
                </div>
            </div>

            @isset($header)
                <header class="hidden md:block px-5 md:px-8 pt-5 md:pt-8">
                    <div class="max-w-7xl mx-auto">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="flex-1 p-5 md:p-8">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>
