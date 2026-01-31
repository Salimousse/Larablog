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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gray-100 dark:bg-gray-900 min-h-screen flex flex-col">

        <!-- Header -->
        <header class="bg-white dark:bg-gray-800 shadow py-4 px-6 flex items-center justify-between">
            @auth
                @include('layouts.navigation')
            @endauth

            @guest
                @if (Route::has('login') || Route::has('register'))
                    <nav class="flex items-center justify-end gap-4">
                        @if (Route::has('login') && ! request()->routeIs('login'))
                            <a href="{{ route('login') }}" class="inline-block px-5 py-1.5 text-[#1b1b18] dark:text-[#EDEDEC] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal">Se connecter</a>
                        @endif

                        @if (Route::has('register') && ! request()->routeIs('register'))
                            <a href="{{ route('register') }}" class="inline-block px-5 py-1.5 bg-[#1b1b18] text-white rounded-sm text-sm leading-normal hover:bg-black dark:bg-[#EDEDEC] dark:text-[#1b1b18]">S'inscrire</a>
                        @endif
                    </nav>
                @endif
            @endguest
        </header>

        <!-- Main Content -->
        <main class="flex-1 w-full max-w-4xl mx-auto py-8 px-4">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="bg-white dark:bg-gray-800 shadow py-4 px-6 text-center text-gray-500 dark:text-gray-400">
            &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. Tous droits réservés.
        </footer>
    </body>
</html>
