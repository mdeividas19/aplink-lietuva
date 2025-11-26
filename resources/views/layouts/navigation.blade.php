<nav x-data="{ open: false, scrolled: false }"
     x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 20 })"
     :class="scrolled ? 'bg-white shadow-lg' : 'bg-white'"
     class="fixed w-full top-0 z-50 transition-all duration-300">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">

            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('main') }}" class="flex items-center group">
                    <div class="w-10 h-10 bg-gradient-to-br from-amber-500 to-amber-600 rounded-lg flex items-center justify-center mr-3 transform group-hover:scale-110 transition-transform duration-300 shadow-md">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <span class="text-xl font-bold bg-gradient-to-r from-forest-green to-baltic-blue bg-clip-text text-transparent">
                        Aplink Lietuvą
                    </span>
                </a>
            </div>

            <!-- Desktop Navigation Links -->
            <div class="hidden md:flex items-center space-x-1">
                <a href="{{ route('main') }}"
                   class="px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-200 {{ request()->routeIs('main') ? 'bg-forest-green text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    Pradžia
                </a>

                <a href="{{ route('map.index') }}"
                   class="px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-200 {{ request()->routeIs('map.*') ? 'bg-forest-green text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    Žemėlapis
                </a>

                <a href="{{ route('stories.index') }}"
                   class="px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-200 {{ request()->routeIs('stories.*') ? 'bg-forest-green text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    Istorijos
                </a>

                <a href="{{ route('locations.index') }}"
                   class="px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-200 {{ request()->routeIs('locations.index') ? 'bg-forest-green text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    Vietovės
                </a>

                <a href="{{ route('about') }}"
                   class="px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-200 {{ request()->routeIs('about') ? 'bg-forest-green text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    Apie
                </a>

                <a href="{{ route('contacts') }}"
                   class="px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-200 {{ request()->routeIs('contacts') ? 'bg-forest-green text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    Kontaktai
                </a>
            </div>

            <!-- Auth Buttons Desktop -->
            <div class="hidden md:flex items-center space-x-3">
                @auth
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-100 transition-all duration-200">
                            <div class="w-8 h-8 bg-gradient-to-br from-amber-500 to-amber-600 rounded-full flex items-center justify-center mr-2 shadow-sm">
                                <span class="text-white text-sm font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            </div>
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profilis') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('locations.favorites')">
                            {{ __('Mėgstamiausios vietovės') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Atsijungti') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                @else
                <a href="{{ route('login') }}"
                   class="px-5 py-2.5 text-sm font-semibold text-forest-green hover:bg-gray-100 rounded-lg transition-all duration-200">
                    Prisijungti
                </a>
                <a href="{{ route('register') }}"
                   class="px-5 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg transform hover:scale-105">
                    Registruotis
                </a>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button @click="open = !open"
                        class="inline-flex items-center justify-center p-2 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 transform scale-95"
         x-transition:enter-end="opacity-100 transform scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 transform scale-100"
         x-transition:leave-end="opacity-0 transform scale-95"
         class="md:hidden bg-white border-t border-gray-200 shadow-lg">

        <div class="px-4 pt-4 pb-3 space-y-2">
            <a href="{{ route('main') }}"
               class="block px-4 py-3 rounded-lg text-base font-semibold transition-all duration-200 {{ request()->routeIs('main') ? 'bg-forest-green text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                Pradžia
            </a>

            <a href="{{ route('stories.index') }}"
               class="block px-4 py-3 rounded-lg text-base font-semibold transition-all duration-200 {{ request()->routeIs('stories.*') ? 'bg-forest-green text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                Istorijos
            </a>

            <a href="{{ route('locations.index') }}"
               class="block px-4 py-3 rounded-lg text-base font-semibold transition-all duration-200 {{ request()->routeIs('locations.index') ? 'bg-forest-green text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                Vietovės
            </a>

            <a href="{{ route('about') }}"
               class="block px-4 py-3 rounded-lg text-base font-semibold transition-all duration-200 {{ request()->routeIs('about') ? 'bg-forest-green text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                Apie
            </a>

            <a href="{{ route('contacts') }}"
               class="block px-4 py-3 rounded-lg text-base font-semibold transition-all duration-200 {{ request()->routeIs('contacts') ? 'bg-forest-green text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                Kontaktai
            </a>
        </div>

        <!-- Mobile Auth Section -->
        @auth
        <div class="px-4 py-4 border-t border-gray-200 bg-gray-50">
            <div class="flex items-center mb-3">
                <div class="w-10 h-10 bg-gradient-to-br from-amber-500 to-amber-600 rounded-full flex items-center justify-center mr-3 shadow-sm">
                    <span class="text-white font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                </div>
                <div>
                    <div class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="space-y-2">
                <a href="{{ route('profile.edit') }}"
                   class="block px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-white transition-colors duration-200">
                    Profilis
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="w-full text-left px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-white transition-colors duration-200">
                        Atsijungti
                    </button>
                </form>
            </div>
        </div>
        @else
        <div class="px-4 py-4 border-t border-gray-200 bg-gray-50 space-y-2">
            <a href="{{ route('login') }}"
               class="block w-full text-center px-5 py-3 text-sm font-semibold text-forest-green bg-white hover:bg-gray-100 rounded-lg transition-all duration-200 shadow-sm">
                Prisijungti
            </a>
            <a href="{{ route('register') }}"
               class="block w-full text-center px-5 py-3 text-sm font-semibold text-white bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 rounded-lg transition-all duration-200 shadow-md">
                Registruotis
            </a>
        </div>
        @endauth
    </div>
</nav>

<!-- Spacer to prevent content from going under fixed navbar -->
<div class="h-20"></div>
