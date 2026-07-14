<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
   <body class="font-sans antialiased bg-slate-100/50" x-data x-init="$store.sidebar = { open: false }">
        
        <!-- PENTING: Tambahkan margin-left seukuran sidebar di breakpoint tertentu -->
        <div class="flex min-h-screen p-4 gap-4 md:pl-20 xl:pl-[280px]">
            @include('layouts.navigation')

            <!-- Page Heading & Content -->
            <div class="flex-1 flex flex-col min-w-0">
                @isset($header)
                    <header class="mb-4">
                        <div class="max-w-7xl mx-auto py-5 px-6 flex items-center gap-4">
                            <!-- Tombol Hamburger khusus Mobile -->
                            <button @click="$store.sidebar.open = true" class="md:hidden p-2 rounded-xl border border-slate-100 hover:bg-slate-50 text-slate-600">
                                <i class="fa-solid fa-bars"></i>
                            </button>
                            
                            <div class="flex-1">
                                {{ $header }}
                            </div>
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main class="flex-1 p-8">
                    {{ $slot }}
                </main>
            </div>
        </div>
        @if(session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: "{{ session('success') }}",
                        icon: 'success',
                        confirmButtonColor: '#3085d6'
                    });
                });
            </script>
        @endif
    </body>
</html>
