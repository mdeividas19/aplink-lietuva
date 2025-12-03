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
                <div class="text-2xl font-semibold font-serif">
                    <a href="{{ route('main') }}" class="hover:underline">Aplink Lietuva</a>
                    <span class="text-stone-400 mx-1">|</span>
                    <a href="{{ route('stories.index') }}" class="hover:underline">Istorijos</a>
                </div>
                <nav class="flex items-center gap-3 text-sm">
                    <a href="{{ route('stories.map') }}">Istorijų žemėlapis</a>
                    @auth
                        @can('create-story')
                            <a href="{{ route('stories.create') }}"
                            class="px-3 py-1.5 rounded-full bg-stone-900 text-white hover:opacity-90">
                                Nauja istorija
                            </a>
                        @endcan

                        <a href="{{ route('profile.edit') }}"
                        class="px-3 py-1.5 rounded-md border border-stone-300 hover:bg-stone-50">
                            Profilis
                        </a>

                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                    class="px-3 py-1.5 rounded-md border border-stone-300 hover:bg-stone-50">
                                Atsijungti
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                        class="px-3 py-1.5 rounded-md border border-stone-300 hover:bg-stone-50">
                            Prisijungti
                        </a>

                        <a href="{{ route('register') }}"
                        class="px-3 py-1.5 rounded-md border border-stone-300 hover:bg-stone-50">
                            Registruotis
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
