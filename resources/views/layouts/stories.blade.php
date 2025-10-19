<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Istorijos – {{ config('app.name', 'Aplink Lietuvą') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-stone-50 text-stone-900">
        <header class="sticky top-0 z-40 bg-white/80 backdrop-blur border-b">
            <div class="max-w-6xl mx-auto flex items-center justify-between p-4">
                <a href="{{ route('main') }}" class="text-2xl font-semibold font-serif">Istorijos | Aplink Lietuva</a>
                <nav class="flex items-center gap-4 text-sm">
                    @auth
                        <a href="{{ route('stories.create') }}" class="px-3 py-1.5 rounded-full bg-stone-900 text-white hover:opacity-90">
                            Nauja istorija
                        </a>
                    @endauth
                </nav>
            </div>
        </header>

        <main class="max-w-6xl mx-auto p-4 md:p-8">
            {{ $slot }}
        </main>
    </body>
</html>