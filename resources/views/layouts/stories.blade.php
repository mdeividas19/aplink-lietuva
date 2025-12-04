<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Aplink Lietuvą') }} - Istorijos</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .lightbox-overlay {
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.8);
                backdrop-filter: blur(4px);
                display: none;
                align-items: center;
                justify-content: center;
                z-index: 9999; /* above navbar */
                padding: 1rem;
            }
            .lightbox-overlay:target {
                display: flex;
            }
            .lightbox-overlay img {
                max-width: 90vw;
                max-height: 90vh;
                border-radius: 1rem;
                box-shadow: 0 12px 40px rgba(0,0,0,0.5);
                background: #111;
            }
        </style>
    </head>
    <body class="antialiased bg-stone-50 text-stone-900">
        <header class="sticky top-0 z-40 bg-white/70 backdrop-blur-md border-b border-stone-200 shadow-sm">

            <div class="max-w-6xl mx-auto flex items-center justify-between px-4 py-3">

                <div class="flex items-center gap-6">
                    <a href="{{ route('main') }}"
                    class="text-2xl font-serif font-semibold tracking-tight hover:text-stone-700 transition">
                        Aplink Lietuvą
                    </a>

                    <nav class="hidden md:flex items-center gap-5 text-sm">
                        <a href="{{ route('stories.index') }}"
                        class="text-stone-600 hover:text-stone-900 transition">
                            Istorijos
                        </a>

                        <a href="{{ route('stories.map') }}"
                        class="text-stone-600 hover:text-stone-900 transition">
                            Žemėlapis
                        </a>
                    </nav>
                </div>

                <nav class="flex items-center gap-3 text-sm">

                    @auth
                        @can('create-story')
                            <a href="{{ route('stories.create') }}"
                            class="px-4 py-1.5 rounded-full bg-stone-900 text-white shadow hover:bg-stone-800 transition">
                                Nauja istorija
                            </a>
                        @endcan

                        <a href="{{ route('profile.edit') }}"
                        class="px-3 py-1.5 rounded-md border border-stone-300 bg-white hover:bg-stone-100 transition">
                            Profilis
                        </a>

                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                    class="px-3 py-1.5 rounded-md border border-stone-300 bg-white hover:bg-stone-100 transition">
                                Atsijungti
                            </button>
                        </form>

                    @else
                        <a href="{{ route('login') }}"
                        class="px-3 py-1.5 rounded-md border border-stone-300 bg-white hover:bg-stone-100 transition">
                            Prisijungti
                        </a>

                        <a href="{{ route('register') }}"
                        class="px-3 py-1.5 rounded-md border border-stone-300 bg-white hover:bg-stone-100 transition">
                            Registruotis
                        </a>
                    @endauth

                </nav>
            </div>
        </header>

        <main class="max-w-6xl mx-auto p-4 md:p-8 pt-24">
            {{ $slot }}
        </main>
    </body>
</html>
