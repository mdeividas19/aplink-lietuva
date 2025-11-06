<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="/img/vilnius-main.jpg" alt="Lithuanian Landscape" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-br from-forest-green/80 via-baltic-blue/75 to-forest-green/80"></div>
        </div>

        <div class="absolute top-0 left-0 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-baltic-blue/10 rounded-full blur-3xl"></div>

        <div class="relative z-10 w-full max-w-md">
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-amber-500 to-amber-600 rounded-2xl mb-4 shadow-2xl">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <h2 class="text-3xl font-bold text-white mb-2">Registracija</h2>
                <p class="text-amber-100">Prisijunkite prie mūsų bendruomenės</p>
            </div>

            <div class="bg-white/95 backdrop-blur-sm shadow-2xl rounded-3xl p-8">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-6">
                        <x-input-label for="name" :value="__('Vardas')" class="block text-sm font-semibold text-gray-700 mb-2" />
                        <x-text-input id="name" 
                                    class="block w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 transition-all duration-200" 
                                    type="text" 
                                    name="name" 
                                    :value="old('name')" 
                                    required 
                                    autofocus 
                                    autocomplete="name" 
                                    />
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-600" />
                    </div>

                    <div class="mb-6">
                        <x-input-label for="email" :value="__('El. paštas')" class="block text-sm font-semibold text-gray-700 mb-2" />
                        <x-text-input id="email" 
                                    class="block w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 transition-all duration-200" 
                                    type="email" 
                                    name="email" 
                                    :value="old('email')" 
                                    required 
                                    autocomplete="username" 
                     />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
                    </div>

                    <div class="mb-6">
                        <x-input-label for="password" :value="__('Slaptažodis')" class="block text-sm font-semibold text-gray-700 mb-2" />
                        <x-text-input id="password" 
                                    class="block w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 transition-all duration-200"
                                    type="password"
                                    name="password"
                                    required 
                                    autocomplete="new-password" 
                                    placeholder="••••••••" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
                    </div>


                    <div class="mb-6">
                        <x-input-label for="password_confirmation" :value="__('Patvirtinkite slaptažodį')" class="block text-sm font-semibold text-gray-700 mb-2" />
                        <x-text-input id="password_confirmation" 
                                    class="block w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 transition-all duration-200"
                                    type="password"
                                    name="password_confirmation" 
                                    required 
                                    autocomplete="new-password" 
                                    placeholder="••••••••" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-600" />
                    </div>

                    <div class="flex flex-col space-y-4 mt-8">
                        <x-primary-button class="w-full justify-center px-6 py-4 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition-all duration-200">
                            {{ __('Registruotis') }}
                        </x-primary-button>

                        <div class="text-center">
                            <a class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-forest-green transition-colors duration-200" href="{{ route('login') }}">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                </svg>
                                {{ __('Jau prisiregistravęs(-usi)? Prisijunkite čia') }}
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Additional Info -->
            <div class="mt-6 text-center">
                <p class="text-sm text-amber-100">
                    Registruodamiesi sutinkate su mūsų 
                    <a href="#" class="underline hover:text-white transition-colors">sąlygomis</a> ir 
                    <a href="#" class="underline hover:text-white transition-colors">privatumo politika</a>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>