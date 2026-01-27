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
                @if (Route::has('login'))
                    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>
                    </div>
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
