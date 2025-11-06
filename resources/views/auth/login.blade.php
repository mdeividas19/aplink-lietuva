<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="/img/vilnius-main.jpg" alt="Lithuanian Landscape" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-br from-baltic-blue/65 via-amber-400/55 to-forest-green/70"></div>
        </div>

        <div class="absolute top-0 right-0 w-96 h-96 bg-baltic-blue/25 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-amber-400/30 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-white/10 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>

        <div class="relative z-10 w-full max-w-md">
            <div class="text-center mb-8 animate-fade-in">
                <a href="{{ route('main') }}" class="inline-block">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-br from-amber-400 to-amber-600 rounded-3xl mb-4 shadow-2xl transform hover:scale-105 transition-transform duration-300">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                </a>
                <h2 class="text-4xl font-bold text-white mb-3 drop-shadow-lg">Prisijungimas</h2>
                <p class="text-lg text-amber-50 drop-shadow">Sveiki sugrįžę į Aplink Lietuvą</p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <div class="bg-white shadow-2xl rounded-3xl p-8 border border-amber-200/20">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-5">
                        <x-input-label for="email" :value="__('El. paštas')" class="block text-sm font-bold text-gray-800 mb-2" />
                        <x-text-input id="email" 
                                    class="block w-full px-4 py-3.5 bg-white border-2 border-gray-300 rounded-xl text-gray-900 placeholder-gray-500 focus:border-amber-500 focus:ring-4 focus:ring-amber-400/30 transition-all duration-200 hover:border-gray-400" 
                                    type="email" 
                                    name="email" 
                                    :value="old('email')" 
                                    required 
                                    autofocus 
                                    autocomplete="username" 
                                    placeholder="vardas@email.lt" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600 font-medium" />
                    </div>

                    <div class="mb-5">
                        <x-input-label for="password" :value="__('Slaptažodis')" class="block text-sm font-bold text-gray-800 mb-2" />
                        <x-text-input id="password" 
                                    class="block w-full px-4 py-3.5 bg-white border-2 border-gray-300 rounded-xl text-gray-900 placeholder-gray-500 focus:border-amber-500 focus:ring-4 focus:ring-amber-400/30 transition-all duration-200 hover:border-gray-400"
                                    type="password"
                                    name="password"
                                    required 
                                    autocomplete="current-password" 
                                    placeholder="Jūsų slaptažodis" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600 font-medium" />
                    </div>

                    <div class="flex items-center justify-between mb-6">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                            <input id="remember_me" 
                                   type="checkbox" 
                                   class="rounded border-gray-300 text-amber-500 shadow-sm focus:ring-amber-500 focus:ring-2 cursor-pointer transition-all w-4 h-4" 
                                   name="remember">
                            <span class="ms-2 text-sm text-gray-700 font-semibold group-hover:text-amber-600 transition-colors">{{ __('Prisiminti mane') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm font-semibold text-gray-700 hover:text-amber-600 transition-colors duration-200 underline-offset-2 hover:underline" href="{{ route('password.request') }}">
                                {{ __('Pamiršote slaptažodį?') }}
                            </a>
                        @endif
                    </div>

                    <div class="flex flex-col space-y-4">
                        <x-primary-button class="w-full justify-center px-6 py-4 bg-gradient-to-r from-amber-400 to-amber-600 hover:from-amber-500 hover:to-amber-700 text-white font-bold rounded-xl shadow-xl hover:shadow-2xl transform hover:scale-[1.03] transition-all duration-200 text-base">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            {{ __('Prisijungti') }}
                        </x-primary-button>

                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-4 bg-white text-gray-500 font-medium">arba</span>
                            </div>
                        </div>

                        <div class="text-center pt-2">
                            <a class="inline-flex items-center text-sm font-semibold text-gray-700 hover:text-amber-600 transition-colors duration-200 group" href="{{ route('register') }}">
                                <svg class="w-4 h-4 mr-2 transform group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg>
                                {{ __('Neturite paskyros? Registruokitės') }}
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="mt-6 text-center">
                <p class="text-sm text-white drop-shadow flex items-center justify-center">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                    Saugus prisijungimas su šifravimu
                </p>
            </div>
        </div>
    </div>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fade-in {
            animation: fade-in 0.6s ease-out;
        }
    </style>
</x-guest-layout>